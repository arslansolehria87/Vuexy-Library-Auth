<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
      <i class="icon-base ti tabler-menu-2 icon-md"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    
    <div class="navbar-nav align-items-center w-100">
      <div class="nav-item d-flex align-items-center w-100">
        <i class="icon-base ti tabler-search icon-md me-2 text-muted"></i>
        <input type="text" class="form-control border-0 shadow-none bg-transparent" placeholder="Search [CTRL + K]" aria-label="Search...">
      </div>
    </div>
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      
      <li class="nav-item me-2 me-xl-0">
        <a class="nav-link hide-arrow" href="javascript:void(0);">
          <i class="icon-base ti tabler-language icon-md"></i>
        </a>
      </li>

      <li class="nav-item me-2 me-xl-0">
        <a class="nav-link hide-arrow" href="javascript:void(0);">
          <i class="icon-base ti tabler-sun icon-md"></i>
        </a>
      </li>

      <li class="nav-item me-2 me-xl-0">
        <a class="nav-link hide-arrow" href="javascript:void(0);">
          <i class="icon-base ti tabler-layout-grid-add icon-md"></i>
        </a>
      </li>

      <li class="nav-item me-2 me-xl-0">
        <a class="nav-link hide-arrow" href="javascript:void(0);">
          <span class="position-relative">
            <i class="icon-base ti tabler-bell icon-md"></i>
            <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
          </span>
        </a>
      </li>

     
        </a><ul class="navbar-nav flex-row align-items-center ms-auto">
  <li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
      <div class="avatar avatar-online">
        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />
      </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="{{ route('profile.edit') }}">
          <div class="d-flex">
            <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-medium d-block">{{ Auth::user()->first_name ?? 'Admin' }}</span>
              <small class="text-muted">Admin</small>
            </div>
          </div>
        </a>
      </li>
      <li><div class="dropdown-divider"></div></li>
      
     <li>
        <a class="dropdown-item" href="{{ route('profile.show') }}"> <i class="ti tabler-user me-2 ti-sm"></i>
          <span class="align-middle">My Profile</span>
        </a>
      </li>
      
      <li>
        <a class="dropdown-item" href="{{ route('profile.edit') }}"> <i class="ti tabler-settings me-2 ti-sm"></i>
          <span class="align-middle">Settings</span>
        </a>
      </li>
      
      <li><div class="dropdown-divider"></div></li>
      
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="ti tabler-logout me-2 ti-sm text-danger"></i>
            <span class="align-middle text-danger">Log Out</span>
          </a>
        </form>
      </li>
    </ul>
  </li>
</ul>
  </div>
</nav>