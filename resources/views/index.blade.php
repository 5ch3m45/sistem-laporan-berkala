@extends('components.layout')

@section('content')
<div class="page">
    <div class="page-main">
        <x-header />
        <x-navbar />
        <div class="my-3 my-md-5">
            <div class="container-fluid">
                <div class="page-header">
                    <h1 class="page-title">
                        Dashboard
                    </h1>
                </div>
                <div class="row row-cards">
                    <div class="col-6 col-sm-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="bg-danger text-light d-flex justify-content-center align-items-center px-4">
                                        <i class="fe fe-briefcase"></i>
                                    </div>
                                    <div class="ml-2">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Perusahaan</div>
                                        </div>
                                        <div class="h1 mb-3">{{ $company_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="bg-warning text-light d-flex justify-content-center align-items-center px-4">
                                        <i class="fe fe-folder"></i>
                                    </div>
                                    <div class="ml-2">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Berkas</div>
                                        </div>
                                        <div class="h1 mb-3">{{ $file_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="bg-success text-light d-flex justify-content-center align-items-center px-4">
                                        <i class="fe fe-file-text"></i>
                                    </div>
                                    <div class="ml-2">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Laporan</div>
                                        </div>
                                        <div class="h1 mb-3">{{ $report_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="bg-primary text-light d-flex justify-content-center align-items-center px-4">
                                        <i class="fe fe-user"></i>
                                    </div>
                                    <div class="ml-2">
                                        <div class="d-flex align-items-center">
                                            <div class="subheader">Admin</div>
                                        </div>
                                        <div class="h1 mb-3">{{ $user_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row row-cards row-deck">
                    
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kenaikan Aset tertinggi</h4>
                            </div>
                            <table class="table card-table">
                                <tr>
                                    <td width="1"><i class="fa fa-chrome text-muted"></i></td>
                                    <td>Google Chrome</td>
                                    <td class="text-right"><span class="text-muted">23%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-firefox text-muted"></i></td>
                                    <td>Mozila Firefox</td>
                                    <td class="text-right"><span class="text-muted">15%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-safari text-muted"></i></td>
                                    <td>Apple Safari</td>
                                    <td class="text-right"><span class="text-muted">7%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-internet-explorer text-muted"></i></td>
                                    <td>Internet Explorer</td>
                                    <td class="text-right"><span class="text-muted">9%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-opera text-muted"></i></td>
                                    <td>Opera mini</td>
                                    <td class="text-right"><span class="text-muted">23%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-edge text-muted"></i></td>
                                    <td>Microsoft edge</td>
                                    <td class="text-right"><span class="text-muted">9%</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Kenaikan Liabilitas Tertinggi</h2>
                            </div>
                            <table class="table card-table">
                                <tr>
                                    <td>Admin Template</td>
                                    <td class="text-right">
                                        <span class="badge badge-default">65%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Landing Page</td>
                                    <td class="text-right">
                                        <span class="badge badge-success">Finished</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Backend UI</td>
                                    <td class="text-right">
                                        <span class="badge badge-danger">Rejected</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Personal Blog</td>
                                    <td class="text-right">
                                        <span class="badge badge-default">40%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-mail Templates</td>
                                    <td class="text-right">
                                        <span class="badge badge-default">13%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Corporate Website</td>
                                    <td class="text-right">
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kenaikan Ekuitas Tertinggi</h3>
                            </div>
                            <div class="card-body o-auto" style="height: 15rem">
                                <ul class="list-unstyled list-separated">
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/12.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Amanda Hunt</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">amanda_hunt@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/21.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Laura Weaver</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">lauraweaver@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/29.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Margaret Berry</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">margaret88@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/2.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Nancy Herrera</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">nancy_83@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/male/34.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Edward Larson</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">edward90@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/11.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Joan Hanson</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">joan.hanson@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Perusahaan Terakhir Ditambahkan</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap" style="font-size: .8rem">
                                    <thead>
                                        <tr>
                                            <th class="w-1">Kode</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Regional</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>Alamat</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($last_companies) > 0)
                                            @foreach ($last_companies as $company)
                                            <tr>
                                                <td><span class="text-muted">{{ $company->code }}</span></td>
                                                <td><a href="{{ route('show_company', ['company' => $company->id]) }}" class="text-inherit">{{ $company->name }}</a></td>
                                                <td>
                                                    {{ $company->regional }}
                                                </td>
                                                <td>
                                                    {{ $company->email }}
                                                </td>
                                                <td>
                                                    {{ $company->phone }}
                                                </td>
                                                <td>
                                                    {{ $company->add_road.', '.$company->regional.', '.$company->add_province }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="icon" href="javascript:void(0)">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8">Belum ada data...</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" style="height: calc(24rem + 10px)">
                            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                              <div class="divide-y">
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar">JL</span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Jeffie Lewzey</strong> commented on your <strong>"I'm not a witch."</strong> post.
                                      </div>
                                      <div class="text-muted">yesterday</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                      <div class="badge bg-primary"></div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        It's <strong>Mallory Hulme</strong>'s birthday. Wish him well!
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                      <div class="badge bg-primary"></div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/003m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Dunn Slane</strong> posted <strong>"Well, what do you want?"</strong>.
                                      </div>
                                      <div class="text-muted">today</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                      <div class="badge bg-primary"></div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/000f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Emmy Levet</strong> created a new project <strong>Morning alarm clock</strong>.
                                      </div>
                                      <div class="text-muted">4 days ago</div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                      <div class="badge bg-primary"></div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/001f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Maryjo Lebarree</strong> liked your photo.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar">EP</span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Egan Poetz</strong> registered new client as <strong>Trilia</strong>.
                                      </div>
                                      <div class="text-muted">yesterday</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/002f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Kellie Skingley</strong> closed a new deal on project <strong>Pen Pineapple Apple Pen</strong>.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/003f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Christabel Charlwood</strong> created a new project for <strong>Wikibox</strong>.
                                      </div>
                                      <div class="text-muted">4 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar">HS</span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Haskel Shelper</strong> change status of <strong>Tabler Icons</strong> from <strong>open</strong> to <strong>closed</strong>.
                                      </div>
                                      <div class="text-muted">today</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/006m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Lorry Mion</strong> liked <strong>Tabler UI Kit</strong>.
                                      </div>
                                      <div class="text-muted">yesterday</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/004f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Leesa Beaty</strong> posted new video.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/007m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Perren Keemar</strong> and 3 others followed you.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar">SA</span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Sunny Airey</strong> upload 3 new photos to category <strong>Inspirations</strong>.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/009m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Geoffry Flaunders</strong> made a <strong>$10</strong> donation.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/010m.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Thatcher Keel</strong> created a profile.
                                      </div>
                                      <div class="text-muted">3 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/005f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Dyann Escala</strong> hosted the event <strong>Tabler UI Birthday</strong>.
                                      </div>
                                      <div class="text-muted">4 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar" style="background-image: url(./static/avatars/006f.jpg)"></span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Avivah Mugleston</strong> mentioned you on <strong>Best of 2020</strong>.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-auto">
                                      <span class="avatar">AA</span>
                                    </div>
                                    <div class="col">
                                      <div class="text-truncate">
                                        <strong>Arlie Armstead</strong> sent a Review Request to <strong>Amanda Blake</strong>.
                                      </div>
                                      <div class="text-muted">2 days ago</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-primary">Dalam masalah? <a href="./docs/index.html" class="alert-link">Baca halaman bantuan</a>.</div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">BOPO Triwulan Terakhir</h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-donut" style="height: 12rem;"></div>
                                    </div>
                                </div>
                                <script>
                                    require(['c3', 'jquery'], function(c3, $) {
                                        $(document).ready(function() {
                                            var chart = c3.generate({
                                                bindto: '#chart-donut', // id of chart wrapper
                                                data: {
                                                    columns: [
                                                        // each columns data
                                                        ['data1', 63],
                                                        ['data2', 37]
                                                    ],
                                                    type: 'donut', // default type of chart
                                                    colors: {
                                                        'data1': tabler.colors["green"],
                                                        'data2': tabler.colors["green-light"]
                                                    },
                                                    names: {
                                                        // name of each serie
                                                        'data1': 'Maximum',
                                                        'data2': 'Minimum'
                                                    }
                                                },
                                                axis: {},
                                                legend: {
                                                    show: false, //hide legend
                                                },
                                                padding: {
                                                    bottom: 0,
                                                    top: 0
                                                },
                                            });
                                        });
                                    });
                                </script>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">POJK 31/POJK.05/2016</h3>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-pie" style="height: 12rem;"></div>
                                    </div>
                                </div>
                                <script>
                                    require(['c3', 'jquery'], function(c3, $) {
                                        $(document).ready(function() {
                                            var chart = c3.generate({
                                                bindto: '#chart-pie', // id of chart wrapper
                                                data: {
                                                    columns: [
                                                        // each columns data
                                                        ['data1', 63],
                                                        ['data2', 44],
                                                        ['data3', 12],
                                                        ['data4', 14]
                                                    ],
                                                    type: 'pie', // default type of chart
                                                    colors: {
                                                        'data1': tabler.colors["blue-darker"],
                                                        'data2': tabler.colors["blue"],
                                                        'data3': tabler.colors["blue-light"],
                                                        'data4': tabler.colors["blue-lighter"]
                                                    },
                                                    names: {
                                                        // name of each serie
                                                        'data1': 'A',
                                                        'data2': 'B',
                                                        'data3': 'C',
                                                        'data4': 'D'
                                                    }
                                                },
                                                axis: {},
                                                legend: {
                                                    show: false, //hide legend
                                                },
                                                padding: {
                                                    bottom: 0,
                                                    top: 0
                                                },
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">First link</a></li>
                                <li><a href="#">Second link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Third link</a></li>
                                <li><a href="#">Fourth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Fifth link</a></li>
                                <li><a href="#">Sixth link</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Other link</a></li>
                                <li><a href="#">Last link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    Premium and Open Source dashboard template with responsive and high quality UI. For Free!
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <a href="https://github.com/tabler/tabler" class="btn btn-outline-primary btn-sm">Source code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href=".">Tabler</a>. Theme by <a href="https://codecalm.net" target="_blank">codecalm.net</a> All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection