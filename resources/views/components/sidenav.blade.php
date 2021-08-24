<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Excelyssa!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Selamat datang,</span>
                <h2>{{ \Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu Utama</h3>
                <ul class="nav side-menu">
                    <li class="{{ $active == 'dashboard' ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-columns"></i> Dashboard</a></li>
                    <li class="{{ $active == 'perusahaan' ? 'active' : '' }}"><a href="{{ route('all_company') }}"><i class="fa fa-building"></i> Perusahaan</a></li>
                </ul>
            </div>
            @if($companyid)
            <div class="menu_section">
                <h3>Menu Perusahaan </h3>
                <ul class="nav side-menu">
                    <li class="{{ $active == 'informasi' ? 'active' : '' }}"><a><i class="fa fa-info-circle"></i> Informasi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="{{ $active == 'informasi' ? 'display:block;' : '' }}">
                            <li><a href="{{ route('show_company', ['company' => $companyid]) }}">Informasi Perusahaan</a></li>
                            <li><a href="{{ route('employe', ['company' => $companyid]) }}">Anggota Perusahaan</a></li>
                            <li><a href="{{ route('stats', ['company' => $companyid]) }}">Statistik Perusahaan</a></li>
                        </ul>
                    </li>
                    <li class="{{ $active == 'analisis' ? 'active' : '' }}"><a href="{{ route('analysis', ['company' => $companyid]) }}"><i class="fa fa-calendar"></i> Analisis Tahunan</a></li>
                    <li class="{{ $active == 'catatan' ? 'active' : '' }}"><a href="{{ route('note', ['company' => $companyid]) }}"><i class="fa fa-sticky-note"></i> Catatan</a></li>
                    <li class="{{ $active == 'file' ? 'active' : '' }}"><a href="{{ route('company_file', ['company' => $companyid]) }}"><i class="fa fa-file"></i> File</a></li>
                    <li class="{{ $active == 'laporan' ? 'active' : '' }}"><a href="{{ route('report', ['company' => $companyid]) }}"><i class="fa fa-clipboard"></i> Laporan</a></li>
                </ul>
            </div>
            @endif
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>