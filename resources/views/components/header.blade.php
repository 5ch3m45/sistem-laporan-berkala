<div class="header py-4">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="/">
                <img src="/assets/images/logo.png" style="width: 100%; height: 2.8rem" class="header-brand-img" alt="tabler logo">
            </a>
            @php
                function nameAlias($name) {
                    $alias = array();
                    foreach (explode(' ', $name) as $string) {
                        array_push($alias, strtoupper($string[0]));
                    }
                    return implode($alias);
                }
            @endphp
            <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="avatar avatar-rounded">{{ nameAlias(\Auth::user()->name) }}</span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">{{ \Auth::user()->name }}</span>
                            <small class="text-muted d-block mt-1">Administrator</small>
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fe fe-power"></i> Keluar</a></li>
                    </ul>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>