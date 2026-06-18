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
                <p>Level user</p>
            </div>
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    
                    <button type="button" class="btn btn-primary btn-sm" id="add_user">
                    <i class="ki-duotone ki-plus fs-2"></i>Add User</button>
                    <!--end::Add user-->
                </div>
                <div class="modal fade" id="kt_modal_add_user" aria-hidden="true">
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
                                <form id="kt_modal_add_user_form" name="add_user_form" class="form" action="#">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        
                                        <div id="notification"></div>
                                        
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Parent user</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="parent_user" id="parent_user" class="form-select" data-placeholder="Ketik nama parent user">
                                                <option></option>
                                                @foreach($user as $row)
                                                <option value="{{$row->id}}">{{$row->nama_pegawai}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>

                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Sub user</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="sub_user" id="sub_user" class="form-select" data-placeholder="Ketik nama sub user">
                                                <option></option>
                                                @foreach($user as $row)
                                                <option value="{{$row->id}}">{{$row->nama_pegawai}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_level_user">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">Parent user</th>
                        <th class="min-w-125px">Sub user</th>
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

<div class="modal fade" id="kt_modal_detail_level_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Detail Level User</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body px-8 py-7">
                <div class="table-responsive">
                    <table class="table table-row-bordered align-middle mb-0">
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-150px">Informasi</th>
                                <th class="min-w-250px">Parent User</th>
                                <th class="min-w-250px">Sub User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Nama</td>
                                <td id="detail_parent_name">-</td>
                                <td id="detail_sub_name">-</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Email</td>
                                <td id="detail_parent_email">-</td>
                                <td id="detail_sub_email">-</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Role</td>
                                <td id="detail_parent_role">-</td>
                                <td id="detail_sub_role">-</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Bidang</td>
                                <td id="detail_parent_bidang">-</td>
                                <td id="detail_sub_bidang">-</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Jabatan</td>
                                <td id="detail_parent_jabatan">-</td>
                                <td id="detail_sub_jabatan">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $("#tb_level_user").DataTable({
        ajax        : {
            url:"{{route('user.level.get_data')}}",
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
            {data:"parent_user"},
            {data:"sub_user"},
            {data:"id_sub_user", className: "text-end",
                mRender:function(data, type, full){
                    var id_parent_user = full["id_parent_user"];
                    return`<div class="dropdown">
                            <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 detail_user" data-id_parent_user='${id_parent_user}' data-id_sub_user='${data}'>Detail</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 edit_user" data-id_parent_user='${id_parent_user}' data-id_sub_user='${data}'>Edit</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3 text-danger delete_user" data-id_parent_user='${id_parent_user}' data-id_sub_user='${data}'>Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    var formMode = "create";
    var originalParentUser = null;
    var originalSubUser = null;

    $("#parent_user, #sub_user").select2({
        dropdownParent: $("#kt_modal_add_user"),
        width: "100%",
        allowClear: true,
        minimumResultsForSearch: 0
    });


    $("body").on("click","#add_user", function(){
        formMode = "create";
        originalParentUser = null;
        originalSubUser = null;
        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Add Level</h2>`;
        document.getElementById("notification").innerHTML ='';

        $("#kt_modal_add_user_form").trigger("reset");
        $("#parent_user").val("").trigger('change');
        $("#sub_user").val("").trigger('change');
        $("#kt_modal_add_user").modal("show");
    });

    $("body").on("click", ".detail_user", function(){
        var idParentUser = $(this).data("id_parent_user");
        var idSubUser = $(this).data("id_sub_user");

        loadingPage(true);
        $.ajax({
            type: "GET",
            url: `{{url('/user/level')}}/${idParentUser}/${idSubUser}/detail`,
            dataType: "JSON",
            success: function(data){
                $("#detail_parent_name").text(data.parent_name || "-");
                $("#detail_parent_email").text(data.parent_email || "-");
                $("#detail_parent_role").text(data.parent_role || "-");
                $("#detail_parent_bidang").text(data.parent_bidang || "-");
                $("#detail_parent_jabatan").text(data.parent_jabatan || "-");
                $("#detail_sub_name").text(data.sub_name || "-");
                $("#detail_sub_email").text(data.sub_email || "-");
                $("#detail_sub_role").text(data.sub_role || "-");
                $("#detail_sub_bidang").text(data.sub_bidang || "-");
                $("#detail_sub_jabatan").text(data.sub_jabatan || "-");
                $("#kt_modal_detail_level_user").modal("show");
                loadingPage(false);
            },
            error: function(){
                loadingPage(false);
                alert("Data level user tidak ditemukan.");
            }
        });
    });

    $("body").on("click", ".edit_user", function(){
        formMode = "edit";
        originalParentUser = $(this).data("id_parent_user");
        originalSubUser = $(this).data("id_sub_user");

        document.getElementById("title").innerHTML = `<h2 class="fw-bold">Edit Level</h2>`;
        document.getElementById("notification").innerHTML = '';

        loadingPage(true);
        $.ajax({
            type: "GET",
            url: `{{url('/user/level')}}/${originalParentUser}/${originalSubUser}/edit`,
            dataType: "JSON",
            success: function(data){
                $("#parent_user").val(data.id_parent_user).trigger("change");
                $("#sub_user").val(data.id_sub_user).trigger("change");
                $("#kt_modal_add_user").modal("show");
                loadingPage(false);
            },
            error: function(){
                loadingPage(false);
                alert("Data level user tidak ditemukan.");
            }
        });
    });

    $("#save_user").click(function(e){
        e.preventDefault();
        setButtonSpinner(".save_user", "on");

        var submitUrl = formMode === "edit"
            ? `{{url('/user/level')}}/${originalParentUser}/${originalSubUser}/update`
            : "{{route('user.level.save')}}";

        $.ajax({
            type    : "POST",
            url     : submitUrl,
            data    : $("#kt_modal_add_user_form").serialize(),
            dataType: "JSON",
            success :function(data){

                if (!data.success) {
                    let errors = data.message || {};
                    let err_parent_user = errors.err_parent_user  ? `<li>${errors.err_parent_user}</li>` : ``;
                    let err_sub_user = errors.err_sub_user  ? `<li>${errors.err_sub_user}</li>` : ``;

                    document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_parent_user+err_sub_user+"</div></div>";
                    setButtonSpinner(".save_user", "off");

                }else{
                    setButtonSpinner(".save_user", "off");
                    $("#tb_level_user").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_user").modal("hide");
                    loadingPage(true)
                }   
            }
        });
    });

    $("body").on("click", ".delete_user", function(){
        console.log($(this).data("id_sub_user"));
        var id_sub_user = $(this).data("id_sub_user");
        var id_parent_user = $(this).data("id_parent_user");
        if(confirm("Anda yakin ingin menghapus data ini?")){
            loadingPage(true);
            $.ajax({
                type:"GET",
                url:`{{url('/user/${id_parent_user}/${id_sub_user}/delete')}}`,
                dataType:"JSON",
                success:function(data){
                    console.log("Success");
                    $("#tb_level_user").DataTable().ajax.reload(null, false);
                }
            });
        }
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
