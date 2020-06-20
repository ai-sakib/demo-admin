<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="product-status-wrap" >
        <form action="{{ route('users.store') }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                
                <label for="name">Name</label><span style="color:red"> *</span>
                <input type="text" id="name" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Name" required>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                
                <label for="email">Email</label><span style="color:red"> *</span>
                <input type="text" id="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter Email" required>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                
                <label for="role_id">Role</label><span style="color:red"> *</span>
                <select name="role_id" id="role_id" class="form-control">
                  <option value="" disabled>--- Select ---</option>
                  @if(!empty($roles))
                    @foreach($roles as $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                
                <label for="password">Password</label><span style="color:red"> *</span>
                <input type="password" id="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password" required>
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                
                <label for="password_confirmation">Confirm Password</label><span style="color:red"> *</span>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Confirm Password" required>
              </div>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>
              <button data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>