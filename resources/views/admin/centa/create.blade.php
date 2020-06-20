<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="product-status-wrap" >
        <form action="{{ route('centa.store') }}" method="post">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                
                <label for="name">Name</label><span style="color:red"> *</span>
                <input type="text" id="name" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Name" required>
              </div>
              <div class="form-group">
                <label for="user_id">User</label><span style="color:red"> *</span>
                <select name="user_id" id="user_id" class="form-control">
                  <option value="" disabled>--- Select ---</option>
                  @if(!empty($users))
                    @foreach($users as $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label for="branch_id">Branch</label><span style="color:red"> *</span>
                <select name="branch_id" id="branch_id" class="form-control">
                  <option value="" disabled>--- Select ---</option>
                  @if(!empty($branches))
                    @foreach($branches as $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                  @endif
                </select>
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