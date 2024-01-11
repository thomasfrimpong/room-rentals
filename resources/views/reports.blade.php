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
        <a href="/expenses-list" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Expenses

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/reports" class="nav-link  active">
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
      
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Reports Page</h1>
        </div><!-- /.col -->
        <div class="offset-lg-7 col-lg-2">
          {{-- <button type="button" class="btn  btn-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-payment">Add Payment</button> --}}
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->

  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="container-fluid">
        
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="row">
            
              <div class="col-md-6">
            <div class="card card-primary">
             
              <div class="row">
               
              <div class="card-body">
                <!-- Date -->
                
                <!-- /.form group -->
                <!-- Date range -->
                <form action="/get/summaries" method="post">
                <div class="form-group">
                 
                       <label>Date range:</label>
                      </div>
                      <div class="form-group">
                     
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservation" name="date_range">
                      </div>
                      </div>
                 @csrf
                      <div class="form-group">
                      <button type="submit" class="btn btn-info btn-block">Apply</button>
                      </div>
                   
                 
                
              </form>
                
              </div>
              </div>
            </div>
            
            </div>
            <div class="col-6">
              <div class="row">
                <div class=" col-11">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title"> <b> Financial Summaries </b></h3>
                    @if(isset($start_date))
                      &nbsp;&nbsp;&nbsp;  <i>from</i>
                      {{ date('d/m/Y', strtotime($start_date )) }}  &nbsp; - &nbsp;
                      {{ date('d/m/Y', strtotime($end_date )) }}
                      @endif
                        
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Item</th>
                            <th>Total Amount</th>
                          
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Payments</td>
                            <td> @if(isset($start_date))    GH&#8373;{{$payment_summary}} @endif </td>
                           
                          </tr>
                          
                          <tr>
                            <td>Expenses</td>
                               <td>@if(isset($start_date)) GH&#8373;{{$expense_summary}} @endif</td>
                           
                          </tr>
                          <tr>
                            <td>Refunds</td>
                              <td> @if(isset($start_date))  GH&#8373;{{$refund_summary}} @endif</td>
                           
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
         
        </div>
         
        </div>

        {{-- <div class="row">
          <div class="container-fluid">
          <div class=" col-md-12">

          <div class="card card-primary">
           
              <h4>Reports Summary</h4> 
               
              <div class="card-body p-0">
           
                </div>
            </div>
           
          </div>
          </div>

        </div> --}}

      </div>
    </div>



    
    <!-- /.col -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- /.control-sidebar -->


@endsection