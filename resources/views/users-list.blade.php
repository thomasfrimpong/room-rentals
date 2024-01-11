@extends('layout.app')
@section('content')
<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Alexander Pierce</a>
    </div>
  </div> --}}



  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="/admin-dashboard" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Dashboard

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/motel-bookings" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Bookings
            
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/motel-rentals?page=1" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Rentals

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/motel-guests" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Guests

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/list-of-rooms" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Rooms

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/payment-list" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Payments

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/refund-list" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Refunds

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/expenses-list" class="nav-link" >
          <i class="nav-icon fas fa-th"></i>
          <p>
            Expenses

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/reports" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
           Reports
            
          </p>
        </a>
      </li>
      @if($role=='admin')
      <li class="nav-item">
        <a href="/users-list" class="nav-link active">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Users

          </p>
        </a>
      </li>
      @endif
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="container-fluid">
  @if(isset($_GET['error']))
  <div class="alert alert-danger" role="alert">
   
 User not added
   </div>
   @endif
   @if(isset($_GET['success']))
  <div class="alert alert-success" role="alert">
   
 User added successfully
   </div>
   @endif
  <div  class="content-header">
    <div class="container-fluid">
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Users Page</h1>
        </div><!-- /.col -->
        <div class="offset-lg-6 col-lg-3">
          <button type="button" class="btn  btn-primary" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-user">Add User</button>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</div>
  <!-- /.content-header -->

  <!-- Main content -->


  <section class="content">
   
    <div class="row">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">List of Users</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name Of User</th>

                  <th>Phone Number</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Date Added</th>
                 
                 
                </tr>
              </thead>
              <tbody>
                @if($users)
                @foreach(json_decode($users) as $user)
                <tr>

                  <td> {{$user->first_name}}  {{$user->other_names}}</td>

                  <td>
                 {{$user->phone_number}}
                  </td>
                  <td>
                    {{$user->role}}
                  
                  </td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->created_at}}</td>
                  
                 
             
                </tr>
                @endforeach
                @else 
                No User Added Yet
                @endif
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- /.control-sidebar -->

<!-- Main Footer -->
<div class="modal fade" id="add-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action='/add-user'>
      <div class="modal-body">
        <p>
          <div class="form-group">
            <input type="text" name="first_name" placeholder="First Name"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="text" name="other_names" placeholder="Last Name"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="number" name="phone_number" placeholder="Phone Number"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="text" name="email" placeholder="Email"  class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="employee_id" placeholder="Employee ID"  class="form-control">
          </div>
          <div class="form-group">
            <label for="exampleSelectBorder">Role </label>
            <select class="custom-select form-control-border" id="exampleSelectBorder" name="role" required>
              <option></option>
              <option>admin</option>
              <option>user</option>
             
            </select>
            @csrf
          </div>
        </p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection