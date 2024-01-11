
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="/admin-dashboard" class="nav-link active">
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
            <a href="/reports" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Reports
                
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
   
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0"> {{session('motel_name')}}</h1>
           <b> Summary for {{Carbon\Carbon::now()->format('d-m-Y')}}</b>
          </div><!-- /.col -->
          <div class="col-sm-4">
          
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
   
  <section class="content">
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      {{-- <div class="small-box bg-info">
        <div class="inner">
          <h3>{{json_decode($rooms_count)??0 }}</h3>

          <p>Number Of Rooms</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-home"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div> --}}
     
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-home"></i></span>
  
        <div class="info-box-content">
          <span class="info-box-text"><strong>{{json_decode($bookings)??0}}</strong></span>
          <span class="info-box-number">
            Number of
           Bookings
           
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      
      <div class="info-box">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-house-user"></i></span>
  
        <div class="info-box-content">
          <span class="info-box-text"><strong>{{json_decode($guests_count)??0}}</strong></span>
          <span class="info-box-number">
            Number of
           Guests
           
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      
      <div class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>
  
        <div class="info-box-content">
          <span class="info-box-text">GHC <strong>{{json_decode($total_payments)??0}} </strong></span>
          <span class="info-box-number">
           Sum Of 
           Payments
           
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      
    </div>
    <!-- ./col -->
     <div class="col-lg-3 col-6">
      
    
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><strong>{{json_decode($rentals)??0}}</strong></span>
        <span class="info-box-number">
          Number of
         Rentals
         
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
    <!-- ./col -->
  </div>
 
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @endsection
  