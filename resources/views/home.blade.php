@extends('layouts.app')

@section('content')
<!--begin::Toolbar-->
<div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column me-3">
        <!--begin::Title-->
        <h1 class="d-flex text-gray-900 fw-bold my-1 fs-3">Dashboards</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->
<div class="content flex-column-fluid" id="kt_content">
    
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 16-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #080655">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$count_surat_masuk}}</span>
                        <span class="text-white pt-1 fw-semibold fs-6">Total Surat Masuk</span>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">                   
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Unprocessed</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_unprocess}}</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">On Process</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_onprocess}}</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Selesai</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_selesai}}</div>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 16-->
            <!--begin::Card widget 7-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10" style="background-color:#00496e">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$count_surat_keluar}}
                        </div>
                        <span class="text-white pt-1 fw-semibold fs-6">Total Surat Keluar</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">                   
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Internal</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_surat_keluar_internal}}</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Eksternal</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_surat_keluar_eksternal}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card widget 7-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 17-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10" style="background-color:#610539">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">Statistik</span>
                        </div>
                        <span class="text-white pt-1 fw-semibold fs-6">Top 3 Kategori Surat Keluar</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">                    
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                    @foreach($top_3 as $row)
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">{{$row->deskripsi}}</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$row->jumlah_pemakaian}}</div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-flush h-md-50 mb-5 mb-xl-10" style="background-color: #024715">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">Statistik</span>
                        </div>
                        <span class="text-white pt-1 fw-semibold fs-6">Top 3 Tujuan Surat Keluar</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">                   
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Pimpinan</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_pimpinan}}</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Kesekretariatan</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_kesekretariatan}}</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Kepaniteraan</div>
                            <div class="fw-bolder text-white text-xxl-end">{{$count_kepaniteraan}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::LIst widget 25-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <!--end::Row-->

</div>
<!--end::Post-->
@endsection
@push('scripts')

@endpush