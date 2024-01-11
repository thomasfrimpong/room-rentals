@extends('layout.app')
@section('content')
<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Alexander Pierce</a>
    </div>
  </div>



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
        <a href="list-of-rooms" class="nav-link">
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
        <a href="/expenses-list" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Expenses

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/users-list" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Users

          </p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <div class="content-header">
    <div class="container-fluid">
      @if(isset($_GET['error']))
  <div class="alert alert-danger" role="alert">
   
 Guest not added
   </div>
   @endif
   @if(isset($_GET['success']))
  <div class="alert alert-success" role="alert">
   
 Guest added successfully
   </div>
   @endif
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Edit Guest</h1>
        </div><!-- /.col -->
      
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->

  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="container-fluid">
     <div class="offset-lg-2 col-lg-8">
        <div class="card-body p-0">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Update Guest Info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="update-guest" method="post">
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$guest->first_name}}" name="first_name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label" >Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$guest->other_names}}" name="other_names">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$guest->phone_number}}" name="phone_number">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$guest->email}}" name="email">
                  </div>
                </div>
                @csrf
                {{-- <input type="hidden" value="{{$guest->advert}}" name="advert"> --}}
                <input type="hidden" value="{{$guest->id}}" name="id">
              </div>
              <!-- /.card-body -->
              <div class="">
                <button type="submit" class="btn btn-block btn-info">Update</button>
               
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
       
    </div>
  </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
 

</section>

</div>
<!-- /.content -->
{{-- </div> --}}
<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- /.control-sidebar -->

<!-- Main Footer -->

@endsection