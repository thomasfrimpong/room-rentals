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
        <a href="/motel-rentals" class="nav-link">
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
      @if($role=='admin')
      <li class="nav-item">
        <a href="/users-list" class="nav-link">
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
   
   
  </div>

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-8">
        <div class="offset-lg-2 col-lg-6">
          @if(isset($_GET['error']))
          <div class="alert alert-danger" role="alert">
           Password not changed
           </div>
           @endif
           @if(isset($_GET['success']))
          <div class="alert alert-success" role="alert">
            Password changed successfully
        
           </div>
           @endif
          </div>
        <!-- /.col -->
        <div class="offset-lg-2 col-lg-3">
          <h1 class="m-0">Password Change</h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->

  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="container-fluid">
        <div class="offset-lg-2 col-lg-6">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Change Password</h3>
          </div>
         
          <!-- /.card-header -->
          

            
          <div class="card-body p-0">

            <form method="post" action='/update-password'>
              <div class="modal-body">
                <p>
                  <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" name="old_password" placeholder=""  class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" placeholder=""  class="form-control" required>
                  </div>
                 
                  
                    @csrf
                 
                </p>
              </div>
              <div class="">
                <button type="submit" class="btn btn-block btn-info">Save changes</button>
               
              </div>
            </form>
           
          </div>
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

@endsection