<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{BASE_URL}}" class="brand-link">
      <img src="{{ ADMIN_ASSET_URL }}dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Lê Hoàng hải</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ ADMIN_ASSET_URL }}dist/img/avatarH.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Ostar</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item has-treeview">
            <a href="{{route('admin.admin')}}" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                  Home 
              </p>
            </a>
          </li>

      <!-- user -->
      <li class="nav-item has-treeview">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                
                <a href="{{route('admin.users.index')}}" class="nav-link">
                  <i class="fa fa-list-ol nav-icon"></i>
                  <p>Danh sách nguời dùng</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('admin.users.create' )}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Thêm mới người dùng</p>
                </a>
              </li>
      
            </ul>
          </li>

  <!-- user -->
          <li class="nav-item has-treeview">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Sản Phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('admin.products.index')}}" class="nav-link">
                  <i class="fa fa-list-ol nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('admin.products.create' )}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Thêm sản phẩm mới</p>
                </a>
              </li>
      
            </ul>
          </li>

<!-- sp -->
          <li class="nav-item has-treeview">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
            
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('admin.categories.index')}}" class="nav-link">
                  <i class="fa fa-list-ol nav-icon"></i>
                  <p>Danh sách categories</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('admin.categories.create' )}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Thêm mới categories</p>
                </a>
              </li>
      
            </ul>
          </li>
    
  <!-- cc -->
  <li class="nav-item has-treeview">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
               Comments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
               <a href="" class="nav-link">
                  <i class="fa fa-list-ol nav-icon"></i>
                  <p>Danh sách comment</p>
                </a>
              </li>
             
      
            </ul>
          </li>
    <!-- cc       -->

  <!-- cc -->
          <li class="nav-item has-treeview">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
               Invoices
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('admin.order.index' )}}" class="nav-link">
                  <i class="fa fa-list-ol nav-icon"></i>
                  <p>Danh sách hóa đơn</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Thêm hóa đơn mới</p>
                </a>
              </li>
      
            </ul>
          </li>
    <!-- cc       -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>