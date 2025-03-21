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
                        <th>Dari</th>
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
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--End::Modal detail-->

    <!--Start modal disposisi -->
    <div class="modal fade" id="kt_modal_add_disposisi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_surat_masuk_header">
                    <div id="title"></div>
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
                                        <iframe id="preview_disposisi" src="#" style="top: 0; left: 0; width: 100%; height: 100%; position: absolute; border: 0;" allowfullscreen></iframe>
                                    </div>
                                    <div class="text-center pt-10"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form id="kt_modal_add_disposisi_form" name="add_surat_masuk_form" class="form" action="#" enctype="multipart/form-data">
                                {{csrf_field()}}
                            <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <div id="notification"></div>

                                        <input type="hidden" name="id_surat_masuk" class="form-control" />
                                        <input type="hidden" name="id_status" class="form-control" />
                                        <div class="fv-row mb-7" >
                                            <label class="required fw-semibold fs-6 mb-2">Nomor surat</label>
                                            <input type="text" name="nomor_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nomor surat" disabled/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Pengirim</label>
                                            <input type="text" name="pengirim" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pengirim surat" disabled/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Perihal / Isi ringkas</label>
                                            <textarea class="form-control form-control-solid" placeholder="Perihal surat" id="perihal" name="perihal" rows="3" disabled></textarea>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tanggal surat" disabled/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2">Sifat surat</label>
                                            <span class="fs-6" id="rahasia"></span>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Disposisi kepada</label>
                                            <select name="tujuan" id="tujuan" class="form-select form-select form-select-solid my_input" data-control="select2" data-close-on-select="true" data-placeholder="Select an option" data-allow-clear="true" readonly>
                                                <option value="">Pilih tujuan surat</option>
                                                @foreach($user as $row)
                                                    <option value="{{$row->id_parent_user}}">{{$row->nama_pegawai}} - {{$row->jabatan_pegawai}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Petunjuk</label>
                                            <select name="petunjuk" id="petunjuk" class="form-select form-select form-select-solid my_input" data-control="select2" data-close-on-select="true" data-placeholder="Select an option" data-allow-clear="true" required >
                                                <option value="">Pilih petunjuk surat</option>
                                                @foreach($petunjuk as $row)
                                                    <option value="{{$row->id}}">{{$row->petunjuk_disposisi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Catatan</label>
                                            <textarea class="form-control form-control-solid" placeholder="Catatan disposisi" id="catatan" name="catatan" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary kirim_disposisi" id="kirim_disposisi" data-kt-indicator="off">
                                            <span class="indicator-progress"> 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            Kirim
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                            </div>
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
    <!--End modal disposisi -->

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
            {data:"dari"},
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
                    //status dinaikan
                    if(full["id_status"] == 4){
                        var btn_balas = '';
                        //status diturunkan
                    }else{
                        var btn_balas = '';
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
                                            <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn ${btn_balas}" id="disposisi_surat_masuk" data-id_surat_masuk='${data}' data-url="{{asset('/public/uploads/surat_masuk/${file}')}}">Disposisi</a>
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

    $("body").on("click", "#disposisi_surat_masuk", function(){
        document.querySelector(".kirim_disposisi").setAttribute("data-kt-indicator", "off");
        document.querySelector(".kirim_disposisi").removeAttribute("disabled");
        document.getElementById("kirim_disposisi").style.display = "inline-block";
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add Disposisi</h2>`;
        $("#kt_modal_add_disposisi_form").trigger("reset");
        $("input[name='id_status']").val("1"); //status 1 disposisi, status 2 diteruskan
        let id_surat = $(this).data("id_surat_masuk");
        $("input[name='id_surat_masuk']").val(id_surat);
        loadingPage(true);
        var url = $(this).data("url");
        
        $.ajax({
            url:`{{url('/transaksi/surat_masuk/${id_surat}/edit')}}`,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data.count_disposisi)
                if(data.count_disposisi == 0){
                    document.getElementById("preview_disposisi").src = url; 
                    $("input[name='nomor_surat']").val(data.table[0].no_surat);
                    $("input[name='pengirim']").val(data.table[0].pengirim);
                    $("#perihal").val(data.table[0].perihal);
                    let id_penerima = data.tujuan_surat[0] ? data.tujuan_surat[0].id_penerima : "";
                    $("#tujuan").val(id_penerima).trigger('change');    
                    fp.setDate(data.table[0].tgl_surat, true, "Y-m-d");
                    if(data.table[0].kerahasiaan == 0){
                        var sifat = '<span class="badge badge-light-success">Biasa</span>';
                    }else if(data.table[0].kerahasiaan == 1){
                        var sifat = '<span class="badge badge-light-warning">Rahasia</span>';
                    }else{
                        var sifat = '<span class="badge badge-light-danger">Sangat rahasia</span>'
                    }
                    document.getElementById("rahasia").innerHTML = sifat;
                    loadingPage(false);
                    $("#kt_modal_add_disposisi").modal("show");
                }else{
                    loadingPage(false);
                    alert(`Error: Surat Nomor ${data.table[0].no_surat} sedang di disposisi dan masih dalam proses. Lihat detail surat untuk mengetahui lebih lanjut.`);
                }
            }
        });
        
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
                console.log(data)
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
                
                showDaftarDisposisi(id_surat);
                document.getElementById("preview_detail").src = url;  
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
                document.getElementById("detail-user_tindak_lanjut").innerHTML = data[0].tindaklanjut_oleh ? data[0].tindaklanjut_oleh : ' - ';
                document.getElementById("detail-tgl_tindak_lanjut").innerHTML = data[0].tgl_tindak_lanjut ? data[0].tgl_tindak_lanjut : ' - ';
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

    $("body").on("click", "#kirim_disposisi",function(e){
        e.preventDefault();
        setButtonSpinner(".kirim_disposisi", "on");
        $.ajax({
            url:"{{route('transaksi.surat_masuk.disposisi.kirim')}}",
            type:"POST",
            dataType:"JSON",
            data    : $("#kt_modal_add_disposisi_form").serialize(),
            dataType: "JSON",
            success:function(data){
                console.log(data);
                if(!data.success){
                    let err_catatan = data.message.err_catatan  ? `<li>${data.message.err_catatan}</li>` : ``;
                    let err_tujuan = data.message.err_tujuan  ? `<li>${data.message.err_tujuan}</li>` : ``;
                    let err_petunjuk = data.message.err_petunjuk ? `<li>${data.message.err_petunjuk}</li>` : ``;

                    document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_catatan+err_tujuan+err_petunjuk+"</div></div>";  

                    setButtonSpinner(".kirim_disposisi", "off");
                    
                    return false;
                }

                if(confirm("Apakah semua data sudah benar?")){
                    setButtonSpinner(".kirim_disposisi", "off");
                    $("#kt_modal_add_disposisi").modal("hide");
                    loadingPage(true);
                    $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                }
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
