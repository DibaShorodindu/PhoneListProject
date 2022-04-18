<section class="section-dashboard--sidebar">
    <!-- START MENU -->
    <nav class="menubar">
        <ul class="menu d-flex flex-column">
            <li class="">
                <a href="dashboard.html" class="navbar-brand">
                    <img src="{{ asset('/') }}adminAsset/assets/images/logo--company-name.png" alt="logo" />
                </a>
            </li>
            <li class="menu-item @yield('active')">
                <a href="{{ route('/adminDashboard') }}">
                    <i class="bi bi-collection menu-item--icon "></i>
                    <span class="menu-item--text ">
                Dashboard
              </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('view-all') }}">
                    <i class="bi bi-files menu-item--icon "></i>
                    <span class="menu-item--text ">
                View All Data
              </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <i class="bi bi-person-badge menu-item--icon "></i>
                    <span class="menu-item--text ">
                User Details
              </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <i class="bi bi-box-arrow-in-down menu-item--icon "></i>
                    <span class="menu-item--text ">
                User Data Import
              </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <i class="bi bi-bar-chart menu-item--icon"></i>
                    <span class="menu-item--text">
                Order History
              </span>
                </a>
            </li>
            </a>
            <li class="menu-item">
                <a href="">
                    <i class="bi bi-currency-bitcoin menu-item--icon"></i>
                    <span class="menu-item--text">
                Credit History
              </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <i class="bi bi-arrow-left-right menu-item--icon"></i>
                    <span class="menu-item--text">
                Credit Transfer
              </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <i class="bi bi-wallet2 menu-item--icon"></i>
                    <span class="menu-item--text">
                Payment Settings
              </span>
                </a>
            </li>
            <li class="menu-item menu-item-footer">
                <a href="{{ route('home') }}">
                    <i class="bi bi-power menu-item--icon"></i>
                    <span class="menu-item--text">
                Logout
              </span>
                </a>
            </li>
            </a>
        </ul>
    </nav>
    <!-- END MENU -->
</section>
