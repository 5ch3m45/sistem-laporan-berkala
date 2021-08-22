<div>
  <div class="card mb-3 border-0 shadow-secondary">
    <div class="card-body">
      <p class="fw-bold">SUBMENU</p>
      <hr>
      <ul style="list-style-type: none; padding-left: .5rem">
        @if ($cid)
        <li>
          <a href="{{ route('note', ['company' => $cid]) }}" @if ($active == 'company_notes') class="disabled text-primary" @endif>Catatan</a>
        </li>
        <li>
          <a href="{{ route('report', ['company' => $cid]) }}" @if ($active == 'company_reports') class="disabled text-primary" @endif>Data Laporan</a>
        </li>
        <li>
          <a href="{{ route('company_file', ['company' => $cid]) }}" @if ($active == 'company_files') class="disabled text-primary" @endif>File</a>
        </li>
        <li>
          <a href="{{ route('show_company', ['company' => $cid]) }}" @if ($active == 'company_index') class="disabled text-primary" @endif>Informasi</a>
        </li>
        <li>
          <a href="{{ route('stats', ['company_id' => $cid]) }}" @if ($active == 'company_stats') class="disabled text-primary" @endif>Statistik</a>
        </li>
        @else
        <li>
          <a href="{{ route('all_company') }}" class="">Semua Perusahaan</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
  <div class="card mb-3 border-0 shadow-secondary">
    <div class="card-body">
      <p class="fw-bold">BARU</p>
      <hr>
      <ul style="list-style-type: none; padding-left: .5rem">
        <li>
          <a href="{{ route('create_company') }}" class="">Perusahaan baru</a>
        </li>
        @if ($cid)
        <li>
          <a href="{{ route('upload_file', ['company' => $cid]) }}" @if ($active == 'company_file_upload') class="disabled text-primary" @endif>File baru</a>
        </li>
        <li>
          <a href="{{ route('create_note', ['company' => $cid]) }}" @if ($active == 'company_note_create') class="disabled text-primary" @endif>Catatan baru</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
  @if ($cid)
  <div class="card mb-3 border-0 shadow-secondary">
    <div class="card-body">
      <p class="fw-bold">UNDUH FILE</p>
      <hr>
      <ul style="list-style-type: none; padding-left: .5rem">
        <li>
          <a href="/perusahaan/{{ $cid }}/export-excel" class="">Laporan</a>
        </li>
      </ul>
    </div>
  </div>
  @endif
</div>