@extends('components.layout')

@section('content')
<div class="page">
    <div class="page-main">
        <x-header />
        <x-navbar />
        <div class="my-3 my-md-5">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Semua
                            </div>
                            <h2 class="page-title">
                                Perusahaan
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="ml-auto">
                            <div class="btn-list">
                                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                                    <i class="fe fe-plus"></i>
                                    Perusahaan Baru
                                </a>
                                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                                    <i class="fe fe-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="" class="d-flex flex-row mt-2">
                                    <div class="form-group mr-2">
                                        <label class="form-label">Cari</label>
                                        <input type="text" class="form-control" name="example-password-input" placeholder="Password..">
                                    </div>
                                    <div class="form-group mr-2">
                                        <label class="form-label">Urutkan berdasarkan</label>
                                        <input type="text" class="form-control" name="example-password-input" placeholder="Password..">
                                    </div>
                                    <div class="form-group mr-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button class="btn btn-primary" type="submit">Terapkan</button>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap" style="font-size: .8rem">
                                    <thead>
                                        <tr>
                                            <th class="w-1">Kode</th>
                                            <th>Nama</th>
                                            <th>Regional</th>
                                            <th>CR</th>
                                            <th>DER</th>
                                            <th>DAR</th>
                                            <th>RoA</th>
                                            <th>RoE</th>
                                            <th>BOPO</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($companies) > 0)
                                            @foreach ($companies as $company)
                                            <tr>
                                                <td><span class="text-muted">{{ $company->id }}</span></td>
                                                <td><a href="{{ route('show_company', ['company' => $company->id]) }}" class="text-inherit text-primary">{{ $company->name }}</a></td>
                                                <td>
                                                    {{ $company->regional }}
                                                </td>
                                                <td>
                                                    <abbr title="QtQ" style="text-decoration:none;">39.99%</abbr><br/>
                                                    <abbr title="YoY" style="text-decoration:none;">39.99%</abbr>
                                                </td>
                                                <td>
                                                    <abbr title="QtQ" style="text-decoration:none;">39.99%</abbr><br/>
                                                    <abbr title="YoY" style="text-decoration:none; font-size: .8rem">39.99%</abbr>
                                                </td>
                                                <td>
                                                    <abbr title="QtQ" style="text-decoration:none;">39.99%</abbr><br/>
                                                    <abbr title="YoY" style="text-decoration:none;">39.99%</abbr>
                                                </td>
                                                <td>
                                                    <abbr title="QtQ" style="text-decoration:none;">39.99%</abbr><br/>
                                                    <abbr title="YoY" style="text-decoration:none;">39.99%</abbr>
                                                </td>
                                                <td>
                                                    <abbr title="QtQ" style="text-decoration:none;">39.99%</abbr><br/>
                                                    <abbr title="YoY" style="text-decoration:none;">39.99%</abbr>
                                                </td>
                                                <td>
                                                    <abbr title="QtQ" style="text-decoration:none;">39.99%</abbr><br/>
                                                    <abbr title="YoY" style="text-decoration:none;">39.99%</abbr>
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
                                            <tr><td colspan="11">Belum ada data..</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $companies->links() }}
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