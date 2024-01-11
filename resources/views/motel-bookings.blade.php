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
        <a href="/motel-bookings" class="nav-link active">
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
      @if(isset($_GET['error']))
      <div class="alert alert-danger" role="alert">
      @if($_GET['error']=='update')
      Booking not updated
     @else
     Bookings not added
     @endif
     
       </div>
       @endif
       @if(isset($_GET['success']))
      <div class="alert alert-success" role="alert">
        @if($_GET['success']=='create')
        Bookings added successfully
       @else
       Bookings updated successfully
       @endif
       </div>
       @endif
      <div class="row mb-8">
        <div class="col-lg-3">
          <h1 class="m-0">Bookings Page</h1>
        </div><!-- /.col -->
       
        <div class="offset-lg-7 col-lg-2">
          <button type="button" class="btn  btn-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-booking">Add Bookings</button>
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
            <h3 class="card-title">List of Bookings</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Guest Name</th>
                
                  <th>Guest Contact</th>
                  
                  <th>Start Of Rent</th>
                  <th>End Of Rent</th>
                  <th>Room Number</th>
                  <th>Price Of Room</th>
                  <th>Cost Of Service</th>
                  <th>Date Added</th>
                  <th>Added By</th>
                  <th>Check In Guest</th>
                  {{-- <th>Update Record</th> --}}
                </tr>
              </thead>
              <tbody>
             
                @foreach(json_decode($bookings) as $booking)
                <tr>

                  <td>{{$booking->guest_first_name}}  {{$booking->guest_other_names}}</td>
                 
                  <td>
                    {{$booking->guest_contact}}
                  </td>
                  
                  <td>  {{ date('d/m/Y h:i:s a', strtotime($booking->start_of_residence)) }}</td>
                  <td>
                    {{ date('d/m/Y h:i:s a', strtotime($booking->end_of_residence)) }}
                  </td>
                  <td>{{$booking->room_number}}</td>
                  <td>{{$booking->price_of_room}}</td>
                  <td>{{$booking->cost_of_service}}</td>
                  <td>{{$booking->date_added}}</td>
                  <td>{{$booking->user_first_name}} {{$booking->user_other_names}}</td>
                  <td>
                    <button type="button" class="btn  btn-block btn-default btn-xs checkin" id="checkin-{{$booking->id}}" >
                      <i class="fa fa-arrow-left"></i>
                    </button>
                  </td>
                  {{-- <td>
                     
                    <a type="button" href="/update-{{$booking->id}}" class="btn btn-outline-info btn-block btn-sm"> <i class="fas fa-edit"></i></a>
                  </td> --}}
                </tr>
                @endforeach
                
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
<div class="modal fade" id="add-booking">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Booking</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action='/add-booking'>
      <div class="modal-body">
        <p>
          <div class="form-group">
            <label>Start Date - End Date</label>
            {{-- <input type="date" name="start_date"  class="form-control"> --}}
            <input type="text" name="rent_period" class="form-control float-right" id="reservationtime">
          </div>
          <div class="form-group">
            <label for="">Rooms</label>
          <select name="room_id" id="" class="form-control select2" style="width: 100%;" required>
            <option></option>
            @foreach(json_decode($rooms) as $room)
           
            <option value="{{$room->room_id}}">{{$room->room_number}}</option>
           
           @endforeach
          </select>
          </div>
          <div class="form-group">
            <label for="">Guests </label>
          <select name="guest_id" id="" class="form-control select2" style="width: 100%;" required>
            <option></option>
            @foreach(json_decode($guests) as $guest)
           
            <option value="{{$guest->guest_id}}">{{$guest->guests_first_name}} {{$guest->guests_last_name}}</option>
           
           @endforeach
          </select>
          </div>

          <div class="form-group">
            <input type="number" name="cost_of_service" placeholder="Cost Of Rent"  class="form-control" required>
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