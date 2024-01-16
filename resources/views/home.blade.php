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
                        <span class="text-white pt-1 fw-semibold fs-6">Surat Masuk</span>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end pt-0">
                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                        <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!--end::Progress-->
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
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$count_surat_keluar}}</span>
                        </div>
                        <span class="text-white pt-1 fw-semibold fs-6">Surat keluar</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">Internal</div>
                            <div class="fw-bolder text-white opacity-50 text-xxl-end">{{$count_surat_keluar_internal}}</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center my-3">
                            <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                            <div class="text-white opacity-50 flex-grow-1 me-4">External</div>
                            <div class="fw-bolder text-white opacity-50 text-xxl-end">{{$count_surat_keluar_eksternal}}</div>
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
                        <span class="text-white pt-1 fw-semibold fs-6">Top 3 Penggunaan Nomor Teratas</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                    </div>
                    
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                    @foreach($top_3 as $row)
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-gray-500 flex-grow-1 me-4">{{$row->deskripsi}}</div>
                            <div class="fw-bolder text-white opacity-50 text-xxl-end">{{$row->jumlah_pemakaian}}</div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center">
                            <span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">$</span>
                            <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">69,700</span>
                            <span class="badge badge-light-success fs-base">
                            <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>2.2%</span>
                        </div>
                        <span class="text-gray-500 pt-1 fw-semibold fs-6">Disposisi</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <div class="d-flex fw-semibold align-items-center">
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <div class="text-gray-500 flex-grow-1 me-4">Leaf CRM</div>
                            <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                        </div>
                        <div class="d-flex fw-semibold align-items-center my-3">
                            <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                            <div class="text-gray-500 flex-grow-1 me-4">Mivy App</div>
                            <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::LIst widget 25-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
            <!--begin::Timeline widget 3-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">What’s up Today</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Surat Keluar Terbaru</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-7 px-0">
                    <!--begin::Nav-->
                    <!--end::Nav-->
                    <!--begin::Tab Content (ishlamayabdi)-->
                    <div class="tab-content mb-2 px-9">
                        @foreach($top_3_surat as $row)
                        <div class="tab-pane fade show active" id="kt_timeline_widget_3_tab_content_4">
                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Bullet-->
                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>
                                <!--end::Bullet-->
                                <!--begin::Info-->
                                <div class="flex-grow-1 me-5">
                                    <!--begin::Time-->
                                    <div class="text-gray-800 fw-semibold fs-3">{{$row->no_surat}} </div>
                                    <!--end::Time-->
                                    <!--begin::Description-->
                                    <div class="text-gray-700 fw-semibold fs-6"><?php echo substr($row->perihal, 0, 20); ?></div>
                                    <!--end::Description-->
                                    <!--begin::Link-->
                                    <div class="text-gray-500 fw-semibold fs-7">{{$row->tgl_surat}}</div>
                                    <!--end::Link-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <!--end::Wrapper-->
                        </div>
                        @endforeach
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        
                        <!--end::Tap pane-->
                    </div>
                    <!--end::Tab Content-->
                    <!--begin::Action-->
                    <div class="float-end d-none">
                        <a href="#" class="btn btn-sm btn-light me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">Add Lesson</a>
                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Call Sick for Today</a>
                    </div>
                    <!--end::Action-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Timeline widget 3-->
            <!--begin::Timeline widget 3-->
            <div class="card card-flush d-none h-md-100">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title flex-column">
                        <h3 class="fw-bold mb-1">What's on the road?</h3>
                        <div class="fs-6 text-gray-500">Total 482 participants</div>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Select-->
                        <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bold w-100px">
                            <option value="1" selected="selected">Options</option>
                            <option value="2">Option 1</option>
                            <option value="3">Option 2</option>
                            <option value="4">Option 3</option>
                        </select>
                        <!--end::Select-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Dates-->
                    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2 ms-4">
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_0">
                                <span class="text-gray-500 fs-7 fw-semibold">Fr</span>
                                <span class="fs-6 text-gray-800 fw-bold">20</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_1">
                                <span class="text-gray-500 fs-7 fw-semibold">Sa</span>
                                <span class="fs-6 text-gray-800 fw-bold">21</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_2">
                                <span class="text-gray-500 fs-7 fw-semibold">Su</span>
                                <span class="fs-6 text-gray-800 fw-bold">22</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger active" data-bs-toggle="tab" href="#kt_schedule_day_3">
                                <span class="text-gray-500 fs-7 fw-semibold">Mo</span>
                                <span class="fs-6 text-gray-800 fw-bold">23</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_4">
                                <span class="text-gray-500 fs-7 fw-semibold">Tu</span>
                                <span class="fs-6 text-gray-800 fw-bold">24</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_5">
                                <span class="text-gray-500 fs-7 fw-semibold">We</span>
                                <span class="fs-6 text-gray-800 fw-bold">25</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_6">
                                <span class="text-gray-500 fs-7 fw-semibold">Th</span>
                                <span class="fs-6 text-gray-800 fw-bold">26</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_7">
                                <span class="text-gray-500 fs-7 fw-semibold">Fr</span>
                                <span class="fs-6 text-gray-800 fw-bold">27</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_8">
                                <span class="text-gray-500 fs-7 fw-semibold">Sa</span>
                                <span class="fs-6 text-gray-800 fw-bold">28</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_9">
                                <span class="text-gray-500 fs-7 fw-semibold">Su</span>
                                <span class="fs-6 text-gray-800 fw-bold">29</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_10">
                                <span class="text-gray-500 fs-7 fw-semibold">Mo</span>
                                <span class="fs-6 text-gray-800 fw-bold">30</span>
                            </a>
                        </li>
                        <!--end::Date-->
                        <!--begin::Date-->
                        <li class="nav-item me-1">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger" data-bs-toggle="tab" href="#kt_schedule_day_11">
                                <span class="text-gray-500 fs-7 fw-semibold">Tu</span>
                                <span class="fs-6 text-gray-800 fw-bold">31</span>
                            </a>
                        </li>
                        <!--end::Date-->
                    </ul>
                    <!--end::Dates-->
                    <!--begin::Tab Content-->
                    <div class="tab-content px-9">
                        <!--begin::Day-->
                        <div id="kt_schedule_day_0" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Yannis Gloverson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Sean Bean</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">14:30 - 15:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Sean Bean</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_1" class="tab-pane fade show active">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">David Stevenson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Mark Randall</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Bob Harris</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_2" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">9:00 - 10:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Peter Marcus</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Karina Clarke</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">9:00 - 10:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Peter Marcus</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_3" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">13:00 - 14:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Bob Harris</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">13:00 - 14:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">David Stevenson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">13:00 - 14:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Karina Clarke</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_4" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">12:00 - 13:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Naomi Hayabusa</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Naomi Hayabusa</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Yannis Gloverson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_5" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">9:00 - 10:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Peter Marcus</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Caleb Donaldson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Caleb Donaldson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_6" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Bob Harris</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">David Stevenson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Karina Clarke</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_7" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">14:30 - 15:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Yannis Gloverson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">David Stevenson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Peter Marcus</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_8" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">David Stevenson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">10:00 - 11:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Kendell Trevor</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">9:00 - 10:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Sean Bean</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_9" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">14:30 - 15:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Sean Bean</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Kendell Trevor</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Naomi Hayabusa</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_10" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">12:00 - 13:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Bob Harris</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">13:00 - 14:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">David Stevenson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">16:30 - 17:30 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Terry Robins</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                        <!--begin::Day-->
                        <div id="kt_schedule_day_11" class="tab-pane fade show">
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">13:00 - 14:00 
                                    <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Caleb Donaldson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Karina Clarke</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                            <!--begin::Time-->
                            <div class="d-flex flex-stack position-relative mt-8">
                                <!--begin::Bar-->
                                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                <!--end::Bar-->
                                <!--begin::Info-->
                                <div class="fw-semibold ms-5 text-gray-600">
                                    <!--begin::Time-->
                                    <div class="fs-5">11:00 - 11:45 
                                    <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                    <!--end::Time-->
                                    <!--begin::Title-->
                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                    <!--end::Title-->
                                    <!--begin::User-->
                                    <div class="text-gray-500">Lead by 
                                    <a href="#">Caleb Donaldson</a></div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Action-->
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Time-->
                        </div>
                        <!--end::Day-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Timeline widget-3-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xxl-6">
            <!--begin::Card widget 18-->
            <div class="card card-flush h-md-100">
                <!--begin::Body-->
                <div class="card-body py-9">
                    <!--begin::Row-->
                    <div class="row gx-9 h-100">
                        <!--begin::Col-->
                        <div class="col-sm-6 mb-10 mb-sm-0">
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-400px min-h-sm-100 h-100" style="background-size: 100% 100%;background-image:url({{asset('public/assets/media/stock/600x600/img-33.jpg')}})"></div>
                            <!--end::Image-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-sm-6">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column h-100">
                                <!--begin::Header-->
                                <div class="mb-7">
                                    <!--begin::Headin-->
                                    <div class="d-flex flex-stack mb-6">
                                        <!--begin::Title-->
                                        <div class="flex-shrink-0 me-5">
                                            <span class="text-gray-500 fs-7 fw-bold me-2 d-block lh-1 pb-1">Featured</span>
                                            <span class="text-gray-800 fs-1 fw-bold">9 Degree</span>
                                        </div>
                                        <!--end::Title-->
                                        <span class="badge badge-light-primary flex-shrink-0 align-self-center py-3 px-4 fs-7">In Process</span>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Items-->
                                    <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center me-5 me-xl-13">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px symbol-circle me-3">
                                                <img src="{{asset('public/assets/media/avatars/300-3.jpg')}}" class="" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <span class="fw-semibold text-gray-500 d-block fs-8">Manager</span>
                                                <a href="pages/user-profile/overview.html" class="fw-bold text-gray-800 text-hover-primary fs-7">Robert Fox</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px symbol-circle me-3">
                                                <span class="symbol-label bg-success">
                                                    <i class="ki-duotone ki-abstract-41 fs-5 text-white">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <span class="fw-semibold text-gray-500 d-block fs-8">Budget</span>
                                                <span class="fw-bold text-gray-800 fs-7">$64.800</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="mb-6">
                                    <!--begin::Text-->
                                    <span class="fw-semibold text-gray-600 fs-6 mb-8 d-block">Flat cartoony illustrations with vivid unblended colors and asymmetrical beautiful purple hair lady</span>
                                    <!--end::Text-->
                                    <!--begin::Stats-->
                                    <div class="d-flex">
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                            <!--begin::Date-->
                                            <span class="fs-6 text-gray-700 fw-bold">Feb 6, 2021</span>
                                            <!--end::Date-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold text-gray-500">Due Date</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                            <!--begin::Number-->
                                            <span class="fs-6 text-gray-700 fw-bold">$
                                            <span class="ms-n1" data-kt-countup="true" data-kt-countup-value="284,900.00">0</span></span>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold text-gray-500">Budget</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Body-->
                                <!--begin::Footer-->
                                <div class="d-flex flex-stack mt-auto bd-highlight">
                                    <!--begin::Users group-->
                                    <div class="symbol-group symbol-hover flex-nowrap">
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                                            <img alt="Pic" src="{{asset('public/assets/media/avatars/300-2.jpg')}}" />
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                                            <img alt="Pic" src="{{asset('public/assets/media/avatars/300-3.jpg')}}" />
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                                            <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                        </div>
                                    </div>
                                    <!--end::Users group-->
                                    <!--begin::Actions-->
                                    <a href="apps/projects/project.html" class="d-flex align-items-center text-primary opacity-75-hover fs-6 fw-semibold">View Project 
                                    <i class="ki-duotone ki-exit-right-corner fs-4 ms-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i></a>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Footer-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card widget 18-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-6">
            <!--begin::Engage widget 8-->
            <div class="card border-0 h-md-100" data-bs-theme="light" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row align-items-center h-100">
                        <!--begin::Col-->
                        <div class="col-7 ps-xl-13">
                            <!--begin::Title-->
                            <div class="text-white mb-6 pt-6">
                                <span class="fs-4 fw-semibold me-2 d-block lh-1 pb-2 opacity-75">Get best offer</span>
                                <span class="fs-2qx fw-bold">Upgrade Your Plan</span>
                            </div>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <span class="fw-semibold text-white fs-6 mb-8 d-block opacity-75">Flat cartoony and illustrations with vivid unblended purple hair lady</span>
                            <!--end::Text-->
                            <!--begin::Items-->
                            <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-10 mb-xl-20">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #35C7FF">
                                            <i class="ki-duotone ki-abstract-41 fs-5 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="text-white">
                                        <span class="fw-semibold d-block fs-8 opacity-75">Projects</span>
                                        <span class="fw-bold fs-7">Up to 500</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <span class="symbol-label" style="background: #35C7FF">
                                            <i class="ki-duotone ki-abstract-26 fs-5 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="text-white">
                                        <span class="fw-semibold opacity-75 d-block fs-8">Tasks</span>
                                        <span class="fw-bold fs-7">Unlimited</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                            <!--begin::Action-->
                            <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                                <a href="#" class="btn btn-success flex-shrink-0 me-lg-2" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                <a href="#" class="btn btn-primary flex-shrink-0" style="background: rgba(255, 255, 255, 0.2)" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Read Guides</a>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-5 pt-10">
                            <!--begin::Illustration-->
                            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px" style="background-image:url({{asset('public/assets/media/svg/illustrations/easy/5.svg')}}"></div>
                            <!--end::Illustration-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 8-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

</div>
<!--end::Post-->
@endsection