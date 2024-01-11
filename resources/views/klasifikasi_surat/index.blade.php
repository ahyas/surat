@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="content flex-column-fluid" id="kt_content">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <p>Klasifikasi Surat</p>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" id="add_klasifikasi">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Klasifikasi</button>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="modal fade" id="kt_modal_add_klasifikasi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="kt_modal_add_klasifikasi_header"></div>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form id="modal_klasifikasi_surat_form" name="add_user_form" class="form" action="#">
                            {{csrf_field()}}
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <input type="hidden" name="id_klasifikasi" class="form-control" />
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">Kode</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="kode_klasifikasi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode klasifikasi" />
                                        <!--end::Input-->
                                    </div>
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="deskripsi_klasifikasi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    
                                    <!--end::Input group-->
                                    <div class="text pt-10">
                                        <button class="btn btn-danger btn-sm" id="btnCancel">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="save_klasifikasi" data-kt-users-modal-action="submit">Save</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="update_klasifikasi" data-kt-users-modal-action="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add task-->
            
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_klasifikasi">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Kode</th>
                        <th class="min-w-125px">Deskripsi</th>
                        <th class="text-end min-w-125px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!---------------------------------------------------------------begin::sub fungsi ------------------------------------------------------>
    <div class="card" id="sub-fungsi" style="margin-top:30px; display:none; width:100%">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <span id="sub-title1"></span>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" id="add_fungsi">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Kode Fungsi</button>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="fs-5 fw-semibold text-muted">
                <span id="show_kode_klasifikasi"></span><span id="show_deskripsi_klasifikasi"></span>
            </div>
            <input type="hidden" name="id_ref_klasifikasi">
            <div class="modal fade" id="kt_modal_add_fungsi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="kt_modal_add_fungsi_header"></div>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form id="modal_fungsi_surat_form" name="add_fungsi_form" class="form" action="#">
                            {{csrf_field()}}
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <input type="hidden" name="id_fungsi" class="form-control" />
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Kode</label>
                                        <input type="text" name="kode_fungsi" id="kode_fungsi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode klasifikasi" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                        <input type="text" name="deskripsi_fungsi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi" />
                                    </div>
                                    <div class="text pt-10">
                                        <button class="btn btn-danger btn-sm" id="btnCancel">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="save_fungsi" data-kt-users-modal-action="submit">Save</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="update_fungsi" data-kt-users-modal-action="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_fungsi">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Kode</th>
                        <th class="min-w-125px">Deskripsi</th>
                        <th class="text-end min-w-125px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
        </div>
    </div>
    <!---------------------------------------------------------------END::sub fungsi ------------------------------------------------------>

    <!---------------------------------------------------------------begin::sub kegiatan ------------------------------------------------------>
    <div class="card" id="sub-kegiatan" style="margin-top:30px; display:none; width:100%">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <span id="sub-kegiatan-title"></span>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" id="add_kegiatan">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Kode Kegiatan</button>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="fs-5 fw-semibold text-muted">
                <span id="show_kode_fungsi"></span><span id="show_deskripsi_fungsi"></span>
            </div>

            <div class="modal fade" id="kt_modal_add_kegiatan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="kt_modal_add_kegiatan_header"></div>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form id="modal_kegiatan_surat_form" name="add_kegiatan_form" class="form" action="#">
                            {{csrf_field()}}
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <input type="hidden" name="id_ref_fungsi" class="form-control" />
                                    <input type="hidden" name="id_ref_kegiatan" class="form-control" />
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Kode</label>
                                        <input type="text" name="kode_kegiatan" id="kode_kegiatan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode Kegiatan" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                        <input type="text" name="deskripsi_kegiatan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi" />
                                    </div>
                                    <div class="text pt-10">
                                        <button class="btn btn-danger btn-sm" id="btnCancel">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="save_kegiatan" data-kt-users-modal-action="submit">Save</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="update_kegiatan" data-kt-users-modal-action="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_kegiatan">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Kode</th>
                        <th class="min-w-125px">Deskripsi</th>
                        <th class="text-end min-w-125px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
        </div>
    </div>
    <!---------------------------------------------------------------END::sub kegiatan ------------------------------------------------------>

    <!---------------------------------------------------------------begin::sub transaksi ------------------------------------------------------>
    <div class="card" id="sub-transaksi" style="margin-top:30px; display:none; width:100%">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <span id="sub-transaksi-title"></span>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" id="add_transaksi">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Kode Transaksi</button>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="fs-5 fw-semibold text-muted">
                <span id="show_kode_kegiatan"></span><span id="show_deskripsi_kegiatan"></span>
            </div>

            <div class="modal fade" id="kt_modal_add_transaksi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_transaksi_header">
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                <i class="ki-duotone ki-cross fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <div class="modal-body px-5 my-7">
                            <!--begin::Form-->
                            <form id="modal_transaksi_surat_form" name="add_transaksi_form" class="form" action="#">
                            {{csrf_field()}}
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                    <input type="hidden" name="id_ref_kegiatan" class="form-control" />
                                    <input type="hidden" name="id_transaksi" class="form-control" />
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Kode</label>
                                        <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode Transaksi" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                        <input type="text" name="deskripsi_transaksi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi" />
                                    </div>
                                    <div class="text pt-10">
                                        <button class="btn btn-danger btn-sm" id="btnCancel">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="save_transaksi" data-kt-users-modal-action="submit">Save</button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="update_transaksi" data-kt-users-modal-action="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_transaksi">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Kode</th>
                        <th class="min-w-125px">Deskripsi</th>
                        <th class="text-end min-w-125px">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
        </div>
    </div>
    <!---------------------------------------------------------------END::sub transaksi ------------------------------------------------------>
</div>
<!--end::Post-->
																	
@endsection
@push('scripts')
<script src="{{asset('public/assets/js/custom/apps/user-management/users/list/table.js')}}"></script> 
<script type="text/javascript">
$(document).ready(function(){
    //** -----------------------------------------------------BEGIN::klasifikasi ----------------------------------------------------------*/
    $("#tb_klasifikasi").DataTable({
        ajax        : {
            url:"{{route('referensi.klasifikasi_surat.get_data')}}",
            dataSrc:""
        },
        pageLength  :5,
        lengthMenu  : [[5, 10, 20], [5, 10, 20]],
        serverSide  : false,
        columns     :
        [
            {data:"kode_klasifikasi"},
            {data:"deskripsi_klasifikasi"},
            {data:"id_klasifikasi", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a href="javascript:void(0)" class="dropdown-item" id="detail_klasifikasi" data-id_klasifikasi='${data}' data-show_kode_klasifikasi=${full['kode_klasifikasi']} data-show_deskripsi_klasifikasi="${full['deskripsi_klasifikasi']}">Detail</a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item" id="edit_klasifikasi" data-id_klasifikasi='${data}'>Edit</a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item text-danger" id="delete_klasifikasi" data-id_klasifikasi='${data}'>Delete</a></li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    $("body").on("click","#btnCancel", function(e){
        e.preventDefault();
        $("#kt_modal_add_klasifikasi").modal("hide");
        $("#kt_modal_add_fungsi").modal("hide");
    });

    $("body").on("click","#add_klasifikasi", function(){
        document.getElementById("sub-fungsi").style.display = "none";
        document.getElementById("sub-kegiatan").style.display = "none";
        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("kt_modal_add_klasifikasi_header").innerHTML = `<h2 class="fw-bold">Tambah Klasifikasi</h2>`;
        document.getElementById("update_klasifikasi").style.display = "none";
        document.getElementById("save_klasifikasi").style.display = "inline-block";
        $("#modal_klasifikasi_surat_form").trigger("reset");
        $("#kt_modal_add_klasifikasi").modal("show");
    });

    $("#save_klasifikasi").click(function(e){
        e.preventDefault();
        $.ajax({
            type    :"POST",
            url     :"{{route('referensi.klasifikasi_surat.save')}}",
            data    :$("#modal_klasifikasi_surat_form").serialize(),
            dataType:"JSON",
            success :function(data){
                $("#tb_klasifikasi").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_klasifikasi").modal("hide");
            }
        });
    });

    $("body").on("click","#edit_klasifikasi",function(){
        document.getElementById("sub-fungsi").style.display = "none";
        document.getElementById("sub-kegiatan").style.display = "none";
        document.getElementById("sub-transaksi").style.display = "none";
        var id_klasifikasi = $(this).data("id_klasifikasi");
        document.getElementById("kt_modal_add_klasifikasi_header").innerHTML = `<h2 class="fw-bold">Edit Klasifikasi</h2>`;
        $("#modal_klasifikasi_surat_form").trigger("reset");
        document.getElementById("update_klasifikasi").style.display = "inline-block";
        document.getElementById("save_klasifikasi").style.display = "none";
        $.ajax({
            type    :"GET",
            url     :`{{url('referensi/klasifikasi_surat/${id_klasifikasi}/edit')}}`,
            success :function(data){
                console.log(data)
                $("input[name='id_klasifikasi']").val(data.id_klasifikasi);
                $("input[name='kode_klasifikasi']").val(data.kode_klasifikasi);
                $("input[name='deskripsi_klasifikasi']").val(data.deskripsi_klasifikasi);
                $("#kt_modal_add_klasifikasi").modal("show");
            }
        });
    });

    $("#update_klasifikasi").click(function(e){
        var id_klasifikasi = $("input[name='id_klasifikasi']").val();
        e.preventDefault();
        $.ajax({
            type    :"POST",
            url     :`{{url('referensi/klasifikasi_surat/${id_klasifikasi}/update')}}`,
            data    :$("#modal_klasifikasi_surat_form").serialize(),
            dataType:"JSON",
            success :function(data){
                $("#tb_klasifikasi").DataTable().ajax.reload();
                $("#kt_modal_add_klasifikasi").modal("hide");
            }
        });
    });

    $("body").on("click","#delete_klasifikasi", function(){
        var id_klasifikasi = $(this).data("id_klasifikasi");
        if(confirm("Anda yakin akan menghapus data ini?")){
            $.ajax({
                type    :"GET",
                url     :`{{url('referensi/klasifikasi_surat/${id_klasifikasi}/delete')}}`,
                dataType:"JSON",
                success :function(data){
                    $("#tb_klasifikasi").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

    $("body").on("click", "#detail_klasifikasi",function(){
        let kode_klasifikasi = $(this).data("show_kode_klasifikasi");
        document.getElementById("sub-fungsi").style.display = "inline-block";
        document.getElementById("sub-kegiatan").style.display = "none";
        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("sub-title1").innerHTML = "Sub Kode Fungsi";
        document.getElementById("show_kode_klasifikasi").innerHTML = $(this).data("show_kode_klasifikasi");
        document.getElementById("show_deskripsi_klasifikasi").innerHTML = " - "+$(this).data("show_deskripsi_klasifikasi");
        
        var id_ref_klasifikasi = $(this).data("id_klasifikasi");
        $("input[name='id_ref_klasifikasi']").val(id_ref_klasifikasi);
        $("#tb_fungsi").DataTable().clear().destroy();
        $("#tb_fungsi").DataTable({
            ajax        : {
                url:`{{url('referensi/fungsi_surat/${id_ref_klasifikasi}/detail')}}`,
                dataSrc:""
            },
            pageLength  :5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]],
            serverSide  : false,
            columns     :
            [
                {data:"kode_fungsi"},
                {data:"deskripsi_fungsi"},
                {data:"id_fungsi", className: "text-end",
                    mRender:function(data, type, full){
                        return`<div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a href="javascript:void(0)" 
                                                class="dropdown-item" 
                                                id="detail_fungsi"
                                                data-id_fungsi='${data}' 
                                                data-show_kode_fungsi='${full["kode_fungsi"]}' 
                                                data-show_deskripsi_fungsi='${full["deskripsi_fungsi"]}'>
                                                    Detail
                                            </a>
                                        </li>
                                        <li><a href="javascript:void(0)" class="dropdown-item" id="edit_fungsi" data-id_fungsi='${data}'>Edit</a></li>
                                        <li><a href="javascript:void(0)" class="dropdown-item text-danger" id="delete_fungsi" data-id_fungsi='${data}'>Delete</a></li>
                                    </ul>
                                </div>`;
                    }
                }
            ]
        });

    });

    //** -----------------------------------------------------END::klasifikasi ----------------------------------------------------------*/

    /** Begin::Kode Fungsi */
    $("body").on("click","#add_fungsi", function(){
        let count = $("#tb_fungsi").DataTable().rows( ).count() + 1;
        let kode_klasifikasi = document.getElementById("show_kode_klasifikasi").innerHTML;
        
        document.getElementById("sub-kegiatan").style.display = "none";
        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("update_fungsi").style.display = "none";
        document.getElementById("save_fungsi").style.display = "inline-block";
        document.getElementById("kt_modal_add_fungsi_header").innerHTML = `<h2 class="fw-bold">Tambah Fungsi</h2>`;
        $("#modal_fungsi_surat_form").trigger("reset");
        $("#kode_fungsi").val(kode_klasifikasi+""+count);
        $("#kt_modal_add_fungsi").modal("show");
    });

    $("#save_fungsi").click(function(e){
        e.preventDefault();
        let id_ref_klasifikasi = $("input[name='id_ref_klasifikasi']").val();
        let kode_ref_fungsi = $("input[name='kode_fungsi']").val();
        let deskripsi_ref_fungsi = $("input[name='deskripsi_fungsi']").val();
        $.ajax({
            type    :"GET",
            url     :"{{route('referensi.fungsi_surat.save')}}",
            data    :{id_ref_klasifikasi:id_ref_klasifikasi, kode_ref_fungsi:kode_ref_fungsi, deskripsi_ref_fungsi:deskripsi_ref_fungsi},
            dataType:"JSON",
            success :function(data){
                $("#kt_modal_add_fungsi").modal("hide");
                $("#tb_fungsi").DataTable().ajax.reload(null, false);
            }
        });
    });

    $("body").on("click", "#edit_fungsi", function(){
        let id_fungsi = $(this).data("id_fungsi");
        document.getElementById("sub-kegiatan").style.display = "none";
        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("update_fungsi").style.display = "inline-block";
        document.getElementById("save_fungsi").style.display = "none";
        document.getElementById("kt_modal_add_fungsi_header").innerHTML = `<h2 class="fw-bold">Edit Fungsi</h2>`;
        $.ajax({
            url:`{{('referensi/fungsi_surat/${id_fungsi}/edit')}}`,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                $("input[name='id_fungsi']").val(data.id_fungsi);
                $("input[name='kode_fungsi']").val(data.kode_fungsi);
                $("input[name='deskripsi_fungsi']").val(data.deskripsi_fungsi);
                $("input[name='id_ref_klasifikasi']").val(data.id_ref_klasifikasi);
                $("#kt_modal_add_fungsi").modal("show");
            }
        });
    });

    $("#update_fungsi").click(function(e){
        e.preventDefault();
        let id_fungsi = $("input[name='id_fungsi']").val();
        let kode_ref_fungsi = $("input[name='kode_fungsi']").val();
        let deskripsi_ref_fungsi = $("input[name='deskripsi_fungsi']").val();
        $.ajax({
            url:`{{('referensi/fungsi_surat/${id_fungsi}/update')}}`,
            type:"GET",
            data:{kode_ref_fungsi:kode_ref_fungsi, deskripsi_ref_fungsi:deskripsi_ref_fungsi},
            dataType:"JSON",
            success:function(data){
                $("#tb_fungsi").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_fungsi").modal("hide");
            }
        });
    });

    $("body").on("click", "#delete_fungsi",function(){
        let id_fungsi = $(this).data("id_fungsi")
        if(confirm("Anda yakin ingin menghapus data ini?")){
            console.log("Deleted");
            $.ajax({
                type:"GET",
                url:`{{url('referensi/fungsi_surat/${id_fungsi}/delete')}}`,
                success:function(){
                    $("#tb_fungsi").DataTable().ajax.reload(null, false);
                }
            });
        }
    });
    /** End::Kode Fungsi */

    /** BEGIN::kegiatan */
    $("body").on("click", "#detail_fungsi",function(){
        document.getElementById("sub-kegiatan").style.display = "inline-block";
        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("sub-kegiatan-title").innerHTML = "Sub Kode Kegiatan";
        document.getElementById("show_kode_fungsi").innerHTML = $(this).data("show_kode_fungsi");
        document.getElementById("show_deskripsi_fungsi").innerHTML = " - "+$(this).data("show_deskripsi_fungsi");
        let id_ref_fungsi = $(this).data("id_fungsi");
        $("input[name='id_ref_fungsi']").val(id_ref_fungsi);
        $("#tb_kegiatan").DataTable().clear().destroy();
            $("#tb_kegiatan").DataTable({
                ajax        : {
                    url:`{{url('/referensi/kegiatan_surat/${id_ref_fungsi}/detail')}}`,
                    dataSrc:""
                },
                pageLength  : 5,
                lengthMenu  : [[5, 10, 20], [5, 10, 20]],
                serverSide  : false,
                columns     :
                [
                    {data:"kode_kegiatan"},
                    {data:"deskripsi_kegiatan"},
                    {data:"id_kegiatan", className: "text-end",
                        mRender:function(data, type, full){
                            return`<div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a href="javascript:void(0)" 
                                                    class="dropdown-item" 
                                                    id="detail_kegiatan" 
                                                    data-id_kegiatan='${data}'
                                                    data-show_kode_kegiatan='${full["kode_kegiatan"]}'
                                                    data-show_deskripsi_kegiatan='${full["deskripsi_kegiatan"]}'    
                                                >
                                                        Detail
                                                </a>
                                            </li>
                                            <li><a href="javascript:void(0)" class="dropdown-item" id="edit_kegiatan" data-id_kegiatan='${data}'>Edit</a></li>
                                            <li><a href="javascript:void(0)" class="dropdown-item text-danger" id="delete_kegiatan" data-id_kegiatan='${data}'>Delete</a></li>
                                        </ul>
                                    </div>`;
                        }
                    }
                ]
        });
    });

    $("body").on("click","#add_kegiatan",function(){
        let count = $("#tb_kegiatan").DataTable().rows( ).count() + 1;
        let kode_kegiatan = document.getElementById("show_kode_fungsi").innerHTML;

        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("kt_modal_add_kegiatan_header").innerHTML = `<h2 class="fw-bold">Tambah Kegiatan</h2>`;
        document.getElementById("update_kegiatan").style.display = "none";
        document.getElementById("save_kegiatan").style.display = "inline-block";
        $("#modal_kegiatan_surat_form").trigger("reset");
        $("#kode_kegiatan").val(kode_kegiatan+"."+count);
        $("#kt_modal_add_kegiatan").modal("show");
    });

    $("#save_kegiatan").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('referensi.kegiatan_surat.save')}}",
            type:"POST",
            data:$("#modal_kegiatan_surat_form").serialize(),
            dataType:"JSON",
            success:function(data){
                $("#tb_kegiatan").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_kegiatan").modal("hide");
            }
        });
    });

    $("body").on("click","#edit_kegiatan",function(){
        document.getElementById("sub-transaksi").style.display = "none";
        document.getElementById("kt_modal_add_kegiatan_header").innerHTML = `<h2 class="fw-bold">Edit Kegiatan</h2>`;
        document.getElementById("update_kegiatan").style.display = "inline-block";
        document.getElementById("save_kegiatan").style.display = "none";
        let id_kegiatan = $(this).data("id_kegiatan");
        $.ajax({
            url:`{{url('referensi/kegiatan_surat/${id_kegiatan}/edit')}}`,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
                $("input[name='id_ref_kegiatan']").val(data.id_kegiatan);
                $("input[name='kode_kegiatan']").val(data.kode_kegiatan);
                $("input[name='deskripsi_kegiatan']").val(data.deskripsi_kegiatan);
                $("#kt_modal_add_kegiatan").modal("show");
            }
        });
    });

    $("body").on("click","#update_kegiatan",function(e){
        e.preventDefault();
        let id_kegiatan = $("input[name='id_ref_kegiatan']").val();
        console.log(id_kegiatan);
        $.ajax({
            url:`{{url('referensi/kegiatan_surat/${id_kegiatan}/update')}}`,
            type:"GET",
            data:$("#modal_kegiatan_surat_form").serialize(),
            dataType:"JSON",
            success:function(data){
                $("#tb_kegiatan").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_kegiatan").modal("hide");
            }
        });
    });

    $("body").on("click","#delete_kegiatan", function(){
        let id_kegiatan = $(this).data("id_kegiatan");
        if(confirm("Anda yakin akan menghapus data ini?")){
            $.ajax({
                url:`{{url('referensi/kegiatan_surat/${id_kegiatan}/delete')}}`,
                type:"GET",
                dataType:"JSON",
                success:function(data){
                    $("#tb_kegiatan").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

    $("body").on("click","#detail_kegiatan", function(){
        document.getElementById("sub-transaksi").style.display = "inline-block";
        document.getElementById("sub-transaksi-title").innerHTML = "Sub Kode Transkasi";
        document.getElementById("show_kode_kegiatan").innerHTML = $(this).data("show_kode_kegiatan");
        document.getElementById("show_deskripsi_kegiatan").innerHTML = " - "+$(this).data("show_deskripsi_kegiatan");
        var id_ref_kegiatan = $(this).data("id_kegiatan");
        $("input[name='id_ref_kegiatan']").val(id_ref_kegiatan);
        $("#tb_transaksi").DataTable().clear().destroy();
        $("#tb_transaksi").DataTable({
            ajax        : {
                url:`{{url('/referensi/transaksi_surat/${id_ref_kegiatan}/detail')}}`,
                dataSrc:""
            },
            pageLength  : 5,
            lengthMenu  : [[5, 10, 20], [5, 10, 20]],
            serverSide  : false,
            columns     :
            [
                {data:"kode_transaksi"},
                {data:"deskripsi_transaksi"},
                {data:"id_transaksi", className: "text-end",
                    mRender:function(data, type, full){
                        return`<div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a href="javascript:void(0)" class="dropdown-item" id="edit_transaksi" data-id_transaksi='${data}'>Edit</a></li>
                                        <li><a href="javascript:void(0)" class="dropdown-item text-danger" id="delete_transaksi" data-id_transaksi='${data}'>Delete</a></li>
                                    </ul>
                                </div>`;
                    }
                }
            ]
        });
    });
    /** END::kegiatan */
    
    /** BEGIN::Transaksi*/
    $("body").on("click","#add_transaksi",function(){
        let count = $("#tb_transaksi").DataTable().rows( ).count() + 1;
        let kode_transaksi = document.getElementById("show_kode_kegiatan").innerHTML;

        document.getElementById("kt_modal_add_transaksi_header").innerHTML = `<h2 class="fw-bold">Tambah Kode Transaksi</h2>`;
        document.getElementById("update_transaksi").style.display = "none";
        document.getElementById("save_transaksi").style.display = "inline-block";
        $("#modal_transaksi_surat_form").trigger("reset");
        $("#kode_transaksi").val(kode_transaksi+"."+count);
        $("#kt_modal_add_transaksi").modal("show");
    });

    $("#save_transaksi").click(function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('referensi.transaksi_surat.save')}}",
            type:"POST",
            data:$("#modal_transaksi_surat_form").serialize(),
            dataType:"JSON",
            success:function(data){
                $("#tb_transaksi").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_transaksi").modal("hide");
            }
        });
    });

    $("body").on("click", "#edit_transaksi",function(){
        document.getElementById("kt_modal_add_transaksi_header").innerHTML = `<h2 class="fw-bold">Edit Kode Transaksi</h2>`;
        document.getElementById("update_transaksi").style.display = "inline-block";
        document.getElementById("save_transaksi").style.display = "none";
        let id_transaksi = $(this).data("id_transaksi");
        console.log(id_transaksi);
        $("input[name='id_transaksi']").val(id_transaksi);
        $.ajax({
            url:`{{url('referensi/transaksi_surat/${id_transaksi}/edit')}}`,
            type:"GET",
            success:function(data){
                console.log(data);
                $("input[name='kode_transaksi']").val(data.kode);
                $("input[name='deskripsi_transaksi']").val(data.deskripsi);
                $("#kt_modal_add_transaksi").modal("show");
            }
        });
    });

    $("#update_transaksi").click(function(e){
        e.preventDefault();
        let id_transaksi = $("input[name='id_transaksi']").val();
        $.ajax({
            url:`{{url('/referensi/transaksi_surat/${id_transaksi}/update')}}`,
            type:"GET",
            data:$("#modal_transaksi_surat_form").serialize(),
            success:function(data){
                $("#tb_transaksi").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_transaksi").modal("hide");
            }
        });
    });

    $("body").on("click","#delete_transaksi",function(){
        let id_transaksi = $(this).data("id_transaksi");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            $.ajax({
            url:`{{url('referensi/transaksi_surat/${id_transaksi}/delete')}}`,
            type:"GET",
            success:function(data){
                console.log(data)
                if(data>0){
                    alert("Gagal. Data ini sudah digunakan")
                    return false;
                }
                $("#tb_transaksi").DataTable().ajax.reload(null, false);
            }
        });
        }
    });
    /** END::Transaksi*/
});
</script>
@endpush
