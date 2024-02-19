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
                <p>Arsip surat masuk</p>
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
                        <th class="min-w-125px">Pengirim</th>
                        <th >Perihal / Isi ringkas</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th>Status</th>
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
                                                <th class="text-nowrap">Catatan / Pesan</th>
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
@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $("#tb_surat_masuk").DataTable({
        ajax        : {
            url:"{{route('arsip.surat_masuk.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        responsive  : true,
        columns     :
        [
            {data:"no_surat", 
                mRender:function(data, type, full){
                    if(full['rahasia'] == 'true'){
                        var a = `<span class="badge badge-light-danger">Rahasia</span>`;
                    }else{
                        var a = `<span class="badge badge-light-success">Biasa</span>`;
                    }

                    return`<div class="d-flex flex-column">
                            <div style='white-space: nowrap' class="text-gray-800 mb-1">${data}</div> 
                            <span>${a}</span>                       
                            </div>`;
                }
            },
            {data:"pengirim"},
            {data:"perihal"},
            {data:"tgl_surat"},
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
                }
            }
        ]
    });

    $("body").on("click","#detail_surat_masuk", function(){
        document.getElementById("preview-title").innerHTML = `<h2 class="fw-bold">Detail surat</h2>`;
        var id_surat = $(this).data("id_surat_masuk");
        var url = $(this).data("url");
        loadingPage(true);
        $.ajax({
            url:`{{url('transaksi/surat_masuk/${id_surat}/detail')}}`,
            type:"GET",
            success:function(data){
                console.log(data[0].rahasia )
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
                console.log(data);
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
                }
            ]
        });
    }
});
</script>
@endpush
