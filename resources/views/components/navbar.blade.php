<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                    <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </form>
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active"><i class="fe fe-home"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company') }}" class="nav-link"><i class="fe fe-briefcase"></i> Perusahaan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company') }}" class="nav-link"><i class="fe fe-folder"></i> Berkas</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company') }}" class="nav-link"><i class="fe fe-file-text"></i> Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('company') }}" class="nav-link"><i class="fe fe-feather"></i> Catatan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>