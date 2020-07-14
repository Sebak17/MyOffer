<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('pageAdminDashboard') }}" class="brand-link text-center">
    <i class="fas fa-atom" style="opacity: .8"></i>
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
  </a>
  
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image text-white">
        <i class="fas fa-user-astronaut fa-2x"></i>
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::guard('admin')->user()->login }}</a>
      </div>
    </div>
    
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('pageAdminDashboard') }}" class="nav-link {{ ( isset($menuItem_dashboard) ? 'active' : '') }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Panel główny</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>