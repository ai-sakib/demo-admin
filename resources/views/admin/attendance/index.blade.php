@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Attendance &nbsp;<a onclick="addPage('attendance','Attendance')" class="btn btn-sm bg-success"><i class="fas fa-plus"></i> Add</a></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active">Attendance</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->

<section class="content">
    <div class="row">
      <div class="col-12">
        <!-- /.card -->
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr style="background-color: #3CAEA3;color: white">
                    <th style="width: 10%">SL</th>
                    <th style="width: 10%">Centa</th>
                    <th style="width: 10%">Watch Party</th>
                    <th style="width: 10%">Total Attendance</th>
                    <th style="width: 10%">First Timers</th>
                    <th style="width: 10%">New Believers</th>
                    <th style="width: 10%">Testimonies</th>
                    <th style="width: 10%">Date</th>
                    <th style="width: 10%">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($attendance[0]))
                   @foreach($attendance as $key => $value)
                  <tr id="tr-{{$value->id}}">
                    <td>{{ $key+1 }}</td>
                    <td>{{ optional($value->centa)->name }}</td>
                    <td>{{ $value->watch_party }}</td>
                    <td>{{ $value->total_attendance }}</td>
                    <td>{{ $value->first_timers }}</td>
                    <td>{{ $value->new_believers }}</td>
                    <td>{{ $value->testimonies }}</td>
                    <td>{{ date('l jS \of F, Y', strtotime($value->date)) }}</td>
                    <td>
                      <a onclick="editPage('attendance','{{ $value->id }}','User')"  title="Edit" class="btn bg-primary btn-xs"><i class="fas fa-edit" aria-hidden="true"></i></a>
                      <a data-toggle="tooltip" onclick="Delete('{{$value->id}}')" title="Delete" class="btn bg-danger btn-xs"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
<!-- /.content -->
<script type="text/javascript">
  
  function Delete(id) {
    $.confirm({
      title: '',
      content: '<div style="padding-top:35px;padding-bottom:15px"><h3 class="text-center"><strong class="text-success">Are you sure to Delete ?</strong></h3></div>',
      buttons: {
          confirm: {
              text: 'Delete',
              btnClass: 'btn-danger',
              action: function(){
                  $.ajax({
                  headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                  url: "{{url('attendance')}}/"+id,
                  type: 'DELETE',
                  dataType: 'json',
                  success:function(response) {
                    if(response.success){
                      $('#tr-'+id).fadeOut();
                    }else{
                      $.alert({
                        title:"Whoops!",
                        content:"<hr><strong class='text-danger'>Something Went Wrong!</strong><hr>",
                        type:"red"
                      });
                    }
                  }
                });
              }
          },
          close: {
              text: 'Cancel',
              btnClass: 'btn-default',
              action: function(){
                  
              }
          }
      }
    });  
  }
</script>
@endsection