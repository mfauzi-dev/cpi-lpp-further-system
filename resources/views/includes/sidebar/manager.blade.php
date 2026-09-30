<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <div class="sidebar-brand mb-2">
            <a href="#">
                <img src="{{ asset('stisla/dist/assets/img/logo-2.jfif') }}" alt="" width="50px" style="mr-2">
                LPP Further
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm mb-2">
            <a href="#">LPP</a>
        </div>


        <ul class="sidebar-menu">

            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Management</li>

            <li class="{{ Request::routeIs('manager.user.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.user.index') }}">
                    <i class="fas fa-users"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="menu-header">Operational</li>

            <li class="{{ Request::routeIs('manager.production-batch.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.production-batch.index') }}">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Production Batch</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.suhu-ruang.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.suhu-ruang.index') }}">
                    <i class="bi bi-thermometer-half"></i>
                    <span>Suhu Ruang</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.production.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.production.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Produksi Bahan Baku</span>
                </a>
            </li>

            <li
                class="dropdown {{ Request::routeIs('manager.fryer.summary', 'manager.pembekuan.summary') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="bi bi-thermometer-half"></i>
                    <span>Temperature Control Summary Suhu Pusat</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('manager.fryer.summary') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.fryer.summary') }}">
                            <i class="bi bi-fire"></i>
                            <span>Product Fryer</span>
                        </a>
                    </li>

                    <li class="{{ Request::routeIs('manager.pembekuan.summary') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.pembekuan.summary') }}">
                            <i class="bi bi-snow2"></i>
                            <span>Product Pembekuan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Grinding</li>

            <li class="{{ Request::routeIs('manager.bowl-cutter.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.bowl-cutter.index') }}">
                    <i class="bi bi-circle-square"></i>
                    <span>Bowl Cutter</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.grinder.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.grinder.index') }}">
                    <i class="bi bi-gear-wide-connected"></i>
                    <span>Grinder</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.preparasi-fla.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.preparasi-fla.index') }}">
                    <i class="bi bi-droplet-half"></i>
                    <span>Preparasi Fla</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.tumbler.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.tumbler.index') }}">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>
                        Tumbler A/B
                    </span>
                </a>
            </li>

            <li class="menu-header">Mixing</li>

            <li class="{{ Request::routeIs('manager.mixing.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.mixing.index') }}">
                    <i class="bi bi-shuffle"></i>
                    <span>
                        Mixing
                    </span>
                </a>
            </li>

            <li class="menu-header">FORMING</li>

            <li class="{{ Request::routeIs('manager.forming.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.forming.index') }}">
                    <i class="bi bi-boxes"></i>
                    <span>
                        Forming
                    </span>
                </a>
            </li>

            <li class="menu-header">BATTERING</li>

            <li class="{{ Request::routeIs('manager.batter.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.batter.index') }}">
                    <i class="bi bi-moisture"></i>
                    <span>
                        Batter
                    </span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.hlt.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.hlt.index') }}">
                    <i class="fas fa-temperature-high"></i>
                    <span>
                        HLT
                    </span>
                </a>
            </li>

            <li class="menu-header">BREADERING</li>

            <li class="{{ Request::routeIs('manager.predust-breader.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.predust-breader.index') }}">
                    <i class="bi bi-layers"></i>
                    <span>
                        Predust Breader
                    </span>
                </a>
            </li>


            <li class="menu-header">FRYING</li>

            <li class="{{ Request::routeIs('manager.fryer.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.fryer.index') }}">
                    <i class="bi bi-fire"></i>
                    <span>
                        Fryer
                    </span>
                </a>
            </li>

            <li class="menu-header">PEMBEKUAN</li>

            <li class="{{ Request::routeIs('manager.pembekuan.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.pembekuan.index') }}">
                    <i class="fas fa-snowflake"></i>
                    <span>
                        Pembekuan
                    </span>
                </a>
            </li>

            <li class="menu-header">PACKING DALAM</li>

            <li class="{{ Request::routeIs('manager.packing-dalam.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.packing-dalam.index') }}">
                    <i class="fas fa-box"></i>
                    <span>
                        Packing Dalam
                    </span>
                </a>
            </li>

            <li class="{{ Request::routeIs('manager.metal-detector.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.metal-detector.index') }}">
                    <i class="fas fa-magnet"></i>
                    <span>Metal Detector</span>
                </a>
            </li>

            <li class="menu-header">PACKING LUAR</li>

            <li class="{{ Request::routeIs('manager.packing-luar.*') ? 'active' : '' }}">
                <a href="{{ route('manager.packing-luar.index') }}">
                    <i class="fas fa-boxes"></i>
                    <span>
                        Packing Luar
                    </span>
                </a>
            </li>

            <li class="menu-header">KEMASAN RIJEK</li>

            <li class="{{ Request::routeIs('manager.kemasan-rijek.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manager.kemasan-rijek.index') }}">
                    <i class="fas fa-recycle"></i>
                    <span>
                        Kemasan Rijek
                    </span>
                </a>
            </li>
        </ul>
    </aside>
</div>
