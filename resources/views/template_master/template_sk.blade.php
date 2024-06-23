@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="content flex-column-fluid" id="kt_content">
    
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <p>Edit template</p>
            </div>
        </div>
        <?php $id_surat_keluar = request()->route('id'); ?>
        <form class="form" action="{{route('template.surat_keluar.update_surat',['id'=>$id_surat_keluar])}}" method="POST">
        {{csrf_field()}}
            <div class="card-body">
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                <!--begin::Alert-->
                <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <!--begin::Title-->
                        <h4 class="fw-semibold">Perhatian!</h4>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <span>Lengkapi data-data yang dibutuhkan dibawah ini untuk membuat template surat keluar.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Close-->
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--end::Alert-->

                <div id="notification"></div>

                <input type="hidden" name="id_surat" class="form-control form-control-solid" value="{{$table->id_surat}}"/>
                <div class="fv-row mb-7">
                    <label class="fw-semibold fs-6 mb-2">Nomor surat</label>
                    <input type="text" name="nomor_surat" class="form-control form-control-solid" value="{{$table->no_surat}}" readonly/>
                </div>
                <div class="fv-row mb-7">
                    <label class="fw-semibold fs-6 mb-2">Nomenklatur jabatan</label>
                    <select name="nomenklatur_jabatan" id="nomenklatur_jabatan" class="form-select form-select-solid my_list" data-placeholder="Select an option" disabled data-hide-search="true" >
                        <option selected value="">Pilih nomenklatur jabatan yang sesuai</option>
                        @foreach($nomenklatur_jabatan as $row)
                        @if($row->id == $table->id_nomenklatur_jabatan)
                            <option selected value="{{$row->id}}">{{$row->nomenklatur}}</option>
                        @endif
                        <option value="{{$row->id}}">{{$row->nomenklatur}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row mb-7">
                    <label class="required fw-semibold fs-6 mb-2">Tentang/perihal</label>
                    <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="perihal" required>{{$table->perihal}}</textarea>                    
                </div>
                <div class="fv-row mb-7" id="display-tgl_surat">
                    <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                    <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0 my_input" placeholder="Tanggal surat" value="{{$table->tgl_surat}}" required/>
                </div>
                
                <div class="fv-row mb-7">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        
                        <button type="button" class="btn btn-primary btn-sm" id="add_menimbang">
                        <i class="ki-duotone  ki-plus fs-2"></i>Add</button>
                        <!--end::Add user-->
                    </div>
                    <label class="required fw-semibold fs-6 mb-2">Poin menimbang</label>
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_menimbang">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-300px"></th>
                                    <th class="text-end min-w-125px"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>  
                </div>
                <div class="fv-row mb-7">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        
                        <button type="button" class="btn btn-primary btn-sm" id="add_mengingat">
                        <i class="ki-duotone ki-plus fs-2"></i>Add</button>
                        <!--end::Add user-->
                    </div>
                    <label class="required fw-semibold fs-6 mb-2">Poin mengingat</label>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_mengingat">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-300px"></th>
                                <th class="text-end min-w-125px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
                </div>
                <div class="fv-row mb-7" id="display-tgl_surat">
                    <label class="required fw-semibold fs-6 mb-2">Menetapkan</label>
                    <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" placeholder="Menetapkan" name="menetapkan" required>{{$table->menetapkan}}</textarea>
                </div>
                <div class="fv-row mb-7">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <button type="button" class="btn btn-primary btn-sm" id="add_menetapkan">
                        <i class="ki-duotone ki-plus fs-2"></i>Add</button>
                        <!--end::Add user-->
                    </div>
                
                    <label class="required fw-semibold fs-6 mb-2">Poin penetapan</label>
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_menetapkan">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-300px"></th>
                                <th class="text-end min-w-125px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
                </div>

                <div class="fv-row mb-7">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <button type="button" class="btn btn-primary btn-sm" id="add_nominatif">
                        <i class="ki-duotone ki-plus fs-2"></i>Add</button>
                        <!--end::Add user-->
                    </div>
                    <label class="fw-semibold fs-6 mb-2">Lampiran daftar nominatif</label>
                    <!--begin::Alert-->
                    <div class="alert bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="fw-semibold">Perhatian!</h4>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <span>Format lampiran khusus berupa daftar nominatif anggota tim yang dilibatkan didalam SK. Dapat dikosongi bila lampiran dalam format lain.</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Alert-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_daftar_nominatif">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">Nama</th>
                                <th class="min-w-150px">NIP</th>
                                <th>Jabatan</th>
                                <th>Jabatan dalam tim</th>
                                <th class="text-end min-w-125px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <button type="button" id="cancel" class="btn btn-light-danger">Cancel</button>
            </div>
        </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Post-->
<div class="modal fade" id="modal_menimbang" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_surat_keluar_header">
                <div id="title"></div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form id="kt_modal_add_rincian_menimbang" name="add_surat_keluar_form" class="form" method="POST">
                {{csrf_field()}}
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        <div id="notification-menimbang"></div>
                        <div class="fv-row mb-7" id="display-perihal">
                            <label class="required fw-semibold fs-6 mb-2">Rincian</label>
                            <textarea class="form-control form-control-solid my_input" placeholder="Rincian" id="rincian_menimbang" name="rincian_menimbang" rows="3" required ></textarea>
                        </div>

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary save_menimbang" id="save_menimbang" data-kt-indicator="on">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Save
                        </button>
                        <button type="submit" class="btn btn-primary update_menimbang" id="update_menimbang" data-kt-indicator="off">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Update
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<div class="modal fade" id="kt_modal_add_nominatif" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_nominatif_header">
                <div id="title-nominatif"></div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
            
                <form id="kt_modal_add_nominiatif_form" class="form">
                {{csrf_field()}}
                    <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <div id="notification-nominatif"></div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Nama pegawai</label>
                                <select name="pegawai" id="pegawai" class="form-select form-select-solid" data-placeholder="Select an option" data-hide-search="true">
                                    <option disabled selected value="0">Pilih pegawai</option>
                                    @foreach($pegawai as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Jabatan dalam tim</label>
                                <textarea class="form-control form-control-solid" placeholder="Jabatan dalam tim" id="jabatan_tim" name="jabatan_tim" rows="3" required ></textarea>
                            </div>
                        </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary save_nominatif" id="save_nominatif" data-kt-indicator="on">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Save
                        </button>
                        <button type="submit" class="btn btn-primary update_nominatif" id="update_nominatif" data-kt-indicator="off">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Update
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<div class="modal fade" id="modal_mengingat" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_surat_keluar_header">
                <div id="title-mengingat"></div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
            
                <form id="kt_modal_add_rincian_mengingat" class="form">
                {{csrf_field()}}
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        <div id="notification-mengingat"></div>
                        <div class="fv-row mb-7" id="display-perihal">
                            <label class="required fw-semibold fs-6 mb-2">Rincian</label>
                            <textarea class="form-control form-control-solid my_input" placeholder="Rincian" id="rincian_mengingat" name="rincian_mengingat" rows="3" required ></textarea>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary save_mengingat" id="save_mengingat" data-kt-indicator="on">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Save
                        </button>
                        <button type="submit" class="btn btn-primary update_mengingat" id="update_mengingat" data-kt-indicator="off">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Update
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<div class="modal fade" id="modal_menetapkan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_surat_keluar_header">
                <div id="title-menetapkan"></div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
            
                <form id="kt_modal_add_rincian_menetapkan" class="form">
                {{csrf_field()}}
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        <div id="notification-menetapkan"></div>
                        <div class="fv-row mb-7" id="display-perihal">
                            <label class="required fw-semibold fs-6 mb-2">Rincian</label>
                            <textarea class="form-control form-control-solid my_input" placeholder="Rincian" id="rincian_menetapkan" name="rincian_menetapkan" rows="3" required ></textarea>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary save_menetapkan" id="save_menetapkan" data-kt-indicator="on">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Save
                        </button>
                        <button type="submit" class="btn btn-primary update_menetapkan" id="update_menetapkan" data-kt-indicator="off">
                            <span class="indicator-progress">
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            Update
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

@endsection
@push('scripts')
<script type="text/JavaScript">
$(document).ready(function(){
    var date = document.getElementById("tgl_surat");
    flatpickr(date, {
        dateFormat: "Y-m-d",
        
    });

    $("body").on("click","#cancel", function(){
        window.location.href = "{{url('template/surat_keluar')}}";
    });

    $("body").on("click","#add_menimbang",function(){
        document.querySelector(".save_menimbang").setAttribute("data-kt-indicator", "off");
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add poin menimbang</h2>`;
        document.getElementById("update_menimbang").style.display = "none";
        document.getElementById("save_menimbang").style.display = "inline-block";
        document.getElementById("notification-menimbang").innerHTML = '';
        $("#rincian_menimbang").val("");
        $("#modal_menimbang").modal("show");
    });

    $("body").on("click","#add_nominatif",function(){
        document.querySelector(".save_nominatif").setAttribute("data-kt-indicator", "off");
        document.getElementById("title-nominatif").innerHTML = `<h2 class="fw-bold">Add daftar nominatif anggota tim</h2>`;
        document.getElementById("update_nominatif").style.display = "none";
        document.getElementById("save_nominatif").style.display = "inline-block";
        document.getElementById("pegawai").removeAttribute("disabled");
        document.getElementById("notification-nominatif").innerHTML = '';
        $("#pegawai").val("0");
        $("#jabatan_tim").val("");
        $("#kt_modal_add_nominatif").modal("show");
    });

    var arr_id_menimbang = [""];
    var arr_id_menetapkan = [""];
    var arr_id_mengingat = [""];
    var arr_id_user = [];

    var id_surat_keluar = "{{request()->route('id')}}";
    var tb_surat_keluar = $("#tb_menimbang").DataTable({
        ajax        : {
            url:`${id_surat_keluar}/get_menimbang`,
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        searching   :false,
        bPaginate   :false,
        responsive  : true,
        columns     :
        [
            {data:"menimbang"},
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                    <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                        <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="edit_menimbang" data-id_menimbang='${data}'>Edit</a>
                                </div>
                            </li>
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn text-danger" id="delete_menimbang" data-id_menimbang='${data}'>Delete</a>
                                </div>
                            </li>
                        </ul>
                    </div>`;
                }
            }
        ]
    });

    var tb_daftar_nominatif = $("#tb_daftar_nominatif").DataTable({
        ajax        : {
            url:`{{url('template/surat_keluar/${id_surat_keluar}/nominatif')}}`,
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        searching   :false,
        bPaginate   :false,
        responsive  : true,
        columns     :
        [
            {data:"name"},
            {data:"nip"},
            {data:"jabatan"},
            {data:"jabatan_dalam_tim"},
            {data:"id_user", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                    <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                        <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="edit_nominatif" data-id_user='${data}' data-id_surat_keluar='${full["id_surat_keluar"]}'>Edit</a>
                                </div>
                            </li>
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn text-danger" id="delete_nominatif" data-id_user='${data}' data-id_surat_keluar='${full["id_surat_keluar"]}'>Delete</a>
                                </div>
                            </li>
                        </ul>
                    </div>`;
                }
            }
        ]
    });

    $("body").on("click","#edit_nominatif",function(){
        document.querySelector(".update_nominatif").setAttribute("data-kt-indicator", "off");
        document.getElementById("title-nominatif").innerHTML = `<h2 class="fw-bold">Edit daftar nominatif anggota tim</h2>`;
        document.getElementById("update_nominatif").style.display = "inline-block";
        document.getElementById("save_nominatif").style.display = "none";
        document.getElementById("pegawai").setAttribute("disabled","disabled");
        document.getElementById("notification-nominatif").innerHTML = '';
        var id_user = $(this).data("id_user");
        var id_surat_keluar = $(this).data("id_surat_keluar");
        arr_id_user["id_user"] = id_user;
        $.ajax({
            url:`{{url('template/surat_keluar/${id_surat_keluar}/${id_user}/nominatif/edit')}}`,
            type:"GET",
            success:function(data){
                $("#pegawai").val(data.id_user);
                $("#jabatan_tim").val(data.jabatan_dalam_tim);
                $("#kt_modal_add_nominatif").modal("show");
            }
        });
    });

    $("#update_nominatif").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_nominiatif_form"));
        var id_user = arr_id_user['id_user'];
        $.ajax({
            url:`{{url('/template/surat_keluar/${id_surat_keluar}/${id_user}/nominatif/update')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                if(data.success == false){
                    let err_jabatan_tim = data.msg.err_jabatan_tim ? `<li>${data.msg.err_jabatan_tim}</li>` : '';
                    document.getElementById("notification-nominatif").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-nominatif'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_jabatan_tim+"</div></div>";      
                    document.querySelector(".update_nominatif").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#kt_modal_add_nominatif").modal("hide");
                    $("#tb_daftar_nominatif").DataTable().ajax.reload(null, false);
                }
            }
        })
    })

    $("#save_nominatif").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_nominiatif_form"));
        $.ajax({
            url:`{{url('template/surat_keluar/${id_surat_keluar}/nominatif/save')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data);
                if(data.success == false){
                    let err_exist = data.msg.err_exist  ? `<li>${data.msg.err_exist}</li>` : ``;
                    let err_pegawai = data.msg.err_pegawai  ? `<li>${data.msg.err_pegawai}</li>` : ``;
                    let err_jabatan_tim = data.msg.err_jabatan_tim  ? `<li>${data.msg.err_jabatan_tim}</li>` : ``;

                    document.getElementById("notification-nominatif").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-nominatif'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_exist+err_pegawai+err_jabatan_tim+"</div></div>";      
                    document.querySelector(".save_nominatif").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#kt_modal_add_nominatif").modal("hide");
                    $("#tb_daftar_nominatif").DataTable().ajax.reload(null, false);
                }
            }
        })
    });

    $("body").on("click","#delete_nominatif",function(){
        var id_user = $(this).data("id_user");
        var id_surat_keluar = $(this).data("id_surat_keluar");
        console.log("Delete", id_user, id_surat_keluar);
        if(confirm("Anda yakin?")){
            $.ajax({
                url:`{{url('template/surat_keluar/${id_surat_keluar}/${id_user}/nominatif/delete')}}`,
                type:"GET",
                success:function(data){
                    $("#tb_daftar_nominatif").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

    $("#save_menimbang").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_rincian_menimbang"));
        document.querySelector(".save_menimbang").setAttribute("data-kt-indicator", "on");
        $.ajax({
            url:`{{url('template/surat_keluar/${id_surat_keluar}/menimbang/save')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                
                if(data.success == false){
                    let err_menimbang = data.msg.menimbang ? `<li>${data.msg.menimbang}</li>` : ``;

                    document.getElementById("notification-menimbang").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-menimbang'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_menimbang+"</div></div>";      
                    document.querySelector(".save_menimbang").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#rincian_menimbang").val("");
                    $("#modal_menimbang").modal("hide");
                    $("#tb_menimbang").DataTable().ajax.reload(null, false);
                }
            }
        });
    });

    $("body").on("click", "#edit_menimbang", function(){
        let id_menimbang = $(this).data("id_menimbang");
        arr_id_menimbang[0] = id_menimbang;
        document.querySelector(".update_menimbang").setAttribute("data-kt-indicator", "off");
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add poin menimbang</h2>`;
        document.getElementById("update_menimbang").style.display = "inline-block";
        document.getElementById("save_menimbang").style.display = "none";
        document.getElementById("notification-menimbang").innerHTML = '';
        $.ajax({
            url:`{{url('template/surat_keluar/${arr_id_menimbang[0]}/menimbang/edit')}}`,
            type:"GET",
            success:function(data){
                console.log(data);
                $("#rincian_menimbang").val(data.menimbang)
                $("#modal_menimbang").modal("show");
            }
        });
    });

    $("#update_menimbang").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_rincian_menimbang"));
        document.querySelector(".update_menimbang").setAttribute("data-kt-indicator", "on");
        $.ajax({
            url:`{{url('template/surat_keluar/${arr_id_menimbang[0]}/menimbang/update')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data)
                if(data.success == false){
                    document.getElementById("notification-menimbang").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-menimbang'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+data.msg.err_menimbang+"</div></div>";      

                    document.querySelector(".update_menimbang").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#modal_menimbang").modal("hide");
                    $("#tb_menimbang").DataTable().ajax.reload(null, false);
                }
            }
        });
    });

    $("body").on("click","#delete_menimbang",function(){
        let id_menimbang = $(this).data("id_menimbang");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            $.ajax({
                url:`{{url('template/surat_keluar/${id_menimbang}/menimbang/delete')}}`,
                type:"GET",
                success:function(data){
                    $("#tb_menimbang").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

    var tb_mengingat = $("#tb_mengingat").DataTable({
        ajax        : {
            url:`{{url('template/surat_keluar/${id_surat_keluar}/get_mengingat')}}`,
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        searching   :false,
        bPaginate   :false,
        responsive  : true,
        columns     :
        [
            {data:"mengingat"},
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                    <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                        <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="edit_mengingat" data-id_mengingat='${data}'>Edit</a>
                                </div>
                            </li>
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn text-danger" id="delete_mengingat" data-id_mengingat='${data}'>Delete</a>
                                </div>
                            </li>
                        </ul>
                    </div>`;
                }
            }
        ]
    });

    $("body").on("click","#add_mengingat",function(){
        document.getElementById("title-mengingat").innerHTML = `<h2 class="fw-bold">Add poin mengingat</h2>`;
        document.getElementById("update_mengingat").style.display = "none";
        document.querySelector(".save_mengingat").setAttribute("data-kt-indicator", "off");
        document.getElementById("save_mengingat").style.display = "inline-block";
        document.getElementById("notification-mengingat").innerHTML = '';
        $("#rincian_mengingat").val("");
        $("#modal_mengingat").modal("show");
    });

    $("#save_mengingat").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_rincian_mengingat"));
        document.querySelector(".save_mengingat").setAttribute("data-kt-indicator", "on");
        $.ajax({
            url:`{{url('template/surat_keluar/${id_surat_keluar}/mengingat/save')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data)
                if(data.success == false){
                    document.getElementById("notification-mengingat").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-mengingat'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+data.msg.err_mengingat+"</div></div>";      
                    document.querySelector(".save_mengingat").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#rincian_mengingat").val("");
                    $("#modal_mengingat").modal("hide");
                    $("#tb_mengingat").DataTable().ajax.reload(null, false);
                }
                
            }
        });
    });

    $("body").on("click","#edit_mengingat",function(){
        var id_mengingat = $(this).data("id_mengingat"); 
        arr_id_mengingat[0] = id_mengingat;
        document.querySelector(".update_mengingat").setAttribute("data-kt-indicator", "off");
        document.getElementById("title-mengingat").innerHTML = `<h2 class="fw-bold">Edit poin mengingat</h2>`;
        document.getElementById("update_mengingat").style.display = "inline-block";
        document.getElementById("save_mengingat").style.display = "none";
        document.querySelector(".update_menimbang").setAttribute("data-kt-indicator", "off");
        document.getElementById("notification-mengingat").innerHTML = '';
        $.ajax({
            url:`{{url('template/surat_keluar/${id_mengingat}/mengingat/edit')}}`,
            type:"GET",
            success:function(data){
                console.log(data)
                $("#rincian_mengingat").val(data.mengingat);
                $("#modal_mengingat").modal("show");
            }
        });
    });

    $("#update_mengingat").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_rincian_mengingat"));
        document.querySelector(".update_mengingat").setAttribute("data-kt-indicator", "on");
        $.ajax({
            url:`{{url('template/surat_keluar/${arr_id_mengingat[0]}/mengingat/update')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.success == false){
                    document.getElementById("notification-mengingat").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-mengingat'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+data.msg.err_mengingat+"</div></div>";      
                    document.querySelector(".update_mengingat").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#rincian_mengingat").val("");
                    $("#modal_mengingat").modal("hide");
                    $("#tb_mengingat").DataTable().ajax.reload(null, false);
                }
            }
        });
    });

    $("body").on("click","#delete_mengingat",function(){
        let id_mengingat = $(this).data("id_mengingat");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            $.ajax({
                url:`{{url('template/surat_keluar/${id_mengingat}/mengingat/delete')}}`,
                type:"GET",
                success:function(data){
                    $("#tb_mengingat").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

    var tb_menetaapkan = $("#tb_menetapkan").DataTable({
        ajax        : {
            url:`{{url('template/surat_keluar/${id_surat_keluar}/get_menetapkan')}}`,
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        searching   : false,
        bPaginate   : false,
        responsive  : true,
        columns     :
        [
            {data:"menetapkan"},
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                    <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                        <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="edit_menetapkan" data-id_menetapkan='${data}'>Edit</a>
                                </div>
                            </li>
                            <li>
                                <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn text-danger" id="delete_menetapkan" data-id_menetapkan='${data}'>Delete</a>
                                </div>
                            </li>
                        </ul>
                    </div>`;
                }
            }
        ]
    });

    $("body").on("click","#add_menetapkan",function(){
        console.log("Test")
        document.getElementById("title-menetapkan").innerHTML = `<h2 class="fw-bold">Add poin menetapkan</h2>`;
        document.getElementById("update_menetapkan").style.display = "none";
        document.querySelector(".save_menetapkan").setAttribute("data-kt-indicator", "off");
        document.getElementById("save_menetapkan").style.display = "inline-block";
        document.getElementById("notification-menetapkan").innerHTML = '';
        $("#rincian_menetapkan").val("");
        $("#modal_menetapkan").modal("show");
    });

    $("#save_menetapkan").click(function(e){
        e.preventDefault();

        var formData = new FormData(document.getElementById("kt_modal_add_rincian_menetapkan"));
        document.querySelector(".save_menetapkan").setAttribute("data-kt-indicator", "on");
        $.ajax({
            url:`{{url('template/surat_keluar/${id_surat_keluar}/menetapkan/save')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.success == false){
                    document.getElementById("notification-menetapkan").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-menetapkan'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+data.msg.err_menetapkan+"</div></div>";      
                    document.querySelector(".save_menetapkan").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#rincian_menetapkan").val("");
                    $("#modal_menetapkan").modal("hide");
                    $("#tb_menetapkan").DataTable().ajax.reload(null, false);
                }
            }
        });
    });

    $("body").on("click","#edit_menetapkan",function(){
        let id_menetapkan = $(this).data("id_menetapkan");
        arr_id_menetapkan[0] = id_menetapkan;
        document.querySelector(".update_menetapkan").setAttribute("data-kt-indicator", "off");
        document.getElementById("title-menetapkan").innerHTML = `<h2 class="fw-bold">Edit poin menetapkan</h2>`;
        document.getElementById("update_menetapkan").style.display = "inline-block";
        document.getElementById("save_menetapkan").style.display = "none";
        document.getElementById("notification-menetapkan").innerHTML = '';
        $.ajax({
            url:`{{url('template/surat_keluar/${arr_id_menetapkan[0]}/menetapkan/edit')}}`,
            type:"GET",
            success:function(data){
                console.log(data);
                $("#rincian_menetapkan").val(data.menetapkan)
                $("#modal_menetapkan").modal("show");
            }
        });
    });

    $("#update_menetapkan").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_rincian_menetapkan"));
        document.querySelector(".update_menetapkan").setAttribute("data-kt-indicator", "on");
        $.ajax({
            url:`{{url('template/surat_keluar/${arr_id_menetapkan[0]}/menetapkan/update')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data)
                if(data.success == false){
                    document.getElementById("notification-menetapkan").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification-menetapkan'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+data.msg.err_menetapkan+"</div></div>";      
                    document.querySelector(".update_menetapkan").setAttribute("data-kt-indicator", "off");
                }else{
                    $("#modal_menetapkan").modal("hide");
                    $("#tb_menetapkan").DataTable().ajax.reload(null, false);
                }
            }
        });
    });

    $("body").on("click","#delete_menetapkan",function(){
        let id_menetapkan = $(this).data("id_menetapkan");
        console.log(id_menetapkan)
        if(confirm("Anda yakin ingin menghapus data ini?")){
            $.ajax({
                url:`{{url('template/surat_keluar/${id_menetapkan}/menetapkan/delete')}}`,
                type:"GET",
                success:function(data){
                    $("#tb_menetapkan").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

});
</script>
@endpush
