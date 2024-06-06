  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- Dashboard sidebar menu link -->
          <li class="nav-item">
                <a href="./index.php" class="nav-link active">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Equipment
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">   
              <li class="nav-item">
                <a href="add_equipment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Equipment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_equipment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show equipment</p>
                </a>
              </li>
            </ul>
          </li>
      
<!-- Users entity  -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">   
              <li class="nav-item">
                <a href="add_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="show_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage users</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item">
            <a href="reserve_item.php" class="nav-link">
              <i class="nav-icon fas fa-flask"></i>
              <p>
                Reserve
                <!-- <i class="fas fa-angle-left right"></i> -->
                <span class="badge badge-info right"></span>
              </p>
            </a>
           </li>
          <!-- <li class="nav-header">EXAMPLES</li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
