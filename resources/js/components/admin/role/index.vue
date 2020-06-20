<template>
	<div>
		<div class="content-header">
		  <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
		        <h1 class="m-0 text-dark">Roles</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
		          <li class="breadcrumb-item active">Roles</li>
		        </ol>
		      </div><!-- /.col -->
		    </div><!-- /.row -->
		  </div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<div class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body table-responsive">
                      <table class="table table-hover table-bordered">
                        <thead>
		                  <tr style="background-color: #3CAEA3;color: white">
		                    <th style="width: 20%">SL</th>
		                    <th style="width: 40%">Role Name</th>
		                    <th style="width: 40%">Slug</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  <tr v-for="(role,index) in getRoles" :key="role.id">
		                    <td>{{ index+1 }}</td>
		                    <td>{{ role.name }}</td>
		                    <td>{{ role.slug }}</td>
		                  </tr>
		                </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				getRoles:[],
			}
		},
		created(){
			this.loadRoles();
		},
		methods:{
			loadRoles(){
				axios.get('api/roles').then(response => {
					console.log(response)
	              this.getRoles = response.data.roles
				});
			},
		}
	}
</script>