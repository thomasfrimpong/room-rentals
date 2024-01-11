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
        <a href="/payment-list" class="nav-link active">
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
      @if(isset($_GET['error']))
      <div class="alert alert-danger" role="alert">
        Payments not added
       </div>
       @endif
       @if(isset($_GET['success']))
      <div class="alert alert-success" role="alert">
        Payments added successfully
    
       </div>
       @endif
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Payments Page</h1>
        </div><!-- /.col -->
        <div class="offset-lg-7 col-lg-2">
          <button type="button" class="btn  btn-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-payment">Add Payment</button>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- /.content-header -->

  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="container-fluid">
        <div class="card card-info card-outline">
          <div class="card-header">
            <h3 class="card-title">List of Payments</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Guest Name</th>

                  <th>Phone Number</th>
                  <th>Amount</th>
                  <th>Room Number</th>
                  <th>Date Of Payment</th>
                  <th>Payment Mode</th>
                  <th>Reciept</th>
                  <th>Added By</th>
                 
                </tr>
              </thead>
              <tbody>
                @if($payments)
                @foreach(json_decode($payments) as $payment)
                <tr>

                  <td>{{$payment->guest_first_name}}  {{$payment->guest_other_names}}</td>

                  <td>
                 {{$payment->guest_phone_number}}
                  </td>
                  <td>
                  GHC  {{$payment->amount}}
                  
                  </td>
                  <td>  {{$payment->room_number}}</td>
                  <td>
                   
                    {{ date('d/m/Y h:i:s a', strtotime($payment->created_at)) }}
                  </td>
                  <td>{{$payment->payment_mode}}</td>
                  <td>
                    <a href="/reciept-{{$payment->payment_id}}" type="button" class="btn  btn-info" type="button" class="btn btn-default">
                      <i class="fa fa-address-book"></i>   
                    </a>
                  </td>
              <td>
                {{$payment->user_first_name}} {{$payment->user_other_names}}
              </td>
                </tr>
                @endforeach
                @else 
                <span style="margin:20px"> No Payment Made Yet </span>
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
<div class="modal fade" id="add-payment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action='/add-payment'>
      <div class="modal-body">
        <p>
         
          <div class="form-group">
            <input type="number" name="amount_involved" placeholder="Amount"  class="form-control" required>
          </div>
          <div class="form-group">
            <label>Service</label>
            <select name="payment_mode" id="" class="form-control" required>
              <option value=""></option>
              <option >Cash</option>
              <option>Vodafone Cash</option>
              <option>MTN MOMO</option>
              <option>AT Money</option>
              <option>Debit Card</option>
            </select>

          </div>
          
          <div class="form-group">
            <label>Service</label>
            <select class="form-control select2" style="width: 100%;" name="service" required>
              <option></option>
              @if(json_decode($services))
              @foreach(json_decode($services) as $service)
              <option value="{{$service->id}}-{{$service->guest_id}}-{{$service->room_id}}">{{$service->guest_first_name}} {{$service->guest_other_names}} at {{$service->room_number}}</option>
              @endforeach
              @endif
            </select>
          </div>
            @csrf
         
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