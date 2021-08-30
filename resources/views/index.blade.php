@extends('components.layout')

@section('content')
<div class="page">
    <div class="page-main">
        <x-header />
        <x-navbar active="dashboard"/>
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
                                <h4 class="card-title">Kenaikan Aset Tertinggi Triwulan Terakhir</h4>
                            </div>
                            <table class="table card-table">
                                @foreach ($company_stat->sortByDesc('asset_qtq')->take(5) as $stat)
                                <tr>
                                    <td>{{ $stat['company_name'] }}</td>
                                    <td class="text-right"><span class="text-muted">{{ $stat['asset_qtq'] }}%</span></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Kenaikan Liabilitas Tertinggi Triwulan Terakhir</h2>
                            </div>
                            <table class="table card-table">
                                @foreach ($company_stat->sortByDesc('liability_qtq')->take(5) as $stat)
                                <tr>
                                    <td>{{ $stat['company_name'] }}</td>
                                    <td class="text-right"><span class="text-muted">{{ $stat['liability_qtq'] }}%</span></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kenaikan Ekuitas Tertinggi Triwulan Terakhir</h3>
                            </div>
                            <table class="table card-table">
                                @foreach ($company_stat->sortByDesc('equity_qtq')->take(5) as $stat)
                                <tr>
                                    <td>{{ $stat['company_name'] }}</td>
                                    <td class="text-right"><span class="text-muted">{{ $stat['equity_qtq'] }}%</span></td>
                                </tr>
                                @endforeach
                            </table>
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