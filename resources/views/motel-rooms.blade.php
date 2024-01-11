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
        <a href="/list-of-rooms" class="nav-link active">
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
      Room not updated
     @else
     Room not added
     @endif
     
       </div>
       @endif
       @if(isset($_GET['success']))
      <div class="alert alert-success" role="alert">
        @if($_GET['success']=='create')
        Room added successfully
       @else
        Room updated successfully
       @endif
       </div>
       @endif
      <div class="row mb-8">
        <div class="col-lg-2">
          <h1 class="m-0">Rooms Page</h1>
        </div><!-- /.col -->
        @if($role=='admin')
        <div class="offset-lg-8 col-lg-2">
          <button type="button" class="btn  btn-primary" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-room">Add Room</button>
        </div><!-- /.col -->
        @endif
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
            <h3 class="card-title">List of Rooms</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Room Number</th>
                
                  <th>Price Of Room<br> (per day)</th>
                  {{-- <th>State Of Occupancy</th> --}}
                  <th>Date Of Availability</th>
                  <th>Added By</th>
                  <th>Update Record</th>
                </tr>
              </thead>
              <tbody>
                @if(json_decode($rooms))
                @foreach(json_decode($rooms) as $room)
                <tr>

                  <td>{{$room->room_number}} </td>
                 
                  <td>
                GHC {{$room->price_of_room}}
                  </td>
                  {{-- <td>
                    @if($room->state_of_occupancy) Occupied @else Empty @endif
                  
                  </td> --}}
                  <td>  {{ date('d/m/Y h:i:s a', strtotime($room->date_of_availability)) }}</td>
                  <td>
                    {{$room->first_name}} {{$room->other_names}}
                  </td>
                  <td>
                    
                    <a type="button" href="/edit-room-{{$room->room_id}}" class="btn btn-outline-info btn-block btn-sm"> <i class="fas fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
                <span style="margin:20px">No Rooms </span>
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
<div class="modal fade" id="add-room">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Room</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action='/add-room'>
      <div class="modal-body">
        <p>
         
          <div class="form-group">
            <input type="text" name="room_number" placeholder="Room Number"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="number" name="cost_of_room" placeholder="Cost Of Room (per day)"  class="form-control" required>
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