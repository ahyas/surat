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
                <p>Daftar user</p>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Filter-->
                    <!--begin::Add user-->

                    <button type="button" class="btn btn-primary btn-sm" id="add_user">
                    <i class="ki-duotone ki-plus fs-2"></i>Add User</button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
                <!--end::Modal - New Card-->
                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_user_header">
                                <!--begin::Modal title-->
                                <div id="title"></div>
                                <!--end::Modal title-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_user_form" name="add_user_form" class="form" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        
                                        <div id="notification"></div>

                                        <input type="hidden" name="id_user" class="form-control" />
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Nama lengkap</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fw-semibold fs-6 mb-2">NIP</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="nip" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="NIP" />
                                            <!--end::Input-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" disabled/>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Bidang</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="bidang" id="bidang" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-hide-search="true">
                                                <option></option>
                                                @foreach($table2 as $bidang)
                                                <option value="{{$bidang->id_bidang}}">{{$bidang->bidang}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>

                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Jabatan</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="jabatan" id="jabatan" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-hide-search="true">
                                                <option></option>
                                                @foreach($jabatan as $row)
                                                <option value="{{$row->id}}">{{$row->jabatan}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>

                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Status</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" id="status" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" data-hide-search="true">
                                                <option value="1" selected>Aktif</option>
                                                <option value="0">Non aktif</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>

                                        <div class="fv-row mb-7">
                                            <label class="fw-light fs-6 mb-2" id="file">Upload Photo</label>
                                            <input class="form-control form-control-solid mb-3 mb-lg-0 " name="photo_user" type="file" id="photo_user">
                                        </div>

                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary save_user" id="save_user" data-kt-indicator="off">
                                            <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            Save
                                        </button>
                                        <button type="submit" class="btn btn-primary update_user" id="update_user" data-kt-indicator="off">
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_user">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">User</th>
                        <th>NIP</th>
                        <th class="min-w-125px">Bidang</th>
                        <th>Jabatan</th>
                        <th>Status</th>
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
@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $("#tb_user").DataTable({
        ajax        : {
            url:"{{route('user.list.get_data')}}",
            dataSrc:""
        },
        responsive  : true,
        serverSide  : false,
        drawCallback:function(settings){
            loadingPage(false);
            document.body.style.overflow = 'visible';
        },
        ordering    :false,
        columns     :
        [
            {data:"nama", className:"d-flex align-items-center",
                mRender:function(data, type, full){
                    
                    if(full['photo_user'] != null){
                        var file = full['photo_user'];
                        var photo_user = `<div class="symbol symbol-30px symbol-md-40px">
                            <img src="{{asset('public/uploads/photo_user/${file}')}}" alt="image">
                        </div>
                        `;
                    }else{
                        var photo_user = `<div class="symbol symbol-30px symbol-md-40px">
                            <img src="{{asset('public/uploads/photo_user/avatar.png')}}" alt="image">
                        </div>
                        `;
                    }
                    return`<div class="d-flex flex-column">
                                ${photo_user}
                                <div class="text-gray-800 mb-1">${data}</div>
                                <span>${full['email']}</span>
                            </div>`;
                }
            },
            {data:"nip"},
            {data:"bidang",
                mRender:function(data, type, full){
                    if(full['id_bidang'] == 1){
                        var a = `<span class="badge badge-light-danger">${data}</span>`;
                    }

                    if(full['id_bidang'] == 2){
                        var a = `<span class="badge badge-light-primary">${data}</span>`; 
                    }

                    if(full['id_bidang'] == 3){
                        var a = `<span class="badge badge-light-success">${data}</span>`;
                    }

                    if(full['id_bidang'] == null){
                        var a = ``;
                    }

                    return a;
                }
            },
            {data:"jabatan"},
            {data:"status_user",
                mRender:function(data, type, full){
                    if(full["status"] == 1){
                        return`<span class="badge badge-light-primary">${data}</span>`
                    }else{
                        return`<span class="badge badge-light-danger">${data}</span>`
                    }
                }
            },
            {data:"id_user", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                            <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" aria-labelledby="dropdownMenuButton1 data-kt-menu="true">
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3" id="edit_user" data-id_user='${data}'>Edit</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 text-danger delete_user" data-id_user='${data}'>Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    $("body").on("click", "#edit_user", function(){
        var id_user = $(this).data("id_user");
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Edit user</h2>`;
        document.querySelector("input[name='email']").setAttribute("disabled","disabled");
        document.getElementById("update_user").style.display = "inline-block";
        document.getElementById("save_user").style.display = "none";
        document.getElementById("notification").innerHTML ='';
        $("#kt_modal_add_user_form").trigger("reset");
        loadingPage(true);
        $.ajax({
            type:"GET",
            url:`{{url('user/list/${id_user}/edit')}}`,
            dataType:"JSON",
            success:function(data){
                console.log(data);
                $("input[name='id_user']").val(id_user);
                $("input[name='nip']").val(data.nip);
                $("input[name='name']").val(data.nama);
                $("input[name='email']").val(data.email);
                $("#bidang").val(data.id_bidang).trigger('change');
                $("#jabatan").val(data.id_jabatan).trigger('change');
                $("#status").val(data.status).trigger('change');
                loadingPage(false);
                $("#kt_modal_add_user").modal("show");
            }
        });
    });

    $("#update_user").click(function(e){
        e.preventDefault();
        var id_user = $("input[name='id_user']").val();
        setButtonSpinner(".update_user", "on");
        var formData = new FormData(document.getElementById("kt_modal_add_user_form")); 
        $.ajax({
            type    : "POST",
            url     : `{{url('user/list/${id_user}/update')}}`,
            data    : formData,
            cache   : false,
            contentType: false,
            processData: false,
            dataType:"JSON",
            success :function(data){
                console.log(data);
                if (!data.success) {
                    let err_name = data.errors.name  ? `<li>${data.errors.name}</li>` : ``;
                    let err_bidang = data.errors.bidang  ? `<li>${data.errors.bidang}</li>` : ``;
                    let err_jabatan = data.errors.jabatan  ? `<li>${data.errors.jabatan}</li>` : ``;
                    let err_photo_user = data.errors.photo_user  ? `<li>${data.errors.photo_user}</li>` : ``;

                    document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_name+err_bidang+err_jabatan+err_photo_user+"</div></div>";      
                    setButtonSpinner(".update_user", "off");
                }else{
                    setButtonSpinner(".update_user", "off");
                    $("#tb_user").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_user").modal("hide");
                    loadingPage(true);
                }  
            }
        });
    });

    $("body").on("click","#add_user", function(){
        document.querySelector("input[name='email']").removeAttribute("disabled");
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add User</h2>`;
        document.getElementById("notification").innerHTML ='';
        document.getElementById("update_user").style.display = "none";
        document.getElementById("save_user").style.display = "inline-block";
        $("#kt_modal_add_user_form").trigger("reset");
        $("#bidang").val("").trigger('change');
        $("#jabatan").val("").trigger('change');
        $("#status").val(1).trigger('change');
        $("#kt_modal_add_user").modal("show");
    });

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

    $("#save_user").click(function(e){
        e.preventDefault();
        setButtonSpinner(".save_user", "on");
        var formData = new FormData(document.getElementById("kt_modal_add_user_form"));
        $.ajax({
            type    : "POST",
            url     : "{{route('user.list.save')}}",
            data    : $("#kt_modal_add_user_form").serialize(),
            dataType: "JSON",
            data    : formData,
            cache   : false,
            contentType: false,
            processData: false,
            success :function(data){
                if (!data.success) {
                    let err_name = data.errors.name  ? `<li>${data.errors.name}</li>` : ``;
                    let err_email = data.errors.email  ? `<li>${data.errors.email}</li>` : ``;
                    let err_bidang = data.errors.bidang  ? `<li>${data.errors.bidang}</li>` : ``;
                    let err_jabatan = data.errors.jabatan  ? `<li>${data.errors.jabatan}</li>` : ``;
                    let err_photo_user = data.errors.photo_user  ? `<li>${data.errors.photo_user}</li>` : ``;

                    document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_name+err_email+err_bidang+err_jabatan+err_photo_user+"</div></div>";      
                    setButtonSpinner(".save_user", "off");

                }else{
                    setButtonSpinner(".save_user", "off");
                    $("#tb_user").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_user").modal("hide");
                    loadingPage(true);
                }   
            }
        });
    });

    $("body").on("click", ".delete_user", function(){
        console.log($(this).data("id_user"));
        var id_user = $(this).data("id_user");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            loadingPage(true);
            $.ajax({
                type:"GET",
                url:`{{url('user/list/${id_user}/delete')}}`,
                dataType:"JSON",
                success:function(data){
                    console.log("Success");
                    $("#tb_user").DataTable().ajax.reload(null, false);
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
            document.body.style.overflow = 'scroll';
            KTApp.hidePageLoading();
            loadingEl.remove();
        }
    }
});
</script>
@endpush
