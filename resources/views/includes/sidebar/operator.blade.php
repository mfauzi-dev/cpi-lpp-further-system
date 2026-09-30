<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <!-- BRAND -->
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

            <li class="menu-header">Dashboard</li>

            <!-- DASHBOARD -->
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Operational</li>

            <li class="{{ Request::routeIs('operator.production-batch.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.production-batch.index') }}">
                    <i class="bi bi-boxes"></i>
                    <span>Production Batch</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.suhu-ruang.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.suhu-ruang.index') }}">
                    <i class="bi bi-thermometer-half"></i>
                    <span>Suhu Ruang</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.production.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.production.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Produksi Bahan Baku</span>
                </a>
            </li>

            <li class="menu-header">Grinding</li>

            <li class="{{ Request::routeIs('operator.bowl-cutter.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.bowl-cutter.index') }}">
                    <i class="bi bi-circle-square"></i>
                    <span>Bowl Cutter</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.grinder.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.grinder.index') }}">
                    <i class="bi bi-gear-wide-connected"></i>
                    <span>Grinder</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.preparasi-fla.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.preparasi-fla.index') }}">
                    <i class="bi bi-droplet-half"></i>
                    <span>Preparasi Fla</span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.tumbler.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.tumbler.index') }}">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>
                        Tumbler A/B
                    </span>
                </a>
            </li>

            <li class="menu-header">Mixing</li>

            <li class="{{ Request::routeIs('operator.mixing.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.mixing.index') }}">
                    <i class="bi bi-shuffle"></i>
                    <span>
                        Mixing
                    </span>
                </a>
            </li>

            <li class="menu-header">FORMING</li>

            <li class="{{ Request::routeIs('operator.forming.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.forming.index') }}">
                    <i class="bi bi-boxes"></i>
                    <span>
                        Forming
                    </span>
                </a>
            </li>

            <li class="menu-header">BATTERING</li>

            <li class="{{ Request::routeIs('operator.batter.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.batter.index') }}">
                    <i class="bi bi-moisture"></i>
                    <span>
                        Batter
                    </span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.hlt.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.hlt.index') }}">
                    <i class="fas fa-temperature-high"></i>
                    <span>
                        HLT
                    </span>
                </a>
            </li>

            <li class="menu-header">BREADERING</li>

            <li class="{{ Request::routeIs('operator.predust-breader.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.predust-breader.index') }}">
                    <i class="bi bi-layers"></i>
                    <span>
                        Predust Breader
                    </span>
                </a>
            </li>


            <li class="menu-header">FRYING</li>

            <li class="{{ Request::routeIs('operator.fryer.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.fryer.index') }}">
                    <i class="bi bi-fire"></i>
                    <span>
                        Fryer
                    </span>
                </a>
            </li>

            <li class="menu-header">PEMBEKUAN</li>


            <li class="{{ Request::routeIs('operator.pembekuan.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.pembekuan.index') }}">
                    <i class="fas fa-snowflake"></i>
                    <span>
                        Pembekuan
                    </span>
                </a>
            </li>

            <li class="menu-header">PACKING LUAR</li>

            <li class="{{ Request::routeIs('operator.packing-luar.*') ? 'active' : '' }}">
                <a href="{{ route('operator.packing-luar.index') }}">
                    <i class="fas fa-boxes"></i>
                    <span>
                        Packing Luar
                    </span>
                </a>
            </li>

            <li class="menu-header">PACKING DALAM</li>

            <li class="{{ Request::routeIs('operator.packing-dalam.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.packing-dalam.index') }}">
                    <i class="fas fa-box"></i>
                    <span>
                        Packing Dalam
                    </span>
                </a>
            </li>

            <li class="{{ Request::routeIs('operator.metal-detector.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.metal-detector.index') }}">
                    <i class="fas fa-magnet"></i>
                    <span>
                        Metal Detector
                    </span>
                </a>
            </li>

            <li class="menu-header">KEMASAN RIJEK</li>

            <li class="{{ Request::routeIs('operator.kemasan-rijek.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('operator.kemasan-rijek.index') }}">
                    <i class="fas fa-recycle"></i>
                    <span>
                        Kemasan Rijek
                    </span>
                </a>
            </li>
        </ul>
    </aside>
</div>
