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
                <p>Surat Masuk</p>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    
                    <button type="button" class="btn btn-primary btn-sm" id="add_surat_masuk">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Surat Masuk</button>
                    <!--end::Add user-->
                </div>

                <div class="modal fade" id="kt_modal_add_surat_masuk" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_surat_masuk_header">
                                <div id="title"></div>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_surat_masuk_form" name="add_surat_masuk_form" class="form" action="#" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        
                                        <div id="notification"></div>
                                        
                                        <input type="hidden" name="id_surat_masuk" class="form-control" />
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Nomor surat</label>
                                            <input type="text" name="nomor_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nomor surat" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Pengirim</label>
                                            <div class="d-flex fv-row">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <!--begin::Input-->
                                                    <input class="form-check-input me-3" name="pengirim_surat" type="radio" value="1" id="kt_modal_update_role_option_0" />
                                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                        <div class="fw-bold text-gray-800">Mahkamah Agung</div>
                                                    </label>
                                                    
                                                    <input class="form-check-input me-3" name="pengirim_surat" type="radio" value="2" id="kt_modal_update_role_option_1" style="margin-left:20px"/>
                                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                        <div class="fw-bold text-gray-800">Non Mahkamah Agung</div>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                            
                                        </div>
                                        <div>
                                            <div class="fv-row mb-7">
                                                <input type="text" name="pengirim" id="pengirim" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pengirim surat" disabled/>
                                            </div>
                                        </div>
                                        <div id="display-pengirim-internal">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">Kode Klasifikasi</label>
                                                <select name="klasifikasi" id="klasifikasi" class="form-select form-select-solid" data-placeholder="Select an option" data-hide-search="true">
                                                    <option disabled selected value="0">Pilih kategori klasifikasi</option>
                                                    @foreach($klasifikasi as $row)
                                                        <option value="{{$row->id_klasifikasi}}">{{$row->kode_klasifikasi}} - {{$row->deskripsi_klasifikasi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Perihal / Isi ringkas</label>
                                            <textarea class="form-control form-control-solid" placeholder="Perihal surat" id="perihal" name="perihal" rows="3" required></textarea>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tanggal surat" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">File</label>
                                            <input class="form-control form-control-solid mb-3 mb-lg-0" name="file_surat" type="file" id="file_surat" >
                                        </div>
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions--> 
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary save_surat_masuk" id="save_surat_masuk" data-kt-indicator="off">
                                            <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            Save
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
                <!--end::Modal - Add task-->
            </div>
            <!--end::Card toolbar-->
        </div>

        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_masuk">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">No. Surat</th>
                        <th class="min-w-125px">Pengirim</th>
                        <th >Perihal / isi ringkas</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th class="min-w-125px">Diinput pada</th>
                        <th >Status</th>
                        <th class="text-end min-w-125px"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_scrollable_2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Preview</h2>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            
            <div class="modal-body" >
                <div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 129.4118%;"><iframe id="preview" src="#" style="top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen></iframe></div>
            </div>
        </div>
    </div>      
</div>

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
                                                <td>
                                                    <span class="fs-6" id="detail-nomor_surat"></span>
                                                    <span class="fs-6" id="detail-klasifikasi"></span>
                                                </td>
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
                                                <td class="fw-bold fs-6 text-gray-800">Sifat surat</td>
                                                <td><span class="fs-6" id="detail-rahasia"></span></td>
                                            </tr>
                                        </table>
                                        <span class="fw-bold fs-6 text-gray-800">History</span>
                                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100 fs-6 daftar_disposisi" id="kt_datatable_column_rendering">
                                            <thead>
                                                <tr class="fw-bold">
                                                    <th>Pengirim</th>
                                                    <th class="text-nowrap">Catatan / Pesan</th>
                                                    <th class="text-nowrap min-w-200px">Petunjuk</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>
                                                        <div class="text-nowrap"><b>Status :</b> <span id="detail-status"></span></div>
                                                        <div id="detail-tindak_lanjut" style="display:none;">
                                                            <div class="text-nowrap"><b>Ditindaklanjuti Oleh :</b> <span id="detail-user_tindak_lanjut"></span></div>
                                                            <div class="text-nowrap"><b>Pada tanggal :</b></span> <span id="detail-tgl_tindak_lanjut"></span> / <span id="detail-waktu_tindak_lanjut"></span>  
                                                            <div class="text-nowrap"><b>Keterangan :</b> <span id="detail-keterangan"></span></div>
                                                            <div class="text-nowrap"><b>Eviden :</b> <span id="detail-eviden_tindak_lanjut"></span></div>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){

    var date = document.getElementById("tgl_surat");
    flatpickr(date, {
        dateFormat: "Y-m-d",
    });

    var fp = date._flatpickr;
    
    var id_role = `{{$data['id_role']}}`;
   
    $("#tb_surat_masuk").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_masuk.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        ordering    :false,
        responsive  : true,
        drawCallback:function(settings){
            loadingPage(false);
            document.body.style.overflow = 'visible';
        },
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

                    if(data.length>=29){
                        var result = data.slice(0, 29)+" ...";   
                    }else{
                        var result = data
                    }

                    return`<div class="d-flex flex-column">
                                <span>${b}</span>
                                <div class="text-gray-800 mb-1">${result} <div>
                                <span>${a}</span>                   
                            </div>`;
                }
            },
            {data:"pengirim", 
                mRender:function(data, type, full){
                    if(full['is_internal'] == 1){
                        var a = `<span class="badge badge-light-primary">Mahkamah Agung</span>`;
                    }else if(full['is_internal'] == 2){
                        var a = `<span class="badge badge-light-warning">Non Mahkamah Agung</span>`;
                    }else{
                        var a = ``;
                    }

                    return `
                    <div class="d-flex flex-column">
                        <span>${a}</span>
                        <span>${data}</span>
                    </div>`;
                }
            },
            {data:"perihal",
                mRender:function(data){
                    if(data.length>=90){
                        var result = data.slice(0, 90);   
                        return result+" ..."
                    }else{
                        var result = data
                        return result
                    }
                    
                }
            },
            {data:"tgl_surat",
                mRender:function(data){
                    return`<div style='white-space: nowrap'>${data}</div>`
                }
            },
            {data:"tanggal_input"},
            {data:"status",
                mRender:function(data, type, full){
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
                }
            },
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
                    var file = full["file"];

                    return`<div class="dropdown">
                            <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="detail_surat_masuk" data-id_surat_masuk='${data}' data-url="{{asset('/uploads/surat_masuk/${file}')}}">Detail</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>`;
                }
            }
            
        ]
    });

    document.getElementById("display-pengirim-internal").style.display = "none";

    $("body").on("change", "input[name='pengirim_surat']", function(){

        var penerima = $(this).val();
        console.log(penerima)
        
        document.getElementById("pengirim").removeAttribute("disabled");
        document.getElementById("pengirim").value = '';
        document.getElementById("pengirim").focus();
        
        if(penerima == 2){
            console.log("external")
            document.getElementById("display-pengirim-internal").style.display = "none";
        }else{
            console.log("internal")
            document.getElementById("display-pengirim-internal").style.display = "inline-block";
        }

    });

    $("body").on("click", "#lampiran", function(){
        $("#kt_modal_scrollable_2").modal("show");
        document.getElementById("preview").src = $(this).data("url")
    });

    $("body").on("click","#detail_surat_masuk", function(){
        document.getElementById("preview-title").innerHTML = `<h2 class="fw-bold">Detail surat</h2>`;
        var id_surat = $(this).data("id_surat_masuk");
        showDaftarDisposisi(id_surat);
        var url = $(this).data("url");
        loadingPage(true);
        $.ajax({
            url:`{{url('transaksi/surat_masuk/${id_surat}/detail')}}`,
            type:"GET",
            success:function(data){
                console.log(data);
                document.getElementById("preview_detail").src = url;  
                if(data[0].is_internal == 1){
                    document.getElementById("detail-klasifikasi").innerHTML = '<span>'+data[0].kode_klasifikasi+' - '+data[0].klasifikasi+'</span>';
                }else{
                    document.getElementById("detail-klasifikasi").innerHTML = '';
                }
                document.getElementById("detail-nomor_surat").innerHTML = data[0].no_surat;
                document.getElementById("detail-pengirim").innerHTML = data[0].pengirim;
                document.getElementById("detail-perihal").innerHTML = data[0].perihal;
                if(data[0].kerahasiaan == 0){
                    var sifat = '<span class="badge badge-light-success">Biasa</span>';
                }else if(data[0].kerahasiaan == 1){
                    var sifat = '<span class="badge badge-light-warning">Rahasia</span>';
                }else if(data[0].kerahasiaan == 2){
                    var sifat = '<span class="badge badge-light-danger">Sangat rahasia</span>'
                }else{
                    var sifat = '<span class="badge badge-light-secondary">Undefined</span>';
                }
                document.getElementById("detail-rahasia").innerHTML = sifat;
                document.getElementById("detail-tgl_surat").innerHTML = data[0].tgl_surat;

                loadingPage(false);
                $("#kt_modal_detail").modal("show");
                console.log(data);
            }
        });
    });

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
                {data:"petunjuk",
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

    $("body").on("click","#add_surat_masuk", function(){
        document.getElementById("display-pengirim-internal").style.display = "none";
        document.getElementById("pengirim").setAttribute("disabled", "disabled");

        document.querySelector(".save_surat_masuk").setAttribute("data-kt-indicator", "off");
        document.querySelector(".save_surat_masuk").removeAttribute("disabled");
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add surat masuk</h2>`;
        $("#kt_modal_add_surat_masuk_form").trigger("reset");
        document.getElementById("notification").innerHTML ='';
        $("#bidang").val("").trigger('change');
        let today = new Date();
        fp.setDate(today, true, "Y-m-d");
        $("#kt_modal_add_surat_masuk").modal("show");
    });

    $("#save_surat_masuk").click(function(e){
        e.preventDefault();
        var btn = document.querySelector(".save_surat_masuk");
        btn.setAttribute("data-kt-indicator", "on");
        btn.setAttribute("disabled","disabled");
        
        var formData = new FormData(document.getElementById("kt_modal_add_surat_masuk_form"));        
        $.ajax({
            url:`{{route('transaksi.surat_masuk.save')}}`,
            type:"POST",
            dataType:"JSON",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            console.log(data.errors)
                if (!data.success) {
                    let err_nomor_surat = data.errors.nomor_surat  ? `<li>${data.errors.nomor_surat}</li>` : ``;
                    let err_pengirim_surat = data.errors.pengirim_surat  ? `<li>${data.errors.pengirim_surat}</li>` : ``;
                    let err_klasifikasi = data.errors.klasifikasi  ? `<li>${data.errors.klasifikasi}</li>` : ``;
                    let err_pengirim = data.errors.pengirim  ? `<li>${data.errors.pengirim}</li>` : ``;
                    let err_perihal = data.errors.perihal  ? `<li>${data.errors.perihal}</li>` : ``;
                    let err_tgl_surat = data.errors.tgl_surat  ? `<li>${data.errors.tgl_surat}</li>` : ``;
                    let err_file_surat = data.errors.file_surat  ? `<li>${data.errors.file_surat}</li>` : ``;

                    document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_nomor_surat+err_pengirim_surat+err_klasifikasi+err_pengirim+err_perihal+err_tgl_surat+err_file_surat+"</div></div>";
                    
                    btn.setAttribute("data-kt-indicator", "off");
                    btn.removeAttribute("disabled");
                    return false;                  
                } 
                    loadingPage(true);
                    $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_surat_masuk").modal("hide");
                
            }
        });
    });

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

});
</script>
@endpush

