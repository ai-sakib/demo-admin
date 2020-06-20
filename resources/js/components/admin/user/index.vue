<template>
	<span>
		<div class="content-header">
		  <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
		        <h1 class="m-0 text-dark">Users</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <button @click="addUser()" class="btn bg-success">Add New <i class="fas fa-user-plus fa-fw"></i></button>
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
		                    <th >Email</th>
		                    <th >Role</th>
		                    <th >Actions</th>
		                  </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(user,index) in users" :key="user.id">
		                    <td>{{ index+1 }}</td>
		                    <td>{{ user.name }}</td>
		                    <td>{{ user.email }}</td>
		                    <td><span v-if="user.user_role"><span v-if="user.user_role.role">{{ user.user_role.role.name }}</span></span></td>
		                    <td>
		                    	<button @click="editUser(user)" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
		                    	<button @click="deleteUser(user.id)"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModallLabel" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h5 class="modal-title" v-show="!editMode" id="userModallLabel">Add New User</h5>
	              <h5 class="modal-title" v-show="editMode" id="userModallLabel">Update User Info</h5>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>
	            <form  @submit.prevent="editMode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
	              <div class="modal-body">
	                <div class="form-group">
	                  <label for="name">Name</label>
	                  <input v-model="form.name" type="text" class="form-control" id="name" name="name" placeholder="Add Name" :class="{ 'is-invalid': form.errors.has('name') }">
	                  <has-error :form="form" field="name"></has-error>
	                </div>
	                <div class="form-group">
	                <div class="row">
	                  <div class="col-md-6">
	                    <div class="form-group">
	                      <label for="email">Email</label>
	                      <input v-model="form.email" type="text" class="form-control" id="email" name="email" placeholder="Email Address" :class="{ 'is-invalid': form.errors.has('email') }">
	                      <has-error :form="form" field="email"></has-error>
	                    </div>
	                  </div>
	                  <div class="col-md-6">
	                    <div class="form-group">
	                      <label for="role_id">Role</label>
	                      <select id="role_id" name="role_id" v-model="form.role_id" class="form-control" :class="{ 'is-invalid': form.errors.has('role_id') }">
	                        <option disabled value=""> --- Select --- </option>
	                    	<option :value="role.id"  v-for="role in roles">{{ role.name }}</option>
	                      </select>
	                      <has-error :form="form" field="role_id"></has-error>
	                    </div>
	                  </div>
	                </div>
	                </div>
	                
	                <div class="row">
	                  <div class="col-md-6">
	                    <div class="form-group">
	                      <label for="password">Password</label>
	                      <input v-model="form.password" type="password" class="form-control" id="password" name="password" placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">
	                      <has-error :form="form" field="password"></has-error>
	                    </div>
	                  </div>
	                  <div class="col-md-6">
	                    <div class="form-group">
	                      <label for="password_confirmation">Confirm Password</label>
	                      <input v-model="form.password_confirmation" type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
	                      <has-error :form="form" field="password_confirmation"></has-error>
	                    </div>
	                  </div>
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
				users:{},
				roles:[],
				editMode: false,
		          form: new Form({
	                id: '',
	                name: '',
	                role_id: '',
	                email: '',
	                password: '',
	                password_confirmation: '',
	              })
	          }
		},
		methods:{
			loadUsers(){
				axios.get('api/users').then(({ data }) => (
	              this.users = data.data
	            ));
			},
	        editUser(user){
	          this.editMode = true;
	          this.form.clear();
	          this.form.reset();
	          $('#userModal').modal('show');
	          this.form.fill(user);
	          this.form.role_id = user.user_role.role_id;
	        },
	        addUser(){
	          this.editMode = false;
	          this.form.clear();
	          this.form.reset();
	          $('#userModal').modal('show');
	        },
	        createUser() {
	          this.$Progress.start();
	          this.form.post('api/users')
	            .then(()=>{

	              Fire.$emit('AfterActions');
	              this.$Progress.finish();
	              $('#userModal').modal('hide');

	              Toast.fire({
	                icon: 'success',
	                title: 'User created successfully'
	              });
	            })
	        },
	        updateUser(){
	          this.$Progress.start();
	          this.form.put('api/users/'+this.form.id)
	            .then(({data})=>{

	              $('#userModal').modal('hide');
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
	        deleteUser(id) {
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
	              this.form.delete('api/users/'+id)
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
	        loadRoles(){
	        	axios.get('api/roles').then(response => {
	              this.roles = response.data.roles
	            });
	        },
		},
		mounted(){
			this.loadUsers();
			this.loadRoles();
			Fire.$on('AfterActions',()=>{
	          this.loadUsers();
	        })
		},
		
	}
</script>