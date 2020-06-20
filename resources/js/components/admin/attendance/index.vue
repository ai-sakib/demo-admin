<template>
	<span>
		<div class="content-header">
		  <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
		        <h1 class="m-0 text-dark">Attendance</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <button @click="addAttendance()" class="btn bg-success">Add New <i class="fas fa-user-plus fa-fw"></i></button>
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
		                    <th >Centa</th>
		                    <th >Watch Party</th>
		                    <th >Total Attendance</th>
		                    <th >First Timers</th>
		                    <th >New Belivers</th>
		                    <th >Testimonies</th>
		                    <th >Date</th>
		                    <th >Actions</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  <tr v-for="(attendance,index) in attendance" :key="attendance.id">
		                    <td>{{ index+1 }}</td>
		                    <td><span v-if="attendance.centa">{{ attendance.centa.name }}</span></td>
		                    <td>{{ attendance.watch_party }}</td>
		                    <td>{{ attendance.total_attendance }}</td>
		                    <td>{{ attendance.first_timers }}</td>
		                    <td>{{ attendance.new_believers }}</td>
		                    <td>{{ attendance.testimonies }}</td>
		                    <td>{{ attendance.date | timeformat}}</td>
		                    <td>
		                    	<button @click="editAttendance(attendance)" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
		                    	<button @click="deleteAttendance(attendance.id)"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
        <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModallLabel" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h5 class="modal-title" v-show="!editMode" id="attendanceModallLabel">Add New Attendance</h5>
	              <h5 class="modal-title" v-show="editMode" id="attendanceModallLabel">Update Attendance Info</h5>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>
	            <form  @submit.prevent="editMode ? updateAttendance() : createAttendance()" @keydown="form.onKeydown($event)">
	              <div class="modal-body">
	              	<div class="form-group">
                      <label for="centa_id">Centa</label>
                      <select id="centa_id" name="centa_id" v-model="form.centa_id" class="form-control" :class="{ 'is-invalid': form.errors.has('centa_id') }">
                        <option disabled value=""> --- Select --- </option>
                    	<option :value="centa.id"  v-for="centa in centa">{{ centa.name }}</option>
                      </select>
                      <has-error :form="form" field="centa_id"></has-error>
                    </div>
	                
	                <div class="form-group">
		                <div class="row">
		                  <div class="col-md-6">
		                    <div class="form-group">
		                      <label for="watch_party">Watch Party</label>
		                      <input v-model="form.watch_party" type="text" class="form-control" id="watch_party" name="watch_party" placeholder="Watch Party" :class="{ 'is-invalid': form.errors.has('watch_party') }">
		                      <has-error :form="form" field="watch_party"></has-error>
		                    </div>
		                  </div>
		                  <div class="col-md-6">
		                    <div class="form-group">
			                  <label for="total_attendance">Total Attendance</label>
			                  <input v-model="form.total_attendance" type="text" class="form-control" id="total_attendance" name="total_attendance" placeholder="Total Attendance" :class="{ 'is-invalid': form.errors.has('total_attendance') }">
			                  <has-error :form="form" field="total_attendance"></has-error>
			                </div>
		                  </div>
		                </div>
	                </div>
	                <div class="form-group">
		                <div class="row">
		                  <div class="col-md-6">
		                    <div class="form-group">
		                      <label for="first_timers">First Timers</label>
		                      <input v-model="form.first_timers" type="text" class="form-control" id="first_timers" name="first_timers" placeholder="First Timers" :class="{ 'is-invalid': form.errors.has('first_timers') }">
		                      <has-error :form="form" field="first_timers"></has-error>
		                    </div>
		                  </div>
		                  <div class="col-md-6">
		                    <div class="form-group">
			                  <label for="new_believers">New Believers</label>
			                  <input v-model="form.new_believers" type="text" class="form-control" id="new_believers" name="new_believers" placeholder="New Believers" :class="{ 'is-invalid': form.errors.has('new_believers') }">
			                  <has-error :form="form" field="new_believers"></has-error>
			                </div>
		                  </div>
		                </div>
	                </div>
	                <div class="form-group">
		                <div class="row">
		                  <div class="col-md-6">
		                    <div class="form-group">
		                      <label for="testimonies">Testimonies</label>
		                      <input v-model="form.testimonies" type="text" class="form-control" id="testimonies" name="testimonies" placeholder="Testimonies" :class="{ 'is-invalid': form.errors.has('testimonies') }">
		                      <has-error :form="form" field="testimonies"></has-error>
		                    </div>
		                  </div>
		                  <div class="col-md-6">
		                    <div class="form-group">
			                    <div class="date-picker-inner">
			                      <label for="date">Date</label>
			                      <div class="form-group data-custon-pick" id="data_1">
			                        <div class="input-group date ">
			                            <span class="input-group-addon"></span>
			                            <input id="date" name="date" type="text" readonly style="background-color: white" class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }">
			                            <has-error :form="form" field="date"></has-error>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
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
				attendance:{},
				centa:{},
				editMode: false,
		          form: new Form({
	                id: '',
	                centa_id: '',
	                watch_party: '',
	                total_attendance: '',
	                first_timers: '',
	                new_believers: '',
	                testimonies: '',
	                date: '',
	              })
	          }
		},
		methods:{
			loadAttendance(){
				axios.get('api/attendance').then(response =>{
					this.attendance = response.data.attendance
				});
			},
	        editAttendance(attendance){
	          this.editMode = true;
	          this.form.clear();
	          this.form.reset();
	          $('#attendanceModal').modal('show');
	          this.form.fill(attendance);
	        },
	        addAttendance(){
	          this.editMode = false;
	          this.form.clear();
	          this.form.reset();
	          $('#attendanceModal').modal('show');
	        },
	        createAttendance() {
	          this.$Progress.start();
	          this.form.post('api/attendance')
	            .then(()=>{

	              Fire.$emit('AfterActions');
	              this.$Progress.finish();
	              $('#attendanceModal').modal('hide');

	              Toast.fire({
	                icon: 'success',
	                title: 'User created successfully'
	              });
	            })
	        },
	        updateAttendance(){
	          this.$Progress.start();
	          this.form.put('api/attendance/'+this.form.id)
	            .then(({data})=>{

	              $('#attendanceModal').modal('hide');
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
	        deleteAttendance(id) {
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
	              this.form.delete('api/attendance/'+id)
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
	        loadCenta(){
	        	axios.get('api/load-centa-for-attendance').then(response => {
	              this.centa = response.data
	            });
	        },
		},
		mounted(){
			this.loadAttendance();
			this.loadCenta();
			Fire.$on('AfterActions',()=>{
	          this.loadAttendance();
	        })
		},
		
	}
</script>