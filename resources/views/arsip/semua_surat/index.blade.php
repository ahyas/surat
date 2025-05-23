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
                <p>Arsip Semua Surat</p>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_masuk">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>No. Surat</th>
                        <th>Jenis surat</th>
                        <th >Perihal / Isi ringkas</th>
                        <!--<th class="min-w-150px">Tujuan / Penerima</th>-->
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th>Status</th>
                        <th class="min-w-125px">Dibuat oleh / Pengirim</th>
                        <th class="text-end min-w-100px"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Post-->

<!--Start::detail-->
<div class="modal fade" id="kt_modal_detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_detail_header">
                <div id="preview-title"></div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 129.4118%;">
                                    <iframe id="preview_detail" src="#" style="top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen></iframe>
                                </div>
                                <div class="text-center pt-10"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td class="fw-bold fs-6 text-gray-800" width="120px">Nomor surat</td>
                                            <td><span class="fs-6" id="detail-nomor_surat"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold fs-6 text-gray-800">Pengirim</td>
                                            <td><span class="fs-6" id="detail-pengirim"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold fs-6 text-gray-800 text-nowrap" >Perihal / Isi ringkas</td>
                                            <td><span class="fs-6" id="detail-perihal"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold fs-6 text-gray-800">Tanggal surat</td>
                                            <td><span class="fs-6" id="detail-tgl_surat"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold fs-6 text-gray-800">Rahasia ?</td>
                                            <td><span class="fs-6" id="detail-rahasia"></span></td>
                                        </tr>
                                    </table>
                                    <span class="fw-bold fs-6 text-gray-800">History</span>
                                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100 fs-6 daftar_disposisi" id="kt_datatable_column_rendering">
                                        <thead>
                                            <tr class="fw-bold">
                                                <th>Pengirim</th>
                                                <th class="text-nowrap min-w-150px">Catatan / Pesan</th>
                                                <th class="text-nowrap min-w-150px">Petunjuk</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <td valign="top">
                                                    <div class="text-nowrap"><b>Status :</b> <span id="detail-status"></span></div>
                                                    <div id="detail-tindak_lanjut" style="display:none;">
                                                        <div class="text-nowrap"><b>Ditindaklanjuti Oleh :</b> <span id="detail-user_tindak_lanjut"></span></div>
                                                        <div class="text-nowrap"><b>Pada tanggal :</b></span> <span id="detail-tgl_tindak_lanjut"></span> / <span id="detail-waktu_tindak_lanjut"></span>  
                                                        <div class="text-nowrap"><b>Keterangan :</b> <span id="detail-keterangan"></span></div>
                                                        <div class="text-nowrap"><b>Eviden :</b> <span id="detail-eviden_tindak_lanjut"></span></div>
                                                </td>
                                                <td colspan="2" valign="top">
                                                    
                                                    <div class="text-nowrap">
                                                        <a href="" id="cetak_disposisi" target="_blank">
                                                            @if($show_print_disposisi == true)
                                                            <span class="badge badge-light-success" style="margin-bottom:10px">Cetak disposisi</span>
                                                            @endif
                                                        </a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-10">
                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--End::Modal detail-->
<div class="modal fade" id="modal_preview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <div class="d-flex flex-row" style="gap:20px">
                <h2 class="modal-title">Preview</h2>
                <a href="#" id="download_pdf" target="_blank" class="btn btn-light-success btn-sm">Download</a>
            </div>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            
            <div class="modal-body px-5 my-7" >
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 129.4118%;"><iframe id="preview" src="#" style="top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen></iframe></div>
                                <div class="text-center pt-10"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <td width="120px">Nomor surat</td>
                                            <td><span class="fs-6" id="detail-nomor_surat_keluar"></span></td>
                                        </tr>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <td>Pengirim</td>
                                            <td><span class="fs-6" id="detail-pengirim_surat_keluar"></span></td>
                                        </tr>
                                        <tr class="fw-bold fs-6 text-gray-800 text-nowrap">
                                            <td>Perihal / Isi ringkas</td>
                                            <td><span class="fs-6" id="detail-perihal_surat_keluar"></span></td>
                                        </tr>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <td>Tanggal surat</td>
                                            <td><span class="fs-6" id="detail-tgl_surat_keluar"></span></td>
                                        </tr>
                                    </table>
                                    <span class="fw-bold fs-6 text-gray-800">Daftar penerima surat</span>
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_daftar_penerima">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-10">
                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>

<!--Preview file docx-->
<div class="modal fade" id="office_preview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <div class="d-flex flex-row" style="gap:20px">
                <h2 class="modal-title">Preview</h2>
                <a href="#" id="download_office" target="_blank" class="btn btn-light-success btn-sm">Download</a>
            </div>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            
            <div class="modal-body px-5 my-7" >
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 129.4118%;"><iframe id="preview_office" src='#' width='100%' height='650px' frameborder='0'></iframe></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <td width="120px">Nomor surat</td>
                                            <td><span class="fs-6" id="template-nomor_surat_keluar"></span></td>
                                        </tr>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <td>Pengirim</td>
                                            <td><span class="fs-6" id="template-pengirim_surat_keluar"></span></td>
                                        </tr>
                                        <tr class="fw-bold fs-6 text-gray-800 text-nowrap">
                                            <td>Perihal / Isi ringkas</td>
                                            <td><span class="fs-6" id="template-perihal_surat_keluar"></span></td>
                                        </tr>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <td>Tanggal surat</td>
                                            <td><span class="fs-6" id="template-tgl_surat_keluar"></span></td>
                                        </tr>
                                    </table>
                                    <span class="fw-bold fs-6 text-gray-800">Daftar penerima surat</span>
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="template_daftar_penerima">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>

<div class="modal fade" id="kt_modal_tujuan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h2 class="modal-title">Daftar Penerima Surat</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_tembusan">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold"></tbody>
                </table>
                <div class="text-center pt-10">
                    <button type="button" id="btn-cancel" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<!--Daftar tujuan eksternal-->
<div class="modal fade" id="kt_modal_tujuan_eksternal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h2 class="modal-title">Penerima Surat Eksternal</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div id="notification2"></div>
                <div class="fv-row mb-7">
                    <label class="fw-semibold fs-6 mb-2">Tujuan</label>
                    <input type="text" name="penerima_eksternal" id="penerima_eksternal" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tujuan surat" readonly/>
                </div>
                <div class="text-center pt-10">
                    <button type="button" id="btn-cancel" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $("#tb_surat_masuk").DataTable({
        ajax        : {
            url:"{{route('arsip.semua_surat.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        order: [[3, 'desc']],
        responsive  : true,
        columns     :
        [
            {data:"no_surat", 
                mRender:function(data, type, full){
                    if(full['kerahasiaan'] == 2){
                        var a = `<span class="badge badge-light-danger">Sangat Rahasia</span>`;
                    }else if(full['kerahasiaan'] == 1){
                        var a = `<span class="badge badge-light-warning">Rahasia</span>`;
                    }else if(full['kerahasiaan'] == 0){
                        var a = `<span class="badge badge-light-success">Biasa</span>`;
                    }else{
                        var a = '';
                    }

                    if(full['is_internal'] == 1){
                        var b = `<span class="badge badge-light-default">${full['kode_klasifikasi']} - ${full['klasifikasi']}</span>`;
                    }else{
                        var b = '';
                    }

                    if(full["deskripsi"]){
                        var deskripsi = full["deskripsi"];
                    }else{
                        var deskripsi = '';
                    }
                    return`<div class="d-flex flex-column">
                            <span>${b}</span>
                            <div style='white-space: nowrap' class="text-gray-800 mb-1">${data}</div> 
                            <span>${a}</span>
                            ${deskripsi}                      
                            </div>`;
                }
            },
            {data:"jenis_surat",
                mRender:function(data, type, full){
                    if(data == 1){
                        var jenis_surat = `<span class="badge badge-light-success" style="margin-bottom:10px">Surat Masuk</span>`;
                    }else{
                        var jenis_surat = `<span class="badge badge-light-info" style="margin-bottom:10px">Surat Keluar</span>`;
                    }

                    return`${jenis_surat}`;
                }
            },
            {data:"perihal"},
            {data:"tgl_surat"},
            {data:"status",
                mRender:function(data, type, full){
                    if(full["jenis_surat"] == 1){
                        if(full['id_status'] == 3){
                            return `
                                <div style='white-space: nowrap'>${data}</div> 
                                <span class="badge badge-light-primary">Selesai</span>                       
                                `;
                        }else if(full['id_status'] == 1 || full['id_status'] == 2 || full['id_status'] == 4 || full['id_status'] == 5){
                            return `
                                <div style='white-space: nowrap'>${data}</div> 
                                <span class="badge badge-light-success">On-Process</span>                       
                                `;
                        }else{
                            return `
                                <span class="badge badge-light-danger">Unprocessed</span>                       
                                `;
                        }
                    }else{
                        return '<span>Arsip pribadi</span>';
                    }
                }
            },
            {data:"pengirim",
                mRender:function(data, type, full){
                    if(full['jenis_surat'] == 1){
                        if(full['is_internal'] == 1){
                            var a = `<span class="badge badge-light-primary">Mahkamah Agung</span>`;
                        }else if(full['is_internal'] == 2){
                            var a = `<span class="badge badge-light-warning">Non Mahkamah Agung</span>`;
                        }else{
                            var a = `<span class="badge badge-light-danger">Undefined</span>`;
                        }
                    }else{
                        var a = '';
                    }

                    return `
                    <div class="d-flex flex-column">
                        <span>${a}</span>
                        <span>${data}</span>
                    </div>`;
                }
            },
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
                    var file = full["file"];
                    if(full["jenis_surat"] == 1){
                        if(full['id_status'] == 1 || full['id_status'] == 2 || full['id_status'] == 3 || full['id_status'] == 4 || full['id_status'] == 5){
                            var btn = 'disabled';
                        }else{
                            var btn = '';
                        }

                        return`<div class="dropdown">
                                <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                    <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                        <li>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="detail_surat_masuk" data-id_surat_masuk='${data}' data-url="{{asset('/public/uploads/surat_masuk/${file}')}}">Detail</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>`;
                    }else{
                        return`<div class="dropdown">
                                <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                    <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                        <li>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="detail_arsip" data-id_surat_keluar='${data}' data-filename='${file}' data-url="{{asset('/public/uploads/surat_keluar/${file}')}}">Detail</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>`;
                    }

                }
            }
        ]
    });

    $("body").on("click","#daftar_tujuan",function(){
        var id_surat = $(this).data("id_surat");
        console.log("id surat",id_surat)
        $("#kt_modal_tujuan").modal("show");
        $("#tb_tembusan").DataTable({
            ajax        : {
                url:`{{url('transaksi/surat_keluar/${id_surat}/detail')}}`,
                dataSrc:function(res){  
                    return res.table
                }
            },
            "bDestroy": true,
            searching   : false, paging: false, info: false,
            serverSide  : false,
            ordering    : false,
            responsive  : true,
            columns     :
            [
                {data:"nama_penerima",
                    mRender:function(data, type, full){
                        return`<div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">${data}</div>
                            <span>${full['email']}</span>
                        </div>`;
                    },
                },
                {data:"nama_bidang", className:"text-end"}
            ]
        });
    });

    $(("body")).on("click","#tujuan_eksternal", function(){
        
        let id_surat = $(this).data("id_surat");        
        console.log("id ",id_surat)
        $.ajax({
            url:`{{url('transaksi/surat_keluar/${id_surat}/detail_eksternal')}}`,
            type:"GET",
            success:function(data){
                $("#penerima_eksternal").val(data.tujuan)
                
                $("#kt_modal_tujuan_eksternal").modal("show");
            }
        })
    });

    $("body").on("click","#detail_surat_masuk", function(){
        document.getElementById("preview-title").innerHTML = `<h2 class="fw-bold">Detail surat</h2>`;
        var id_surat = $(this).data("id_surat_masuk");
        var url = $(this).data("url");
        var link = document.getElementById("cetak_disposisi");
        link.setAttribute("href", `{{url('/transaksi/surat_masuk/disposisi/${id_surat}/lembar_disposisi/print')}}`);
        loadingPage(true);
        $.ajax({
            url:`{{url('transaksi/surat_masuk/${id_surat}/detail')}}`,
            type:"GET",
            success:function(data){

                showDaftarDisposisi(id_surat);
                if(data[0].id_status == 3){
                    document.getElementById("detail-tindak_lanjut").style.display = "inline-block";
                }else{
                    document.getElementById("detail-tindak_lanjut").style.display = "none";
                }
                document.getElementById("preview_detail").src = url;  
                document.getElementById("detail-nomor_surat").innerHTML = data[0].no_surat;
                document.getElementById("detail-pengirim").innerHTML = data[0].pengirim;
                document.getElementById("detail-perihal").innerHTML = data[0].perihal;
                document.getElementById("detail-rahasia").innerHTML = data[0].rahasia == 'false' ? 'Tidak' : 'Ya';
                document.getElementById("detail-tgl_surat").innerHTML = data[0].tgl_surat;
                document.getElementById("detail-user_tindak_lanjut").innerHTML = data[0].jabatan_pegawai ? data[0].jabatan_pegawai : ' - ';
                document.getElementById("detail-tgl_tindak_lanjut").innerHTML = data[0].tgl_tindak_lanjut ? data[0].tgl_tindak_lanjut : ' - ';
                document.getElementById("detail-waktu_tindak_lanjut").innerHTML = data[0].waktu_tindak_lanjut ? data[0].waktu_tindak_lanjut : ' - ';
                document.getElementById("detail-status").innerHTML = data[0].status;
                document.getElementById("detail-keterangan").innerHTML = data[0].catatan_tindaklanjut ? data[0].catatan_tindaklanjut : ' - ';
                //status on process                    
                var url_eviden = $(this).data("url");
                document.getElementById("detail-eviden_tindak_lanjut").innerHTML = data[0].file_tindak_lanjut ? `<a id="eviden_tindak_lanjut" target="_blank" href="{{asset('/public/uploads/tindak_lanjut/${data[0].file_tindak_lanjut}')}}">${data[0].file_tindak_lanjut}</a>` : ' - ';
                loadingPage(false);
                $("#kt_modal_detail").modal("show");
            }
        });
    });

    $("body").on("click","#detail_arsip", function(){

        var filename = $(this).data("filename");
        var extension = filename.substr(filename.indexOf('.')); 
        var url = $(this).data('url')
        var id_surat_keluar = $(this).data('id_surat_keluar');
        
            console.log(id_surat_keluar)
            $.ajax({
                url:`{{url('/transaksi/surat_keluar/${id_surat_keluar}/detail_eksternal')}}`,
                type:"GET",
                success:function(data){
                    console.log("Data ",data)
                    
                    if(extension == '.pdf'){
                        document.getElementById("detail-nomor_surat_keluar").innerHTML = data.no_surat;
                        document.getElementById("detail-pengirim_surat_keluar").innerHTML = data.name;
                        document.getElementById("detail-perihal_surat_keluar").innerHTML = data.perihal;
                        document.getElementById("detail-tgl_surat_keluar").innerHTML = data.tgl_surat;
                        $("#modal_preview").modal("show");
                        document.getElementById("preview").src = url;
                        document.getElementById("download_pdf").href = url;
                        
                    }else{
                        document.getElementById("template-nomor_surat_keluar").innerHTML = data.no_surat;
                        document.getElementById("template-pengirim_surat_keluar").innerHTML = data.name;
                        document.getElementById("template-perihal_surat_keluar").innerHTML = data.perihal;
                        document.getElementById("template-tgl_surat_keluar").innerHTML = data.tgl_surat;
                        $("#office_preview").modal("show");
                        document.getElementById("preview_office").src = `https://view.officeapps.live.com/op/embed.aspx?src=${url}`;
                        document.getElementById("download_office").href = url;
                    }

                    showDaftarPenerimaSurat(id_surat_keluar);
                    
                }
            });
        
    })

    function loadingPage(active){
        const loadingEl = document.createElement("div");
        document.body.prepend(loadingEl);
        loadingEl.classList.add("page-loader");
        loadingEl.classList.add("flex-column");
        loadingEl.classList.add("bg-dark");
        loadingEl.classList.add("bg-opacity-25");
        loadingEl.innerHTML = `
            <span class="spinner-border text-primary" role="status"></span>
            <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
        `;

        if(active == true){
            document.body.style.overflow = 'hidden';
            KTApp.showPageLoading();
        }else{
            document.body.style.overflow = 'scroll';
            KTApp.hidePageLoading();
            loadingEl.remove();
        }
    }

    function showDaftarPenerimaSurat(id_surat_keluar){
        console.log("Daftar peneirma")
        $("#tb_daftar_penerima, #template_daftar_penerima").DataTable().clear().destroy();
        $("#tb_daftar_penerima, #template_daftar_penerima").DataTable({
            ajax        : {
                url:`{{url('transaksi/surat_keluar/${id_surat_keluar}/detail')}}`,
                dataSrc:function(res){  
                    return res.table
                }
            },
            searching   : false, paging: false, info: false,
            serverSide  : false,
            ordering    : false,
            responsive  : true,
            columns     :
            [
                {data:"nama_penerima",
                    mRender:function(data, type, full){
                        return`<div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">${data}</div>
                            <span>${full['email']}</span>
                        </div>`;
                    },
                },
                {data:"nama_bidang", className:"text-end"}
            ]
        });
    }

    function showDaftarDisposisi(id_surat){
        $(".daftar_disposisi").DataTable().clear().destroy();
        $(".daftar_disposisi").DataTable({
            ajax        : {
                url     :`{{url('transaksi/surat_masuk/disposisi/${id_surat}/daftar_disposisi')}}`,
                dataSrc :""
            },
            serverSide  : false,
            ordering    : false,
            responsive  : true,
            bPaginate   : false,
            searching   : false,
            info        :false,
            columns     :
            [
                {data:"jab_pengirim", 
                    mRender:function(data, type, full){
                        let penerima = full["jab_penerima"];
                        let tanggal = full['tanggal'];
                        let waktu = full["waktu"];
                        return`<span style='white-space: nowrap'><b>Dari</b> : ${data}</span><br>
                        <span style='white-space: nowrap'><b>Ke</b> : ${penerima}</span><br>
                        <span style='white-space: nowrap'>${tanggal} / ${waktu}</span>`;
                    }
                },
                {data:"catatan", className:"text-end",
                    mRender:function(data){
                        if(data == null){
                            return '<span> - </span>';
                        }else{
                            return `<span> ${data} </span>`;
                        }
                    }
                },
                {data:"petunjuk", className:"text-end",
                    mRender:function(data){
                        if(data == null){
                            return '<span> - </span>';
                        }else{
                            return `<span> ${data} </span>`;
                        }
                    }
                },
            ]
        });
    }
});
</script>
@endpush
