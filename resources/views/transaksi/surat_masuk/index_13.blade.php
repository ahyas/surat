@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="content flex-column-fluid" id="kt_content">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <p>Surat Masuk</p>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_masuk">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>No. Surat</th>
                        <th class="min-w-125px">Pengirim</th>
                        <th >Perihal / Isi ringkas</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th class="min-w-125px">Diinput pada</th>
                        <th>Status</th>
                        <th class="text-end min-w-125px"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>
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
                                                <td class="fw-bold fs-6 text-gray-800 text-nowrap">Perihal / Isi ringkas</td>
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
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--End::Modal detail-->

     <!--Start::tindak lanjut-->
     <div class="modal fade" id="kt_modal_add_tindaklanjut" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <div id="tindaklanjut-title"></div>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body px-5 my-7">
                
                    <form id="kt_modal_add_tindaklanjut_form" name="add_tindaklanjut_form" class="form" action="#" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                            <div id="tindaklanjut-notification"></div>

                            <input type="hidden" name="id_surat_masuk" class="form-control" />
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2">Keterangan</label>
                                <textarea class="form-control form-control-solid" placeholder="Keterangan tindak lanjut" id="tindaklanjut_catatan" name="tindaklanjut_catatan" rows="3"></textarea>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="required fw-semibold fs-6 mb-2" id="file_tindaklanjut">File eviden</label>
                                <input class="form-control form-control-solid mb-3 mb-lg-0" name="file_tindaklanjut" type="file" id="file_tindaklanjut" required>
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-10">
                            <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary save_tindaklanjut" id="save_tindaklanjut" data-kt-indicator="off">
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
    <!--End::Modal tindak lanjut-->

</div>

@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    
    var id_role = `{{$data['id_role']}}`;
    
    $("#tb_surat_masuk").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_masuk.get_data')}}",
            dataSrc:""
        },
        ordering    : false,
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
                            <div style='white-space: nowrap' class="text-gray-800 mb-1">${result}</div> 
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
                        return `<div style='white-space: nowrap'>${data}</div> 
                            <span class="badge badge-light-primary">Selesai</span>`;
                    }else{
                        return `<div style='white-space: nowrap'>${data}</div> 
                            <span class="badge badge-light-success">On-Process</span>`;
                    }
                }
            },
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
                    //status on process
                    if(full["id_status"]>1){
                        var btn = 'disabled';
                    //status selesai
                    }else{
                        var btn = '';
                    }

                    var file = full["file"];
                    return`<div class="dropdown">
                            <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="detail_surat_masuk" data-id_surat_masuk='${data}' data-url="{{asset('/public/uploads/surat_masuk/${file}')}}">Detail</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn ${btn}" id="tindak_lanjut_surat_masuk" data-id_surat_masuk='${data}'}}">Tindak lanjut</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>`;
                }
            }
        ]
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
            searching: false,
            info:false,
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

    $("body").on("click","#detail_surat_masuk", function(){
        document.getElementById("preview-title").innerHTML = `<h2 class="fw-bold">Detail surat</h2>`;
        var id_surat = $(this).data("id_surat_masuk");
        var url = $(this).data("url");
        loadingPage(true);
        $.ajax({
            url:`{{url('transaksi/surat_masuk/${id_surat}/detail')}}`,
            type:"GET",
            success:function(data){
                console.log(data);
                //status tindak lanjut
                if(data[0].id_status == 3){
                    document.getElementById("detail-tindak_lanjut").style.display = "inline-block";
                }else{
                    document.getElementById("detail-tindak_lanjut").style.display = "none";
                }

                if(data[0].is_internal == 1){
                    document.getElementById("detail-klasifikasi").innerHTML = '<span>'+data[0].kode_klasifikasi+' - '+data[0].klasifikasi+'</span>';
                }else{
                    document.getElementById("detail-klasifikasi").innerHTML = '';
                }

                if(data[0].kerahasiaan == 0){
                    var sifat = '<span class="badge badge-light-success">Biasa</span>';
                }else if(data[0].kerahasiaan == 1){
                    var sifat = '<span class="badge badge-light-warning">Rahasia</span>';
                }else if(data[0].kerahasiaan == 2){
                    var sifat = '<span class="badge badge-light-danger">Sangat rahasia</span>'
                }else{
                    var sifat = '<span class="badge badge-light-secondary">Undefined</span>';
                }

                showDaftarDisposisi(id_surat);
                document.getElementById("preview_detail").src = url;  
                document.getElementById("detail-nomor_surat").innerHTML = data[0].no_surat;
                document.getElementById("detail-pengirim").innerHTML = data[0].pengirim;
                document.getElementById("detail-perihal").innerHTML = data[0].perihal;
                document.getElementById("detail-rahasia").innerHTML = sifat;
                document.getElementById("detail-tgl_surat").innerHTML = data[0].tgl_surat;
                document.getElementById("detail-user_tindak_lanjut").innerHTML = data[0].tindaklanjut_oleh ? data[0].tindaklanjut_oleh : ' - ';
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

    $("body").on("click","#tindak_lanjut_surat_masuk", function(){
        document.getElementById("tindaklanjut-title").innerHTML = `<h2 class="fw-bold">Add Tindak Lanjut</h2>`;
        var id_surat = $(this).data("id_surat_masuk");
        $("input[name='id_surat_masuk']").val(id_surat);
        console.log(id_surat);
        $("#kt_modal_add_tindaklanjut").modal("show");
    });

    $("#save_tindaklanjut").click(function(e){
        e.preventDefault();
        setButtonSpinner(".save_tindaklanjut", "on");
        console.log("Save");
        var formData = new FormData(document.getElementById("kt_modal_add_tindaklanjut_form"));  
        $.ajax({
            url:"{{route('transaksi.surat_masuk.tindak_lanjut')}}",
            type:"POST",
            dataType:"JSON",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log(data);

                if(!data.success){
                    let err_catatan = data.message.err_catatan  ? `<li>${data.message.err_catatan}</li>` : ``;
                    let err_file = data.message.err_file_tindaklanjut  ? `<li>${data.message.err_file_tindaklanjut}</li>` : ``;

                    document.getElementById("tindaklanjut-notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='tindaklanjut-notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_catatan+err_file+"</div></div>";  

                    setButtonSpinner(".save_tindaklanjut", "off");
                    
                    return false;
                }

                $("#kt_modal_add_tindaklanjut").modal("hide");
                setButtonSpinner(".save_tindaklanjut", "off");
                loadingPage(true);
                $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                alert("Surat telah ditindaklanjuti dan akan di arsipkan")

            }
        })
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

    function setButtonSpinner(query_selector, status){
        var btn = document.querySelector(query_selector);
        btn.setAttribute("data-kt-indicator", status);

        if(status == "off"){
            btn.removeAttribute("disabled");
        }else{
            btn.setAttribute("disabled","disabled");
        }

        return btn;
    }

});
</script>
@endpush
