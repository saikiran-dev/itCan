@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            @if (\Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{!! \Session::get('success') !!}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <a href="/home">
                    Dashboard
                </a>
            <div class="card" style="margin-top: 20px">
                <div class="card-header">{{ __('Upload Revenue Sheet') }}</div>

                <div class="card-body">

                    <form method="Post" action="{{route('upload')}}" enctype="multipart/form-data">
                    @csrf

                     <label>Client</label>

                    <select class="form-control" id="client" name="client">  
                        <option value="Client One"> Client One</option>   
                        <option value="Client Two"> Client Two</option>   
                        <option value="Client Three"> Client Three</option>   
                    </select>

                    <div style="margin: 15px 0px;">
                        <label>Services</label>

                        <select  class="form-control" id="service" name="service">  
                            <option value="Marketing Coupons">Marketing Coupons</option>   
                            <option value="Service Two">Service Two</option>   
                            <option value="Service Three"> Service Three</option>   
                        </select>
                    </div>

                    <div>
                        <input type="file" name="file">
                    </div>
                    @if($errors->has('file'))
                        <div class="pt-2 text-danger">{{ $errors->first('file') }}</div>
                    @endif

                    <div style="margin-top: 30px">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
