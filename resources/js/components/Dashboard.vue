<template>
 <div>
 	<div style="display: flex; justify-content: space-between; margin-bottom: 15px">
 		<h2>Revenue Details</h2>
 		<button type="button" class="btn btn-primary" @click="uploadRevenue">Upload Report </button>
 	</div>
  
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Upload Time</th>
        <th>User</th>
        <th>Client</th>
        <th>Row Count</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="report in reports">
        <td>{{report.created_at}}</td>
        <td>{{report.user.name}}</td>
        <td>{{report.client}}</td>
        <td>{{report.row_count}}</td>
      </tr>
    </tbody>
  </table>
</div>
</template>
<script type="text/javascript">
	export default{
    data(){
      return {
        reports: []
      }
    },

    mounted(){
      this.fetchReports();
    },

		methods:{
      fetchReports(){
        axios.get(`/api/reports`).then((response) => {
          this.reports = response.data.data;
        })
      },


			uploadRevenue(){
				window.location.href = `/upload-revenue-sheet`;
				
			}
		}
	}
</script>