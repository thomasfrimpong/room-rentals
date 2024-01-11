
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
            <a href="/motel-rentals?page=1" class="nav-link active">
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
        @if(isset($_GET['error']))
    <div class="alert alert-danger" role="alert">
     
   Rent not added
     </div>
     @endif
     @if(isset($_GET['success']))
    <div class="alert alert-success" role="alert">
     
   Rent added successfully
     </div>
     @endif
        <div class="row mb-8">
          <div class="col-lg-2">
            <h1 class="m-0">Rentals Page</h1>
          </div><!-- /.col -->
          <div class="offset-lg-8 col-lg-2">
            <button type="button" class="btn  btn-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-rent">Add Rent</button>
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
            <h3 class="card-title">List of Rentals</h3>
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
                  <th>Price Of Room (GHC)</th>
                  <th>Cost Of Service (GHC)</th>
                 
                  <th>Amount Paid (GHC)</th>
                  {{-- <th>Refund (GHC)</th> --}}
                  <th>Date Added</th>
                  @if($role=='admin')   <th>Added By</th> @endif 
                  <th>Check Guest Out</th>
                  {{-- <th>Update Record</th> --}}
                </tr>
              </thead>
              <tbody>
                @if(json_decode($rentals)->data)
                @foreach(json_decode($rentals)->data as $rental)
                <tr @if($rental->active) style="background-color:#90EE90"  @else style="background-color:#ffcccb"  @endif>
  
                  <td>{{$rental->guest_first_name}}  {{$rental->guest_other_names}}</td>
                
                  <td>
                    {{$rental->guest_contact}}
                  </td>
                  <td>
                     {{ date('d/m/Y h:i:s a', strtotime($rental->start_of_residence)) }}
                  </td>
                  <td>
                    {{ date('d/m/Y h:i:s a', strtotime($rental->end_of_residence)) }}
                  </td>
                  <td>
                    {{$rental->room_number}}
                   </td>
                  <td>
                    {{$rental->price_of_room}}
                   </td>
                  <td>
                   {{$rental->cost_of_service}}
                  </td>
                  
                  <td>@if($rental->payment_amount) {{$rental->payment_amount}} @else --- @endif</td>
                 
                
                  <td>{{$rental->date_added}}</td>
                  @if($role=='admin')   <td>{{$rental->user_first_name}} {{$rental->user_other_names}}</td> @endif
                  <td>
                    <button type="button" class="btn  btn-block btn-default btn-xs checkout" id="checkout-{{$rental->id}}" @if(!$rental->active) disabled @endif>
                      <i class="fa fa-arrow-right"></i>
                    </button>
                  </td>
                  @if($rental->added_by==$rental->user_id)
                  {{-- <td>
                    <a type="button" class="btn btn-block bg-gradient-info btn-flat" href="/rent/{{$rental->id}}">
                      <i class="fas fa-edit"></i>
                    </a>
                  </td> --}}
                  @endif
                </tr>
                @endforeach
                @else 
               <span style="margin:20px">No Rental yet</span> 
                @endif
              </tbody>
            </table>

            <nav aria-label="Page navigation example" style="margin:20px">
              <ul class="pagination">
                @foreach(json_decode($rentals)->links as $link)
                 @if( is_numeric($link->label))  
              
                <li class="page-item"><a class="page-link" href="?page={{$link->label}}" >{{$link->label}}</a></li>
                 @endif 
               

                @endforeach
               
              </ul>
            </nav>

          </div>
          <!-- /.card-body -->
        </div>
      </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
   
  
  
  </section>
</div>
  <!-- /.content -->
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <div class="modal fade" id="add-rent">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Rent</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action='/add-rent'>
        <div class="modal-body">
          <p>
           
            <div class="form-group">
              <label>Start Date - End Date</label>
              {{-- <input type="date" name="start_date"  class="form-control"> --}}
              <input type="text" name="rent_period" class="form-control float-right" id="reservationtime">
            </div>
            <div class="form-group">
              <label>Guest</label>
              <select class="form-control select2" style="width: 100%;" name="guest_id">
                <option></option>
                @foreach(json_decode($guests) as $guest)
                <option value="{{$guest->guest_id}}">{{$guest->guests_first_name}} {{$guest->guests_last_name}} </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Room</label>
              <select class="form-control select2" style="width: 100%;" name="room_id" id='room'>
                <option></option>
               
                @foreach(json_decode( $rooms) as $room)
                <option value="{{$room->room_id}}-{{$room->price_of_room}}">{{$room->room_number}} </option>
                @endforeach
              </select>
            </div>
            <div>
              <label>Cost Of Rent</label>
              <input type="number" name="cost_of_rent" class="form-control" id="rent_cost" readonly>
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
  