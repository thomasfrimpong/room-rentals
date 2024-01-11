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
      
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Reciept Page</h1>
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
           
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  
                  <h4>
                    <i class="fas fa-globe"></i> Payment Reciept
                    <small class="float-right">Date: {{Carbon\Carbon::now()->format('d-m-Y')}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                  <address>
                   <p> <strong>Rental Summary</strong></p>
                    <p>
                     Start Of Residence:    {{ date('d/m/Y h:i:s a', strtotime($payment->start_of_residence)) }}
                    </p>
                    <p>
                    End Of Residence:  {{ date('d/m/Y h:i:s a', strtotime($payment->end_of_residence)) }}
                    </p>
                    <p> Rooom Number:  {{$payment->room_number}}</p>
                   
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 
                  <address>
                  <p>  <strong>Guest Information</strong></p>
                  <p>First Name: {{$payment->guest_first_name}}</p>  
                  <p>Last Name:  {{$payment->guest_other_names}}</p>
                  <p>Phone Number: {{$payment->guest_phone_number}}</p>
                  <p>Email: {{$payment->guest_email}}</p>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
               <p>  <strong>More Details</strong></p>
                  <p>Collected By: {{$payment->user_first_name}} {{$payment->user_other_names}}</p>
                  <p>Amount Paid:  {{$payment->amount}}</p>
                  <p>Payment Mode: {{$payment->payment_mode}}</p> 
                  <p>Date Paid: {{ date('d/m/Y h:i:s a', strtotime($payment->created_at)) }}</p> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
               
                <!-- /.col -->
              </div>
              <!-- /.row -->

               <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Service Provider Information:</p>
                 

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    {{session('motel_name')}}
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                 

                  
                </div> 
                <!-- /.col -->
              </div> 
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button rel="noopener" id='printer'  class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                  {{-- 
                    
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button> --}}
                </div>
              </div>
            </div>
            <!-- /.invoice -->
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


@endsection