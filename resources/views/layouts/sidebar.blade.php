<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">SBUTK</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="nav-item dropdown {{(request()->is('home')) ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="/home">Dashboard Utama</a></li>
              <li><a class="nav-link" href="/home/bulan">Dashboard Bulanan</a></li>
            </ul>
          </li>

          <li class="menu-header">Faktur</li>
          <li class="{{(request()->is('admin/faktur')) ? 'active' : ''}}"><a class="nav-link" href="/admin/faktur"><i class="fas fa-pencil-ruler"></i> <span>Data Faktur Penjualan</span></a></li>
        
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Excel Data (csv)</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="/admin/faktur_import">Import Data</a></li>
              <li><a class="nav-link" href="/admin/faktur_export">Export Data</a></li>
            </ul>
          </li>

          <li class="menu-header">Sales</li>
          <li class="{{(request()->is('admin/sales')) ? 'active' : ''}}" ><a class="nav-link" href="/admin/sales"><i class="far fa-square"></i> <span>Data Sales</span></a></li>

          <li class="menu-header">Wilayah</li>
          <li class="{{(request()->is('admin/wilayah')) ? 'active' : ''}}" ><a class="nav-link" href="/admin/wilayah"><i class="far fa-square"></i> <span>Data Wilayah</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="/" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Ke Halaman Utama
          </a>
        </div>
    </aside>
  </div>