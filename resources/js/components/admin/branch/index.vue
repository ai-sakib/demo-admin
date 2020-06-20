<template>
	<span>
		<div class="content-header">
		  <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
		        <h1 class="m-0 text-dark">Branches</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <button @click="addBranch()" class="btn bg-success">Add New <i class="fas fa-user-plus fa-fw"></i></button>
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
		                    <th >SL</th>
		                    <th >Name</th>
		                    <th >User</th>
		                    <th >Actions</th>
		                  </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(branch,index) in branches" :key="branch.id">
		                    <td>{{ index+1 }}</td>
		                    <td>{{ branch.name }}</td>
		                    <td ><span v-if="branch.user">{{ branch.user.name }}</span></td>
		                    <td>
		                    	<button @click="editBranch(branch)" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
		                    	<button @click="deleteBranch(branch.id)"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
		                    </td>
		                  </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="branchModallLabel" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h5 class="modal-title" v-show="!editMode" id="branchModallLabel">Add New Branch</h5>
	              <h5 class="modal-title" v-show="editMode" id="branchModallLabel">Update Branch Info</h5>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>
	            <form  @submit.prevent="editMode ? updateBranch() : createBranch()" @keydown="form.onKeydown($event)">
	              <div class="modal-body">
	                <div class="form-group">
	                  <label for="name">Name</label>
	                  <input v-model="form.name" type="text" class="form-control" id="name" name="name" placeholder="Add Name" :class="{ 'is-invalid': form.errors.has('name') }">
	                  <has-error :form="form" field="name"></has-error>
	                </div>
	                <div class="form-group">
                      <label for="user_id">User</label>
                      <select id="user_id" name="user_id" v-model="form.user_id" class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                        <option disabled value=""> --- Select --- </option>
                    	<option :value="user.id"  v-for="user in users">{{ user.name }}</option>
                      </select>
                      <has-error :form="form" field="user_id"></has-error>
                    </div>
	              </div>
	              <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                <button type="submit" v-show="!editMode" class="btn btn-success">Create</button>
	                <button type="submit" v-show="editMode" class="btn btn-success">Update</button>
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
	</span>
</template>
<script>
	export default {
		data(){
			return {
				branches:{},
				users:{},
				editMode: false,
		          form: new Form({
	                id: '',
	                name: '',
	                user_id: '',
	              })
	          }
		},
		methods:{
			loadBranches(){
				axios.get('api/branches').then(({ data }) => (
	              this.branches = data.data
	            ));
			},
	        editBranch(branch){
	          this.editMode = true;
	          this.form.clear();
	          this.form.reset();
	          $('#branchModal').modal('show');
	          this.form.fill(branch);
	        },
	        addBranch(){
	          this.editMode = false;
	          this.form.clear();
	          this.form.reset();
	          $('#branchModal').modal('show');
	        },
	        createBranch() {
	          this.$Progress.start();
	          this.form.post('api/branches')
	            .then(()=>{

	              Fire.$emit('AfterActions');
	              this.$Progress.finish();
	              $('#branchModal').modal('hide');

	              Toast.fire({
	                icon: 'success',
	                title: 'Branch created successfully'
	              });
	            })
	        },
	        updateBranch(){
	          this.$Progress.start();
	          this.form.put('api/branches/'+this.form.id)
	            .then(({data})=>{

	              $('#branchModal').modal('hide');
	              Fire.$emit('AfterActions');
	              this.$Progress.finish();
	              
	              swalWithBootstrapButtons.fire(
	                'Updated!',
	                'Your file has been updated.',
	                'success'
	              )
	              
	            })
	            .catch(()=>{
	              this.$Pregress.fail();
	            })
	        },
	        deleteBranch(id) {
	          swalWithBootstrapButtons.fire({
	            title: 'Are you sure?',
	            text: "You won't be able to revert this!",
	            icon: 'warning',
	            showCancelButton: true,
	            confirmButtonText: 'Yes, delete it!',
	            cancelButtonText: 'No, cancel!',
	            reverseButtons: true
	          }).then((result) => {
	            if (result.value) {
	              this.form.delete('api/branches/'+id)
	                .then(()=>{
	                  swalWithBootstrapButtons.fire(
	                    'Deleted!',
	                    'Your file has been deleted.',
	                    'success'
	                  )
	                  Fire.$emit('AfterActions');
	                })
	              
	            } else if (
	              result.dismiss === Swal.DismissReason.cancel
	            ) {
	              swalWithBootstrapButtons.fire(
	                'Cancelled',
	                'Your imaginary file is safe :)',
	                'error'
	              )
	            }
	          })
	        },
	        loadUsers(){
	        	axios.get('api/load-users-for-branch').then(response => {
	              this.users = response.data
	            });
	        },
		},
		mounted(){
			this.loadBranches();
			this.loadUsers();
			Fire.$on('AfterActions',()=>{
	          this.loadBranches();
	        })
		},
		
	}
</script>