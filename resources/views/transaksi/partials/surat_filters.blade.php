@php
    $currentYear = (int) date('Y');
    $startYear = $currentYear - 10;
@endphp
<div class="row g-4 mb-7">
    <div class="col-md-4">
        <label class="fw-semibold fs-6 mb-2">Kode Klasifikasi</label>
        <select id="filter_klasifikasi" class="form-select form-select-solid" data-control="select2" data-hide-search="false" data-allow-clear="true">
            <option value="">Semua kode klasifikasi</option>
            @foreach($klasifikasi as $row)
                <option value="{{$row->id_klasifikasi}}">{{$row->kode_klasifikasi}} - {{$row->deskripsi_klasifikasi}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="fw-semibold fs-6 mb-2">Tahun Surat</label>
        <select id="filter_tahun_surat" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-allow-clear="true">
            <option value="">Semua tahun surat</option>
            @for ($year = $currentYear; $year >= $startYear; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="button" class="btn btn-light-danger" id="reset_filter_surat">Reset Filter</button>
    </div>
</div>
