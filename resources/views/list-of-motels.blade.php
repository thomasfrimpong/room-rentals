
@extends('layout.app')
@section('content')
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex"> --}}
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div> --}}
      {{-- </div> --}}

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="/super/admin/dashboard" class="nav-link">
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
               <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                   Motels
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item ">
                    <a href="/add-motel-page" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Motel</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/list-of-motels" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List Of Motel</p>
                    </a>
                  </li>
                 
                </ul>
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
   
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">List Of Motels</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                        
                      <tr>
                        <th >#</th>
                        <th>Motel Name</th>
                        <th>Location</th>
                        <th >Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($motels) as $key=> $motel)
                      <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$motel->motel_name}}</td>
                        <td>
                            {{$motel->location}}
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="status"  value={{$motel->id}} @if($motel->active)  checked @endif>
                                <span class="slider round"></span>
                              </label>
                        </td>
                      </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
       
   
</section>
  <!-- /.content-wrapper -->
</div>
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @endsection
  