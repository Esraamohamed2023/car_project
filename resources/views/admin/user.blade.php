@extends('admin.admintemplate')
@push('title')
    user
@endpush
@section('count')
{{ $messageCount }}
@endsection
@section('des')
<li class="nav-item">
  <a class="dropdown-item">
   
  
  
@foreach($readMessages as $message)
<span class="image"><img src="{{ asset('frontend/images/img.jpg') }}" alt="Profile Image" /></span>
<span>
    <span>Name:{{ $message['first_name'] }}{{ $message['last_name'] }}</span>
    <span class="time">{{ $message['created_at'] }}</span>
</span>
<span class="message"> Messsage:
    {{ $message['Content'] }}
</span>
@endforeach
</a>
</li>
@endsection





@section('pageContent')
       <!-- page content -->
       <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Manage <small>Users</small></h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>List of Users</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Settings 1</a>
                          <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        @if(session('message'))
                        <div id="flash-message"  class="alert alert-success">
                            <p style="font-size: 20px">{{ session('message') }}</p>
                        </div>
                    
                        <script>
                            setTimeout(function () {
                                document.getElementById('flash-message').style.display = 'none';
                            }, 3000); // Hide after 3 seconds
                        </script>
                    @endif
                        <div class="col-sm-12">
                          <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Registration Date</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>


                    <tbody>
                      @foreach($users as $user)
                      <tr>
                        <td>{{$user['created_at']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['username']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>@if($user->admin)  yes✅ @else  no ❎ @endif </td>
                        <td><a href="edituser/{{$user->id}}"><img src="{{asset('frontend/images/edit.png')}}" alt="Edit"></a></td>
                        <td><a href="deleteuser/{{$user->id}}"><img src="{{asset('frontend/images/delete.png')}}" alt="Delete"></a></td>
                      </tr>
                      @endforeach
                    
                       
                      
                      
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
@endsection