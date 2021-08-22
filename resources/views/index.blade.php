@extends('components.layout')
@section('content')
<div class="container body">
  <div class="main_container">
    <x-sidenav active="dashboard" />
    <x-topnav />
    <div class="right_col" role="main">
      <div class="row tile_count" style="width: 100%">
        <div class="col-md-3 col-sm-6 col-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-building"></i> Perusahaan</span>
          <div class="count">{{ $company_total }}</div>
          <span class="count_bottom">Total</span>
        </div>
        <div class="col-md-3 col-sm-6 col-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-upload"></i> File Diunggah</span>
          <div class="count">{{ \App\Models\File::count() }}</div>
          <span class="count_bottom">Total</span>
        </div>
        <div class="col-md-3 col-sm-6 col-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Laporan Dibuat</span>
          <div class="count">{{ \App\Models\Report::count() }}</div>
          <span class="count_bottom">Total</span>
        </div>
        <div class="col-md-3 col-sm-6 col-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Admin Aktif</span>
          <div class="count">{{ \App\Models\User::count() }}</div>
          <span class="count_bottom">Total</span>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-sm-8 ">
          <div class="x_panel tile">
            <div class="x_title">
              <h2>Perusahaan Terakhir Ditambahkan</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="col-md-12 col-sm-12 ">
                <table class="table table-striped table-hover">
                  <thead style="background-color: #2A3F54">
                    <tr class="text-white">
                      <th>Nama perusahaan</th>
                      <th>Regional</th>
                      <th>Email</th>
                      <th>Telefon</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($last_companies) < 1) <tr>
                      <td colspan="5">Belum ada data...</td>
                      </tr>
                      @else
                      @foreach ($last_companies as $company)
                      <tr>
                        <td>
                          <a href="{{ route('show_company', ['company' => $company->id]) }}">{{ $company->name }}</a>
                        </td>
                        <td>{{ $company->regional }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->phone }}</td>
                      </tr>
                      @endforeach
                      @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>File Terakhir Diunggah</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                      </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="quick-list w-100">
                    @foreach ($last_files as $file)
                    <li>
                      <i class="fa fa-file"></i><a href="#">{{ $file->name }} <em style="color: #bbb; font-size: .7rem">{{ $file->company->name }}</em></a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Laporan Terakhir Dibuat</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                      </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="quick-list w-100">
                    @foreach ($last_reports as $report)
                    <li>
                      <i class="fa fa-clipboard"></i><a href="#">{{ $report->company->name }} <em style="color: #bbb; font-size: .7rem">{{ $report->year.'/'.$report->quarter }}</em></a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="x_panel">
            <div class="x_title">
              <h2>Recent Activities <small>Sessions</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">

                <ul class="list-unstyled timeline widget">
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                          <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                        </h2>
                        <div class="byline">
                          <span>13 hours ago</span> by <a>Jane Smith</a>
                        </div>
                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                          <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                        </h2>
                        <div class="byline">
                          <span>13 hours ago</span> by <a>Jane Smith</a>
                        </div>
                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                          <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                        </h2>
                        <div class="byline">
                          <span>13 hours ago</span> by <a>Jane Smith</a>
                        </div>
                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                          <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                        </h2>
                        <div class="byline">
                          <span>13 hours ago</span> by <a>Jane Smith</a>
                        </div>
                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                        </p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection