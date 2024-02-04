@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="content flex-column-fluid" id="kt_content">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <p>Surat Masuk</p>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" id="add_surat_masuk">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Surat Masuk</button>
                    
                </div>

                <div class="modal fade" id="kt_modal_add_surat_masuk" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_surat_masuk_header">
                                <div id="title"></div>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                            
                                <form id="kt_modal_add_surat_masuk_form" name="add_surat_masuk_form" class="form" action="#" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <div id="notification"></div>

                                        <input type="hidden" name="id_surat_masuk" class="form-control" />
                                        <div class="fv-row mb-7" >
                                            <label class="required fw-semibold fs-6 mb-2">Nomor surat</label>
                                            <input type="text" name="nomor_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nomor surat" required/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Pengirim</label>
                                            <input type="text" name="pengirim" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pengirim surat" required/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Tujuan</label>
                                            <select name="tujuan" id="tujuan" class="form-select form-select form-select-solid my_input" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" required >
                                                <option value="">Pilih tujuan surat</option>
                                                @foreach($user as $row)
                                                    <option value="{{$row->id_parent_user}}">{{$row->nama_pegawai}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Perihal / Isi ringkas</label>
                                            <textarea class="form-control form-control-solid" placeholder="Perihal surat" id="perihal" name="perihal" rows="3" required></textarea>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tanggal surat" required/>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <div class="form-check">
                                                <input type="checkbox" name="rahasia" class="form-check-input" id="rahasia">
                                                <label class="fw-semibold fs-6 mb-2" for="rahasia">Rahasia</label>
                                            </div>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="fw-semibold fs-6 mb-2" id="file_surat">File</label>
                                            <input class="form-control form-control-solid mb-3 mb-lg-0" name="file_surat" type="file" id="file_surat" required>
                                        </div>
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary save_surat_masuk" id="save_surat_masuk" data-kt-indicator="off">
                                            <span class="indicator-progress"> 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            Save</button>
                                        <button type="submit" class="btn btn-primary update_surat_masuk" id="update_surat_masuk" data-kt-indicator="off">
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
                <!--end::Modal - Add task-->
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
                        <th class="min-w-125px">No. Surat</th>
                        <th class="min-w-125px">Pengirim</th>
                        <th >Perihal / Isi ringkas</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th>Lampiran</th>
                        <th>Status</th>
                        <th class="min-w-150px">Dibuat Oleh</th>
                        <th class="text-end min-w-100px"></th>
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
            {data:"file",
                mRender:function(data){
                    return`<a href='javascript:void(0)' id="lampiran" data-url="{{asset('/public/uploads/surat_masuk/${data}')}}"><span class="badge badge-secondary">Berkas</span></a>`;
                }
            },
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
            {data:"dibuat_oleh",
                mRender:function(data){
                    if(data !== null){
                        return`<span>${data}</span>`;
                    }else{
                        return`-`;
                    }
                }
            },
            {data:"id", className: "text-end",
                mRender:function(data, type, full){
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
                                        <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn ${btn}" id="edit_surat_masuk" data-id_surat_masuk='${data}'>Edit</a>
                                        </div>
                                    </li>
                                    <li>
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3 fs-7 btn text-danger ${btn}" id="delete_surat_masuk" data-id_surat_masuk='${data}'>Delete</a>
                                        </div>  
                                    </li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    $("body").on("click", "#lampiran", function(){
        $("#kt_modal_scrollable_2").modal("show");
        document.getElementById("preview").src = $(this).data("url")
    });

    $("body").on("click","#add_surat_masuk", function(){
        document.querySelector(".save_surat_masuk").setAttribute("data-kt-indicator", "off");
        document.querySelector(".save_surat_masuk").removeAttribute("disabled");
        $("#tujuan").val("").trigger("change");
        document.getElementById("update_surat_masuk").style.display = "none";
        document.getElementById("save_surat_masuk").style.display = "inline-block";
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add surat masuk</h2>`;
        $("#kt_modal_add_surat_masuk_form").trigger("reset");
        document.getElementById("notification").innerHTML ='';
        document.getElementById("file_surat").classList.add("required");
        let today = new Date();
        fp.setDate(today, true, "Y-m-d");
        $("#bidang").val("").trigger('change');
        $("#kt_modal_add_surat_masuk").modal("show");
    });

    $("#save_surat_masuk").click(function(e){
        e.preventDefault();
        var btn = document.querySelector(".save_surat_masuk");
        btn.setAttribute("data-kt-indicator", "on");
        btn.setAttribute("disabled","disabled");
        console.log(document.getElementById("rahasia").checked);
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
                    console.log(data)
                    if (!data.success) {
                        let err_nomor_surat = data.errors.nomor_surat  ? `<li>${data.errors.nomor_surat}</li>` : ``;
                        let err_pengirim = data.errors.pengirim  ? `<li>${data.errors.pengirim}</li>` : ``;
                        let err_tujuan = data.errors.tujuan  ? `<li>${data.errors.tujuan}</li>` : ``;
                        let err_perihal = data.errors.perihal  ? `<li>${data.errors.perihal}</li>` : ``;
                        let err_tgl_surat = data.errors.tgl_surat  ? `<li>${data.errors.tgl_surat}</li>` : ``;
                        let err_file_surat = data.errors.file_surat  ? `<li>${data.errors.file_surat}</li>` : ``;

                        document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_nomor_surat+err_pengirim+err_tujuan+err_perihal+err_tgl_surat+err_file_surat+"</div></div>";  
                        document.querySelector(".save_surat_masuk").setAttribute("data-kt-indicator", "off");
                        document.querySelector(".save_surat_masuk").removeAttribute("disabled");                       
                        return false;
                    } 
                        loadingPage(true);
                        $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                        $("#kt_modal_add_surat_masuk").modal("hide");
                }
            });
    });

    $("body").on("click", "#edit_surat_masuk", function(){
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Edit surat masuk</h2>`;
        document.getElementById("update_surat_masuk").style.display = "inline-block";
        document.querySelector(".update_surat_masuk").setAttribute("data-kt-indicator", "off");
        document.querySelector(".update_surat_masuk").removeAttribute("disabled");

        document.getElementById("save_surat_masuk").style.display = "none";
        document.getElementById("file_surat").className += "required";
        document.getElementById("notification").innerHTML ='';
        $("input[name='file_surat']").val("");
        let id_surat = $(this).data("id_surat_masuk");
        $("input[name='id_surat_masuk']").val(id_surat);
        loadingPage(true);
        $.ajax({
            url:`{{url('/transaksi/surat_masuk/${id_surat}/edit')}}`,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                
                $("input[name='nomor_surat']").val(data.table[0].no_surat);
                $("input[name='pengirim']").val(data.table[0].pengirim);
                $("#perihal").val(data.table[0].perihal);
                let id_penerima = data.tujuan_surat[0] ? data.tujuan_surat[0].id_penerima : "";
                $("#tujuan").val(id_penerima).trigger('change');
                fp.setDate(data.table[0].tgl_surat, true, "Y-m-d");
                document.getElementById("rahasia").checked = data.table[0].rahasia == 'true' ? true : false;
                loadingPage(false);
                $("#kt_modal_add_surat_masuk").modal("show");
            }
        });
    });

    $("#update_surat_masuk").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_surat_masuk_form"));   
        let id_surat = $("input[name='id_surat_masuk']").val();

        var btn = document.querySelector(".update_surat_masuk");
        btn.setAttribute("data-kt-indicator", "on");
        btn.setAttribute("disabled","disabled");
        
        $.ajax({
            url:`{{url('/transaksi/surat_masuk/${id_surat}/update')}}`,
            type:"POST",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"JSON",
            success:function(data){
                console.log(data);
                    if (!data.success) {
                        let err_nomor_surat = data.errors.nomor_surat  ? `<li>${data.errors.nomor_surat}</li>` : ``;
                        let err_pengirim = data.errors.pengirim  ? `<li>${data.errors.pengirim}</li>` : ``;
                        let err_tujuan = data.errors.tujuan  ? `<li>${data.errors.tujuan}</li>` : ``;
                        let err_perihal = data.errors.perihal  ? `<li>${data.errors.perihal}</li>` : ``;
                        let err_tgl_surat = data.errors.tgl_surat  ? `<li>${data.errors.tgl_surat}</li>` : ``;
                        let err_file_surat = data.errors.file_surat  ? `<li>${data.errors.file_surat}</li>` : ``;

                        document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_nomor_surat+err_pengirim+err_tujuan+err_perihal+err_tgl_surat+err_file_surat+"</div></div>"; 
                        document.querySelector(".update_surat_masuk").setAttribute("data-kt-indicator", "off");
                        document.querySelector(".update_surat_masuk").removeAttribute("disabled");                         
                        return false;
                    } 
                        
                        $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                        $("#kt_modal_add_surat_masuk").modal("hide");
                        loadingPage(true);
                
            }
        });
    });

    $("body").on("click", "#delete_surat_masuk", function(){
        let id_surat = $(this).data("id_surat_masuk");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            loadingPage(true);
            $.ajax({
                url:`{{url('/transaksi/surat_masuk/${id_surat}/delete')}}`,
                type:"GET",
                dataType:"JSON",
                success:function(data){
                    $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_surat_masuk").modal("hide");
                }
            });
        }
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
            KTApp.hidePageLoading();
            loadingEl.remove();
        }
    }

});
</script>
@endpush
