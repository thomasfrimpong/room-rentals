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
      
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Update Rent Info</h1>
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
              <h3 class="card-title">Update Room Info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/update-rent" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label>Start Date</label>
                  {{-- <input type="date" name="start_date"  class="form-control"> --}}
                  <input type="date" name="rent_period" value="" class="form-control float-right" >
                </div>
                <div class="form-group">
                  <label>Guest</label>
                  <select class="form-control select2" style="width: 100%;" name="guest_id">
                    <option></option>
                    @foreach(json_decode($guests) as $guest)
                    <option value="{{$rent->guest_id}}">{{$guest->rent_first_name}} {{$guest->rent_last_name}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Room</label>
                  <select class="form-control select2" style="width: 100%;" name="room_id">
                    <option></option>
                   
                    @foreach(json_decode( $rooms) as $room)
                    <option value="{{$room->room_id}}">{{$room->room_number}} </option>
                    @endforeach
                  </select>
                </div>
                <div>
                  <label>Cost Of Rent</label>
                  <input type="number" name="cost_of_rent" class="form-control" required>
                </div>
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