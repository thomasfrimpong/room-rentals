
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
                <a href="/super/admin/dashboard" class="nav-link active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                    
                  </p>
                </a>
              </li>
           <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Motels
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/add-motel-page" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Motel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/list-of-motels" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Of Motel</p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
              <a href="/add-admin" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Admin</p>
              </a>
            </li>
          </li> 
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                
              </p>
            </a>
          </li> --}}
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
            <h1 class="m-0">Overview Of Motels</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->

    <!-- Main content -->
   
  <section class="content">
  
  <div class="row">
    @foreach(json_decode($motels) as $motel)
    <div class="col-lg-3 col-6">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">{{$motel->motel_name}}</span>
        <span class="info-box-number">
          
          {{$motel->location}}
          {{-- <small>%</small> --}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    </div>
    @endforeach
  </div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @endsection
  