@if (\Request::is('/'))  
  <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
  @else
  <aside class="mdc-drawer mdc-drawer--dismissible ">
@endif


      <div class="mdc-drawer__header">

        <a href="{{ route('dashboard') }}" class="brand-logo">
          <img src="{{ asset('assets-admin/images/favicon.png') }}" width="40%">
          <br>
          <font color="white"><B>e-MONAS</B>
          <br>
          Monitoring Anggaran Satker</font>
          {{-- <img src="{{ asset('assets-admin/images/logo.svg') }}" alt="logo"> --}}
        </a>
      </div>
      <div class="mdc-drawer__content">
        <div class="user-info">
          <p class="name">{{ Auth::user()->name }}</p>
          <p class="email">{{ Auth::user()->email }}</p>
        </div>
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{ route('dashboard') }}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">home</i>
                Dashboard
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{ route('sp2d') }}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
                SP2D
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{ route('realisasi.fisik') }}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">description</i>
                Realisasi Fisik
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{ route('lkka') }}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">grid_on</i>
                LKKA
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{ route('lap.monev') }}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">web</i>
                Laporan Monev
              </a>
            </div>
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{ route('lap.monev') }}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">supervisor_account  </i>
                User Management
              </a>
            </div>
          </nav>
        </div>
        <div class="profile-actions">
          <a href="javascript:;">Panduan</a>
          <span class="divider"></span>
          <a href="{!! route('logout') !!}">Logout</a>
        </div>
        
      </div>
    </aside>