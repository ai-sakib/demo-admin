<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="product-status-wrap" >
        <form action="{{ route('attendance.update', $attendance->id) }}" method="post">
          {{ method_field('PUT') }}
          {{ csrf_field() }}

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                
                <label for="centa_id">Centa</label><span style="color:red"> *</span>
                <select name="centa_id" id="centa_id" class="form-control">
                  <option value="" disabled>--- Select ---</option>
                  @if(!empty($centa))
                    @foreach($centa as $value)
                      <option value="{{ $value->id }}" @if($value->id == $attendance->canta_id) selected @endif>{{ $value->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                    <label for="watch_party">Watch Party</label><span style="color:red"> *</span>
                    <input type="text" id="watch_party" class="form-control" name="watch_party" value="{{old('watch_party', $attendance->watch_party)}}" placeholder="Enter Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="total_attendance">Total Attendance</label><span style="color:red"> *</span>
                    <input type="text" id="total_attendance" class="form-control" name="total_attendance" value="{{old('total_attendance', $attendance->total_attendance)}}" placeholder="Enter Name" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                    <label for="first_timers">First Timers</label><span style="color:red"> *</span>
                    <input type="text" id="first_timers" class="form-control" name="first_timers" value="{{old('first_timers', $attendance->first_timers)}}" placeholder="Enter Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="new_believers">New Believers</label><span style="color:red"> *</span>
                    <input type="text" id="new_believers" class="form-control" name="new_believers" value="{{old('new_believers', $attendance->new_believers)}}" placeholder="Enter Name" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                    <label for="testimonies">Testimonies</label><span style="color:red"> *</span>
                    <input type="text" id="testimonies" class="form-control" name="testimonies" value="{{old('testimonies', $attendance->testimonies)}}" placeholder="Enter Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="date-picker-inner">
                      <label for="date">Date</label>
                      <div class="form-group data-custon-pick" id="data_1">
                        <div class="input-group date ">
                            <span class="input-group-addon"></span>
                            <input id="date" name="date" type="text" readonly style="background-color: white" class="form-control" value="{{ date('m/d/Y') }}">
                        </div>
                      </div>
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