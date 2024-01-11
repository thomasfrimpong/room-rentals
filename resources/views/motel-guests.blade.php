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
        <a href="/motel-guests" class="nav-link active">
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
    @if($_GET['error']=='update')
      Guest updated failed
     @else
      Guest updated failed
     @endif
   </div>
   @endif
   @if(isset($_GET['success']))
  <div class="alert alert-success" role="alert">
   @if($_GET['success']=='create')
    Guest added successfully
   @else
    Guest updated successfully
   @endif

   </div>
   @endif
      <div class="row mb-8">
        <div class="col-lg-2">
          <h1 class="m-0">Guest Page</h1>
        </div><!-- /.col -->
        <div class="offset-lg-8 col-lg-2">
          <button type="button" class="btn  btn-info" type="button" class="btn btn-default" data-toggle="modal" data-target="#add-guest">Add Guest</button>
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
          <h3 class="card-title">List of Guests</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Guest Name</th>
                
                <th>Phone Number</th>
                <th>Email</th>
                <th>Date Added</th>
                <th>Added By</th>
                <th>Status</th>
                <th>Update Record</th>
              </tr>
            </thead>
            <tbody>
              @if(json_decode($guests))
              @foreach(json_decode($guests) as $guest)
              <tr @if($guest->active) style="background-color:#ffcccb"  @else style="background-color:#90EE90"  @endif >

                <td>{{$guest->guests_first_name}}  {{$guest->guests_last_name}}</td>
               
                <td>
                  {{$guest->phone_number}}
                </td>
                <td>
                  {{$guest->email}}
                </td>
                <td>
                 {{ date('d/m/Y h:i:s a', strtotime($guest->created_at)) }}
                </td>
                <td> {{$guest->user_first_name}} {{$guest->user_last_name}}</td>
                <td>
                  @if($guest->active) Active @else Inactive @endif 
                </td>
                
                <td>
                    
                  <a type="button" href="/edit-guest-{{$guest->guest_id}}" class="btn btn-outline-info btn-block btn-sm"> <i class="fas fa-edit"></i></a>
                </td>
              </tr>
             
              @endforeach
              @else 
              <p> No Guest Yet</p>
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

</div>
<!-- /.content -->
{{-- </div> --}}
<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- /.control-sidebar -->

<!-- Main Footer -->
<div class="modal fade" id="add-guest">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Guest</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action='/add-guest'>
      <div class="modal-body">
        <p>
         
          <div class="form-group">
            <input type="text" name="first_name" placeholder="First Name"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="text" name="other_names" placeholder="Last Name"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="number" name="phone_number" placeholder="Phone Number"  class="form-control" required>
          </div>
          <div class="form-group">
            <input type="text" name="email" placeholder="Email"  class="form-control" >
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