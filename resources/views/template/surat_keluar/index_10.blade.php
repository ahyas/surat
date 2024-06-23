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
                <p>Template Surat Keluar</p>
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
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Nomor surat keluar</label>
                                            <select name="nomor_surat_keluar" id="nomor_surat_keluar" class="form-select form-select-solid my_list" data-placeholder="Select an option" data-hide-search="true" >
                                                <option selected value="">Pilih nomor surat keluar</option>
                                                @foreach($draft_surat_keluar as $row)
                                                    <option value="{{$row->id}}">{{$row->no_surat}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="fv-row mb-7" id="display-perihal">
                                            <label class="required fw-semibold fs-6 mb-2">Perihal / Tentang</label>
                                            <textarea class="form-control form-control-solid my_input" placeholder="Perihal surat" id="perihal" name="perihal" rows="3" required></textarea>
                                        </div>

                                        <div class="fv-row mb-7" id="display-tgl_surat">
                                            <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0 my_input" placeholder="Tanggal surat" required/>
                                        </div>

                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Template</label>
                                            <select name="template_surat_keluar" id="template_surat_keluar" class="form-select form-select-solid my_list" data-placeholder="Select an option" data-hide-search="true">
                                                <option selected value="0">Pilih template surat keluar</option>
                                                @foreach($template_surat_keluar as $row)
                                                    <option value="{{$row->id}}">{{$row->keterangan}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-sm save_surat_keluar" id="save_surat" data-kt-indicator="on">
                                            <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            Save
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm update_surat_keluar" id="update_surat" data-kt-indicator="off">
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
            <!--end::Card header-->
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
                        <span>Sebelum membuat template surat keluar, pastikan Anda sudah membuat nomor surat terlebih dahulu.</span>
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
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_keluar">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nomor Surat</th>
                        <th class="min-w-150px">Jenis dokumen</th>
                        <th>Perihal/Isi ringkas</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th>File</th>
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

    var date = document.getElementById("tgl_surat");
    flatpickr(date, {
        dateFormat: "Y-m-d",
        
    });

    var fp = date._flatpickr;

    var id_role = `{{$data['id_role']}}`;

    let tb_surat_keluar = $("#tb_surat_keluar").DataTable({
        ajax        : {
            url:"{{route('template.surat_keluar.get_data')}}",
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
                mRender:function(data){

                    return`<div class="d-flex flex-column">
                        <div style='white-space: nowrap' class="text-gray-800 mb-1">${data}</div>
                        </div>`;
                }
            },
            {data:"jenis_template"},
            {data:"perihal"},
            {data:"tgl_surat"},
            {data:"file", 
                mRender:function(data){
                    return`<a href="{{URL::asset('storage/${data}')}}"><span class="badge badge-info">file</span></a>`;
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

    $("body").on("change","#nomor_surat_keluar", function(){
        console.log($(this).val());
        var id_surat = $(this).val();
        $("input[name='id_surat_keluar']").val(id_surat);
        $.ajax({
            type:"GET",
            url:`{{url('template/surat_keluar/${id_surat}/detail')}}`,
            success:function(data){
                console.log(data)
                document.getElementById("perihal").removeAttribute("disabled");
                document.getElementById("tgl_surat").removeAttribute("disabled");
                document.getElementById("template_surat_keluar").removeAttribute("disabled");
                $("#perihal").val(data.detail.perihal);
                fp.setDate(data.detail.tgl_surat, true, "Y-m-d");
            }
        });
    });

    $("body").on("click","#delete_surat_keluar", function(){
        console.log($(this).data("id_surat_keluar"));

        let id_surat = $(this).data("id_surat_keluar");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            loadingPage(true);
            $.ajax({
                url:`{{url('template/surat_keluar/${id_surat}/delete')}}`,
                type:"GET",
                success:function(data){
                    location.reload();
                }
            });
        }
    });

    $("body").on("click","#add_surat_keluar", function(){
        $.ajax({
            url:"{{route('template.surat_keluar.count')}}",
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data)
                if(data>0){
                    document.querySelector(".save_surat_keluar").setAttribute("data-kt-indicator", "off");
                    document.querySelector(".save_surat_keluar").removeAttribute("disabled");
                    document.getElementById("update_surat").style.display = "none";
                    document.getElementById("save_surat").style.display = "inline-block";
                    document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add Template Surat Keluar</h2>`;
                    document.getElementById("notification").innerHTML ='';

                    document.getElementById("perihal").setAttribute("disabled", "disabled");
                    document.getElementById("tgl_surat").setAttribute("disabled", "disabled");
                    document.getElementById("template_surat_keluar").setAttribute("disabled", "disabled");
                    $("#kt_modal_add_surat_keluar").modal("show");
                }else{
                    alert("Error: Tidak ada nomor surat baru");
                }
            }
        });
    });

    $("#save_surat").click(function(e){
        var btn = document.querySelector(".save_surat_keluar");
        btn.setAttribute("data-kt-indicator", "on");
        btn.setAttribute("disabled","disabled");
        var id_surat_keluar = $("input[name='id_surat_keluar']").val()
        console.log(id_surat_keluar)
        var formData = new FormData(document.getElementById("kt_modal_add_surat_keluar_form"));        
            $.ajax({
                url:`{{route('template.surat_keluar.save')}}`,
                type:"POST",
                dataType:"JSON",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if (!data.success) {
                        let err_perihal = data.errors.perihal  ? `<li>${data.errors.perihal}</li>` : ``;
                        let err_tgl_surat = data.errors.tgl_surat  ? `<li>${data.errors.tgl_surat}</li>` : ``;
                        let err_templpate = data.errors.template_surat_keluar ? `<li>${data.errors.template_surat_keluar}</li>` : ``;
                        let err_nomor_surat_keluar = data.errors.nomor_surat_keluar ? `<li>${data.errors.nomor_surat_keluar}</li>` : ``;

                        document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_nomor_surat_keluar+err_perihal+err_tgl_surat+err_templpate+"</div></div>";      
                        btn.setAttribute("data-kt-indicator", "off");
                        btn.removeAttribute("disabled");

                        return false;
                    }
                        loadingPage(true);
                        $("#tb_surat_keluar").DataTable().ajax.reload(null, false);
                        $("#kt_modal_add_surat_keluar").modal("hide");
                        window.location.href = `{{url('template/surat_keluar/${id_surat_keluar}/edit')}}`;
                },error: function () {
                    if(confirm("Error: Terjadi kesalahan. Klik OK untuk memuat ulang halaman.")){
                        location.reload();
                    }
                }
            });
    });

    $("body").on("click", "#edit_surat_keluar", function(){
        var id_surat = $(this).data("id_surat_keluar");
        console.log(id_surat)
        window.location.href = `{{url('/template/surat_keluar/${id_surat}/edit')}}`;
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
