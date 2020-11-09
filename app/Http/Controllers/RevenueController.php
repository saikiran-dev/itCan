<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Excel;
use Auth;
use Carbon\Carbon;

use App\Models\Service;
use App\Models\Revenue;
use App\Http\Resources\Revenue as RevenueResource;
use App\Http\Resources\Service as ServiceResource;
use App\Imports\RevenueImport;

class RevenueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        

        $this->middleware('auth');
    }

    public function form(Request $request)
    {
        $api_token = $request->user()->api_token;

        view()->share('api_token', $api_token);
        
        return view('Upload.revenue');
    }

    public function upload(Request $request)
    {
        $rules = [
            "file" => "required|mimes:csv,txt",
            "client" => "required",
            "service" => "required"
        ];

        $messages = [
            "client.required" => "Please Selet Client",
            "service.required" => "Please Selet Service",
            "file.required" => 'Please choose the file.',
            "file.mimes" => 'Please choose only CSV file.'
        ];

        //Validating the request
        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        //Store the csv in mentions path
        $path = storage_path('app/imports/revenue_list.csv');

        if (file_exists($path)) {
            //delete the file if it already exists
            unlink($path);
        }

        $fileNameToStore = "revenue_list.csv";

        $path = $request->file('file')->storeAs('imports',$fileNameToStore);

        $service = $this->saveToDatabase($request->all());

        return redirect('upload-revenue-sheet')->with('success', 'File Uploaded successfully');
    }

    public function saveToDatabase($request)
    {
        $user = Auth::user();

        //Converting CSV file into array
        $rows = Excel::toArray(new RevenueImport(), storage_path('app/imports/revenue_list.csv'));

        $service['user_id'] = $user->id;
        $service['client'] = $request['client'];
        $service['service'] = $request['service'];
        $service['row_count'] = count($rows[0]);

        $generatedService = Service::create($service);

        //IN THIS IS CASE THERE IS NO POSIBILITY OF ANOTHER ARRAY 
        foreach($rows[0] as $key => $row){
            $data['service_id'] = $generatedService->fresh()->id;
            $data['generated_date'] = Carbon::parse($generatedService->created_at)->format('Y-m-d H:i');
            $data['order_id'] = $row['order_id'];
            $data['coupons_number'] = $row['coupons_number'];
            $data['revenue'] = $row['revenue'];

            Revenue::create($data);
        } 

        return $generatedService;
    }

    public function fetchReports()
    {
        $reports = Service::all();

        return ServiceResource::collection($reports);
    }
}
