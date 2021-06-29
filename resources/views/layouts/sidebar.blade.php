<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">SBUPTK</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">

              <li class="menu-header">Dashboard</li>
              <li class="{{(request()->is('home')) ? 'active' : ''}}" ><a class="nav-link" href="/home"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
           

              <li class="menu-header">Sales</li>
              <li class="{{(request()->is('admin/sales')) ? 'active' : ''}}" ><a class="nav-link" href="/admin/sales"><i class="far fa-square"></i> <span>Data Sales</span></a></li>

              <li class="menu-header">Faktur</li>


              <li><a class="nav-link" href="/admin/penjualan"><i class="fas fa-pencil-ruler"></i> <span>Data Penjualan</span></a></li>
            
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Excel Data (csv)</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="/admin/penjualan_import">Import Data</a></li>
                  <li><a class="nav-link" href="/admin/penjualan/export">Export Data</a></li>
                </ul>
              </li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div>
        </aside>
      </div>