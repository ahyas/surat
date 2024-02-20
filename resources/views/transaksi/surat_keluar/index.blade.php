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
                <p>Surat Keluar</p>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    
                    <button type="button" class="btn btn-primary btn-sm" id="add_surat_keluar">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Surat Keluar</button>
                    <!--end::Add user-->
                </div>

                <div class="modal fade" id="kt_modal_add_surat_keluar" tabindex="-1" aria-hidden="true">
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
                            
                                <form id="kt_modal_add_surat_keluar_form" name="add_surat_keluar_form" class="form" method="POST">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <div id="notification"></div>

                                        <input type="hidden" name="id_surat_keluar" class="form-control" />
                                        <input type="hidden" name="kode_surat" class="form-control" />
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Kode Klasifikasi</label>
                                            <select name="klasifikasi" id="klasifikasi" class="form-select form-select-solid" data-placeholder="Select an option" data-hide-search="true">
                                                <option disabled selected value="0">Pilih kategori klasifikasi</option>
                                                @foreach($klasifikasi as $row)
                                                    <option value="{{$row->id_klasifikasi}}">{{$row->kode_klasifikasi}} - {{$row->deskripsi_klasifikasi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Kode Fungsi</label>
                                            <select name="fungsi" id="fungsi" class="form-select form-select-solid my_list" data-placeholder="Select an option" data-hide-search="true" disabled>
                                                <option disabled selected value="0">Pilih kategori fungsi</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Kode Kegiatan</label>
                                            <select name="kegiatan" id="kegiatan" class="form-select form-select-solid my_list" data-placeholder="Select an option" data-hide-search="true" disabled>
                                                <option disabled selected value="0">Pilih kategory kegiatan</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7" id="row-transaksi">
                                            <label class="required fw-semibold fs-6 mb-2">Kode Transaksi</label>
                                            <select name="transaksi" id="transaksi" class="form-select form-select-solid my_list" data-placeholder="Select an option" data-hide-search="true" disabled>
                                                <option disabled selected value="0">Pilih kategori transaksi</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Nomenklatur jabatan</label>
                                            <select name="nomenklatur_jabatan" id="nomenklatur_jabatan" class="form-select form-select-solid my_list" data-placeholder="Select an option" data-hide-search="true" disabled>
                                                <option disabled selected value="0">Pilih Nomenklatur Jabatan</option>
                                                @foreach($nomenklatur_jabatan as $row)
                                                <option value="{{$row->id}}">{{$row->nomenklatur}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                       
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-5">Penerima</label>
                                            <div class="d-flex fv-row">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <!--begin::Input-->
                                                    <input class="form-check-input me-3" name="penerima_surat" type="radio" value="1" id="kt_modal_update_role_option_0" />
                                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                        <div class="fw-bold text-gray-800">Internal</div>
                                                    </label>
                                                    
                                                    <input class="form-check-input me-3" name="penerima_surat" type="radio" value="2" id="kt_modal_update_role_option_1" style="margin-left:20px"/>
                                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                        <div class="fw-bold text-gray-800">External</div>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                            <!--end::Input row-->
                                        </div>
                                        <div id="display-tujuan-internal">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">Tujuan</label>
                                                <select name="tujuan[]" id="tujuan" class="form-select form-select form-select-solid my_input" data-control="select2" data-close-on-select="true" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" required disabled>
                                                    <option>Pilih tujuan surat</option>
                                                    @foreach($user as $row)
                                                        <option value="{{$row->id_user}}">{{$row->nama_pegawai}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div id="display-tujuan-external">
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">Tujuan</label>
                                                <input type="text" name="tujuan-external" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tujuan surat" />
                                            </div>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Perihal / Isi ringkas</label>
                                            <textarea class="form-control form-control-solid my_input" placeholder="Perihal surat" id="perihal" name="perihal" rows="3" required disabled></textarea>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0 my_input" placeholder="Tanggal surat" required disabled/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2" id="file">File</label>
                                            <input class="form-control form-control-solid mb-3 mb-lg-0 my_input" name="file_surat" type="file" id="file_surat" required disabled>
                                        </div>
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary save_surat_keluar" id="save_surat" data-kt-indicator="on">
                                            <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            Save
                                        </button>
                                        <button type="submit" class="btn btn-primary update_surat_keluar" id="update_surat" data-kt-indicator="off">
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
                <!--end::Modal - Add task-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_keluar">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nomor Surat</th>
                        <th>Kategori klasifikasi</th>
                        <th>Perihal/Isi ringkas</th>
                        <th>Tujuan / Penerima</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th>Lampiran</th>
                        <th class="text-end min-w-125px"></th>
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
<div class="modal fade" id="modal_preview" tabindex="-1" aria-hidden="true">
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

@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    document.getElementById("display-tujuan-internal").style.display = "none";
    document.getElementById("display-tujuan-external").style.display = "none";

    var date = document.getElementById("tgl_surat");
    flatpickr(date, {
        dateFormat: "Y-m-d",
        
    });

    var fp = date._flatpickr;

    var id_role = `{{$data['id_role']}}`;

    let tb_surat_keluar = $("#tb_surat_keluar").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_keluar.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
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
                    if(full["internal"] == 2){
                        var a = `<span class="badge badge-light-danger">External</span>`;
                    }else if(full["internal"] == 1){
                        var a = `<span class="badge badge-light-primary">Internal</span>`;
                    }else{
                        var a = ``;
                    }

                    return`<div class="d-flex flex-column">
                        <div style='white-space: nowrap' class="text-gray-800 mb-1">${data}</div>
                        </div>${a}`;
                }
            },
            {data:"deskripsi"},
            {data:"perihal"},
            {data:"jumlah_tembusan", 
                mRender:function(data, type, full){
                    if(data>0){
                        var show = `<a href="javascript:void(0)" id="daftar_tujuan" id="tujuan" data-id_surat='${full['id_surat']}'><span class="badge badge-info">${data} orang</span></a>`;
                        return show;
                    }else{
                        return full['tujuan'];
                    }
                    
                }
            },
            {data:"tgl_surat"},
            {data:"file",
                mRender:function(data){
                    //return`<a href="{{asset('/public/uploads/surat_keluar/${data}')}}" target="_blank" >File</a>`;
                    return`<a href='javascript:void(0)' id="lampiran" data-url="{{asset('/public/uploads/surat_keluar/${data}')}}"><span class="badge badge-light-secondary">Berkas</span></a>`;
                }
            },
            {data:"id_surat", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                            <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn" id="edit_surat_keluar" data-id_surat_keluar='${data}' data-kode_surat='${full['kode_surat']}'>Edit</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn text-danger" id="delete_surat_keluar" data-id_surat_keluar='${data}'>Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    $("body").on("click","#daftar_tujuan",function(){
        var id_surat = $(this).data("id_surat");
        $("#kt_modal_tujuan").modal("show");
        $("#tb_tembusan").DataTable({
            ajax        : {
                url:`{{url('transaksi/surat_keluar/${id_surat}/detail')}}`,
                dataSrc:""
            },
            "bDestroy": true,
            searching   : false, paging: true, info: false,
            pageLength  :5,
            lengthMenu  : [[5, 10, 20], [5, 10, 20]],
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

    $("body").on("click", "#lampiran", function(){
        $("#modal_preview").modal("show");
        document.getElementById("preview").src = $(this).data("url")
    });

    $(("body")).on("click","#tujuan", function(){
        let id_surat = $(this).data("id_surat");
        $.ajax({
            url:`{{url('transaksi/surat_keluar/${id_surat}/detail')}}`,
            type:"GET",
            success:function(data){
                console.log(data);
                $("#modal_tujuan").modal("show");
            }
        });
    });

    $("body").on("click","#delete_surat_keluar", function(){
        console.log($(this).data("id_surat_keluar"));

        let id_surat = $(this).data("id_surat_keluar");
        if(confirm("Anda yakin ingin menghapus data ini?")){
        loadingPage(true);
        $.ajax({
                url:`{{url('transaksi/surat_keluar/${id_surat}/delete')}}`,
                type:"GET",
                success:function(data){
                    $("#tb_surat_keluar").DataTable().ajax.reload(null, false);
                }
            });
        }
    });

    function enabledAll(){
        document.querySelectorAll(".my_input").forEach(element=>{
            element.removeAttribute("disabled");
            
        });
    }

    function disabledAll(){
        $("#tujuan").val([]).trigger("change");
        $("input[name='penerima_surat']").prop('checked',false);
        document.querySelectorAll(".my_input").forEach(element=>{
            element.value = "";
            element.setAttribute("disabled", "disabled");
        });        
    }

    function enabledList(){
        document.querySelectorAll(".my_list").forEach(element=>{
            element.removeAttribute("disabled");
            element.value = "0";
        });
    }

    function disabledList(){
        document.querySelectorAll(".my_list").forEach(element=>{
            element.setAttribute("disabled", "disabled")
            element.value = "0";
        });
    }

    $("body").on("change", "input[name='penerima_surat']", function(){
        console.log($(this).val())
        var penerima = $(this).val();
        //penerima eksternal
        $("#tujuan").val([]).trigger("change");
        $("input[name='tujuan-external']").val("");
        if(penerima == 2){
            console.log("external")
            document.getElementById("display-tujuan-internal").style.display = "none";
            document.getElementById("display-tujuan-external").style.display = "inline-block";
        }else{
            console.log("internal")
            document.getElementById("display-tujuan-internal").style.display = "inline-block";
            document.getElementById("display-tujuan-external").style.display = "none";
        }

    });

    $("#klasifikasi").change(function(){
        let id_ref_klasifikasi = $(this).val();
        console.log(id_ref_klasifikasi);
        $.ajax({
            url:`{{url('referensi/${id_ref_klasifikasi}/get_fungsi_list')}}`,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                
                if(data.length>0){
                    //me-reset daftar kategori sebelumnya
                    console.log("data: ",data.length)
                    document.getElementById("fungsi").removeAttribute("disabled");
                    $("#fungsi").find("option").remove();
                    document.getElementById("kegiatan").setAttribute("disabled", "disabled");
                    $("#kegiatan").val(0);
                    document.getElementById("transaksi").setAttribute("disabled", "disabled");
                    $("#transaksi").val(0);
                    document.getElementById("row-transaksi").style.display = 'inline-block';
                    document.getElementById("nomenklatur_jabatan").setAttribute("disabled", "disabled");
                    $("#nomenklatur_jabatan").val(0);

                    document.getElementById("fungsi").innerHTML = `<option disabled selected value='0'>Pilih kategori fungsi</option>`;
                    for(var i=0; i<data.length; i++){                    
                        document.getElementById("fungsi").innerHTML += `<option class='fungsi-list' value='${data[i].id_fungsi}' data-kode_fungsi='${data[i].kode_fungsi}'>${data[i].kode_fungsi} - ${data[i].deskripsi_fungsi}</option>`; 
                    }
                    return false;
                }
                alert("Maaf, data tidak ditemukan. Periksa kembali klasifikasi surat anda atau pilih Kode klasifikasi yang lain")
                console.log("data: 0")
                document.getElementById("fungsi").setAttribute("disabled", "disabled");
                $("#fungsi").val(0);
                document.getElementById("kegiatan").setAttribute("disabled", "disabled");
                $("#kegiatan").val(0);
                document.getElementById("transaksi").setAttribute("disabled", "disabled");
                $("#transaksi").val(0);
                document.getElementById("nomenklatur_jabatan").setAttribute("disabled", "disabled");
                $("#nomenklatur_jabatan").val(0);
                document.getElementById("row-transaksi").style.display = 'inline-block';

                disabledAll();

            }
        });
    });


    $("#fungsi").change(function(){
        let id_ref_fungsi = $(this).val();
        let kode_fungsi = $(this).find(':selected').data('kode_fungsi');
        $("input[name='kode_surat']").val(kode_fungsi);
       
        $.ajax({
            url:`{{url('referensi/${id_ref_fungsi}/get_kegiatan_list')}}`,
            type:"GET",
            success:function(data){
               
                if(data.length > 0){
                    console.log("data: ",data.length)
                    document.getElementById("kegiatan").removeAttribute("disabled");
                    $("#kegiatan").find("option").remove();
                    document.getElementById("transaksi").setAttribute("disabled", "disabled");
                    $("#transaksi").val(0);
                    document.getElementById("row-transaksi").style.display = 'inline-block';
                    document.getElementById("nomenklatur_jabatan").setAttribute("disabled", "disabled");
                    $("#nomenklatur_jabatan").val(0);
                   
                    document.getElementById("kegiatan").innerHTML = `<option disabled selected value='0'>Pilih kategori kegiatan</option>`;
                    for(var i=0; i<data.length; i++){                    
                        document.getElementById("kegiatan").innerHTML += `<option class='kegiatan-list' value='${data[i].id_kegiatan}' data-kode_kegiatan='${data[i].kode_kegiatan}'>${data[i].kode_kegiatan} - ${data[i].deskripsi_kegiatan}</option>`; 
                    }
                    return false;
                }
                alert("Maaf, data tidak ditemukan. Periksa kembali klasifikasi surat anda atau pilih Kode fungsi yang lain")
                console.log("data: 0")  
                document.getElementById("kegiatan").setAttribute("disabled", "disabled");
                $("#kegiatan").val(0);
                document.getElementById("transaksi").setAttribute("disabled", "disabled");
                $("#transaksi").val(0);
                document.getElementById("nomenklatur_jabatan").setAttribute("disabled", "disabled");
                $("#nomenklatur_jabatan").val(0);
                document.getElementById("row-transaksi").style.display = 'inline-block';
                
            }
        });
    });

    $("#kegiatan").change(function(){
        let id_ref_kegiatan = $(this).val();
        let kode_kegiatan = $(this).find(':selected').data('kode_kegiatan');
        $("input[name='kode_surat']").val(kode_kegiatan);
       
        $.ajax({
            url:`{{url('referensi/${id_ref_kegiatan}/get_transaksi_list')}}`,
            type:"GET",
            success:function(data){

                if(data.length >0){  
                    console.log("data: ",data.length)
                    document.getElementById("transaksi").removeAttribute("disabled");
                    $("#transaksi").val(0);
                    document.getElementById("row-transaksi").style.display = 'inline-block';
                    document.getElementById("nomenklatur_jabatan").setAttribute("disabled", "disabled");
                    $("#nomenklatur_jabatan").val(0);
                    document.getElementById("transaksi").innerHTML = `<option disabled selected value='0'>Pilih kategori transaksi</option>`;
                    for(var i=0; i<data.length; i++){                    
                        document.getElementById("transaksi").innerHTML += `<option class='transaksi-list' value='${data[i].id_transaksi}' data-kode_transaksi='${data[i].kode_transaksi}'>${data[i].kode_transaksi} - ${data[i].deskripsi_transaksi}</option>`; 
                    }
                    return false;
                }
                
                document.getElementById("transaksi").setAttribute("disabled", "disabled");
                $("#transaksi").val(0);

                document.getElementById("row-transaksi").style.display = 'none';
                document.getElementById("nomenklatur_jabatan").removeAttribute("disabled");
                $("#nomenklatur_jabatan").val(0);
            }
        });
    });

    $("#transaksi").change(function(){
        let kode_transaksi = $(this).find(':selected').data('kode_transaksi');
        $("input[name='kode_surat']").val(kode_transaksi);
        $("#nomenklatur_jabatan").val(0);
        document.getElementById("nomenklatur_jabatan").removeAttribute("disabled");
    });

    $("#nomenklatur_jabatan").change(function(){
        enabledAll();
        let id_nomenklatur = $(this).val();
    });

    $("body").on("click","#add_surat_keluar", function(){
        
        disabledAll();
        disabledList();
        document.querySelector("#kt_modal_update_role_option_0").removeAttribute("disabled");
        document.querySelector("#kt_modal_update_role_option_1").removeAttribute("disabled");
        document.getElementById("display-tujuan-internal").style.display = "none";
        document.getElementById("display-tujuan-external").style.display = "none";
        document.querySelector(".save_surat_keluar").setAttribute("data-kt-indicator", "off");
        document.querySelector(".save_surat_keluar").removeAttribute("disabled");
        document.getElementById("update_surat").style.display = "none";
        document.getElementById("save_surat").style.display = "inline-block";
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add Surat Keluar</h2>`;
        document.getElementById("klasifikasi").value = 0;
        document.getElementById("notification").innerHTML ='';
        document.getElementById("file").classList.add("required");
        document.getElementById("file_surat").setAttribute("required", "required");
        let today = new Date();
        fp.setDate(today, true, "Y-m-d");
        
        $("#kt_modal_add_surat_keluar").modal("show");
    });

    $("#save_surat").click(function(e){
        var btn = document.querySelector(".save_surat_keluar");
        btn.setAttribute("data-kt-indicator", "on");
        btn.setAttribute("disabled","disabled");
        
        var formData = new FormData(document.getElementById("kt_modal_add_surat_keluar_form"));        
            $.ajax({
                url:`{{route('transaksi.surat_keluar.save')}}`,
                type:"POST",
                dataType:"JSON",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    console.log(data)
                    if (!data.success) {
                        let err_nomenklatur_jabatan = data.errors.nomenklatur_jabatan ? `<li>${data.errors.nomenklatur_jabatan}</li>` : ``;
                        let err_tujuan = data.errors.tujuan  ? `<li>${data.errors.tujuan}</li>` : ``;
                        let err_penerima_surat = data.errors.penerima_surat  ? `<li>${data.errors.penerima_surat}</li>` : ``;
                        let err_perihal = data.errors.perihal  ? `<li>${data.errors.perihal}</li>` : ``;
                        let err_tgl_surat = data.errors.tgl_surat  ? `<li>${data.errors.tgl_surat}</li>` : ``;
                        let err_file_surat = data.errors.file_surat  ? `<li>${data.errors.file_surat}</li>` : ``;

                        document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_nomenklatur_jabatan+err_penerima_surat+err_tujuan+err_perihal+err_tgl_surat+err_file_surat+"</div></div>";      
                        btn.setAttribute("data-kt-indicator", "off");
                        btn.removeAttribute("disabled");

                        return false;
                    } 
                        loadingPage(true);
                        $("#tb_surat_keluar").DataTable().ajax.reload(null, false);
                        $("#kt_modal_add_surat_keluar").modal("hide");
                },error: function () {
                    if(confirm("Error: Terjadi kesalahan. Klik OK untuk memuat ulang halaman.")){
                        location.reload();
                    }
                }
            });
    });

    $("body").on("click", "#edit_surat_keluar", function(){
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Edit Surat Keluar</h2>`;
        document.getElementById("update_surat").style.display = "inline-block";
        document.querySelector(".update_surat_keluar").setAttribute("data-kt-indicator", "off");
        document.querySelector(".update_surat_keluar").removeAttribute("disabled");
        
        document.getElementById("save_surat").style.display = "none";
        document.getElementById("file").classList.remove("required");
        document.getElementById("file_surat").removeAttribute("required");
        document.getElementById("notification").innerHTML ='';
        document.getElementById("row-transaksi").style.display = 'inline-block';
        let id_surat = $(this).data("id_surat_keluar");
        $("input[name='id_surat_keluar']").val(id_surat);
        $("input[name='kode_surat']").val($(this).data("kode_surat"));
        
        $("#file_surat").val("");
        loadingPage(true);
        $.ajax({
            url:`{{url('/transaksi/surat_keluar/${id_surat}/edit')}}`,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                enabledAll();
                disabledList();

                $("#klasifikasi").val(data.id_klasifikasi);
                if(data.ref_fungsi.length>0){
                    document.getElementById("fungsi").removeAttribute("disabled");
                    document.getElementById("fungsi").innerHTML = `<option disabled value="0">Pilih fungsi</option>`;
                    for(var i=0; i<data.ref_fungsi.length; i++){
                        let selected = data.ref_fungsi[i].id_fungsi == data.id_fungsi ? 'selected' : '';                    
                        document.getElementById("fungsi").innerHTML += `<option ${selected} value='${data.ref_fungsi[i].id_fungsi}' data-kode_fungsi='${data.ref_fungsi[i].kode_fungsi}'>${data.ref_fungsi[i].kode_fungsi} - ${data.ref_fungsi[i].deskripsi_fungsi}</option>`; 
                    }
                    
                }
                
                if(data.ref_kegiatan.length>0){
                    document.getElementById("kegiatan").removeAttribute("disabled");
                    document.getElementById("kegiatan").innerHTML = `<option disabled value="0">Pilih kegiatan</option>`;
                    for(var i=0; i<data.ref_kegiatan.length; i++){
                        let selected = data.ref_kegiatan[i].id_kegiatan == data.id_kegiatan ? 'selected' : '';                    
                        document.getElementById("kegiatan").innerHTML += `<option ${selected} value='${data.ref_kegiatan[i].id_kegiatan}' data-kode_fungsi='${data.ref_kegiatan[i].kode_kegiatan}'>${data.ref_kegiatan[i].kode_kegiatan} - ${data.ref_kegiatan[i].deskripsi_kegiatan}</option>`; 
                    }
                    
                }

                if(data.ref_transaksi.length>0){
                    console.log("Transaksi length "+data.ref_transaksi.length)
                    document.getElementById("row-transaksi").style.display = 'inline-block';
                    document.getElementById("transaksi").removeAttribute("disabled");
                    document.getElementById("transaksi").innerHTML = `<option disabled value="0">Pilih transaksi</option>`;
                    for(var i=0; i<data.ref_transaksi.length; i++){
                        let selected = data.ref_transaksi[i].id_transaksi == data.id_transaksi ? 'selected' : '';                    
                        document.getElementById("transaksi").innerHTML += `<option ${selected} value='${data.ref_transaksi[i].id_transaksi}' data-kode_transaksi='${data.ref_transaksi[i].kode_transaksi}'>${data.ref_transaksi[i].kode_transaksi} - ${data.ref_transaksi[i].deskripsi_transaksi}</option>`;
                    }
                    
                }else{
                    document.getElementById("row-transaksi").style.display = 'none';
                }

                document.add_surat_keluar_form.penerima_surat.value=data.surat_keluar.internal;
                
                if(data.surat_keluar.internal == 1){
                    
                    document.querySelector("#kt_modal_update_role_option_1").disabled=true;
                    document.querySelector("#kt_modal_update_role_option_0").removeAttribute("disabled");
                    document.querySelector("#kt_modal_update_role_option_0").checked;

                    let tujuan_surat = data.tujuan_surat.map(function (obj) {
                        return obj.id_penerima;
                    });

                    document.getElementById("display-tujuan-internal").style.display = "inline-block";
                    document.getElementById("display-tujuan-external").style.display = "none";
                    $("#tujuan").val(tujuan_surat).trigger("change");
                    
                }else{
                    document.querySelector("#kt_modal_update_role_option_1").removeAttribute("disabled");
                    document.querySelector("#kt_modal_update_role_option_1").checked;
                    document.querySelector("#kt_modal_update_role_option_0").disabled=true; 

                    document.getElementById("display-tujuan-internal").style.display = "none";
                    document.getElementById("display-tujuan-external").style.display = "inline-block";
                    $("input[name='tujuan-external']").val(data.surat_keluar.tujuan);
                    
                }

                document.getElementById("nomenklatur_jabatan").removeAttribute("disabled");
                $("#nomenklatur_jabatan").val(data.id_nomenklatur);
                $("input[name='nomor_surat']").val(data.surat_keluar.no_surat);
                
                $("#perihal").val(data.surat_keluar.perihal);
                fp.setDate(data.surat_keluar.tgl_surat, true, "Y-m-d");

                loadingPage(false);
                $("#kt_modal_add_surat_keluar").modal("show");
            }
        });
    });

    $("#update_surat").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_surat_keluar_form"));   
        let id_surat = $("input[name='id_surat_keluar']").val();
        var btn = document.querySelector(".update_surat_keluar");
        btn.setAttribute("data-kt-indicator", "on");
        btn.setAttribute("disabled","disabled");    

        $.ajax({
            url:`{{url('/transaksi/surat_keluar/${id_surat}/update')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"JSON",
            success:function(data){
                
                    console.log(data);
                    if (!data.success) {
                        let err_nomenklatur_jabatan = data.errors.nomenklatur_jabatan ? `<li>${data.errors.nomenklatur_jabatan}</li>` : ``;
                        let err_tujuan = data.errors.tujuan  ? `<li>${data.errors.tujuan}</li>` : ``;
                        
                        let err_perihal = data.errors.perihal  ? `<li>${data.errors.perihal}</li>` : ``;
                        let err_tgl_surat = data.errors.tgl_surat  ? `<li>${data.errors.tgl_surat}</li>` : ``;
                        let err_file_surat = data.errors.file_surat  ? `<li>${data.errors.file_surat}</li>` : ``;

                        document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_nomenklatur_jabatan+err_tujuan+err_perihal+err_tgl_surat+err_file_surat+"</div></div>";      
                        btn.setAttribute("data-kt-indicator", "off");
                        btn.removeAttribute("disabled");
                        $("#file_surat").val("");
                        
                        return false;
                    } 
                        loadingPage(true);
                        $("#tb_surat_keluar").DataTable().ajax.reload(null, false);
                        $("#kt_modal_add_surat_keluar").modal("hide");
            },error:function(){
                if(confirm("Error: Terjadi kesalahan. Klik OK untuk memuat ulang halaman.")){
                    location.reload();
                }
            }
        });
    });

    function loadingPage(active){
        document.body.style.overflow = 'hidden';
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
