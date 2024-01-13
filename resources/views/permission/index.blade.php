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
                <p>User Permission</p>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
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
                                <h2 class="fw-bold">Edit Permission</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Close-->
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

                                        <input type="hidden" name="id_user" class="form-control" />
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Nama lengkap</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" readonly class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-5">Role</label>
                                            <!--end::Label-->
                                            <!--begin::Roles-->
                                            <!--begin::Input row-->
                                            @foreach($table as $role)
                                            <div class="d-flex fv-row">
                                                <!--begin::Radio-->
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <!--begin::Input-->
                                                    <input class="form-check-input me-3" name="user_role" type="radio" value="{{$role->id}}" id="kt_modal_update_role_option_0" />
                                                    <!--end::Input-->
                                                    <!--begin::Label-->
                                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                        <div class="fw-bold text-gray-800">{{$role->name}}</div>
                                                        <div class="text-gray-600">{{$role->keterangan}}</div>
                                                    </label>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Radio-->
                                            </div>
                                            <!--end::Input row-->
                                            <div class='separator separator-dashed my-5'></div>
                                            @endforeach
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="button" id="btn-cancel" class="btn btn-light-danger">Cancel</button>
                                        <button type="submit" class="btn btn-primary update_permission" id="update_permission" data-kt-indicator="off">
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
                        <th class="min-w-125px">Role</th>
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
            url:"{{route('user.permission.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        responsive  : true,
        columns     :
        [
            {data:"nama", className:"d-flex align-items-center",
                mRender:function(data, type, full){
                    return`<div class="d-flex flex-column">
                                <a href="javascript:void(0)" class="text-gray-800 text-hover-primary mb-1">${data}</a>
                                <span>${full['email']}</span>
                            </div>`;
                }
            },
            {data:"role"},
            {data:"id_user", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                            <button class="btn btn-light-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></button>
                                <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                                    <li>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="dropdown-item" id="edit_permission" data-id_user='${data}'>Edit</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    $("body").on("click", "#edit_permission", function(){
        var id_user = $(this).data("id_user");
        $("#kt_modal_add_user_form").trigger("reset");
        $.ajax({
            type:"GET",
            url:`{{url('user/permissions/${id_user}/edit')}}`,
            dataType:"JSON",
            success:function(data){
                console.log(data);
                $("input[name='id_user']").val(data.id_user);
                $("input[name='name']").val(data.nama);
                document.add_user_form.user_role.value=data.id_role;
                $("#kt_modal_add_user").modal("show");
            }
        });
    });

    $("#update_permission").click(function(e){
        e.preventDefault();
        var id_user = $("input[name='id_user']").val();
        setButtonSpinner(".update_permission","on");
        $.ajax({
            type    : "POST",
            url     : `{{url('user/permissions/${id_user}/update')}}`,
            data    : $("#kt_modal_add_user_form").serialize(),
            dataType: "JSON",
            success :function(data){
                if (!data.success) {
                    let err_user_role = data.errors.user_role  ? `<li>${data.errors.user_role}</li>` : ``;

                    document.getElementById("notification").innerHTML = "<div class='alert alert-danger d-flex align-items-center p-5' id='notification'><i class='ki-duotone ki-shield-tick fs-2hx text-danger me-4'><span class='path1'></span><span class='path2'></span></i><div class='d-flex flex-column'><h4 class='mb-1 text-danger'>Oops! Something went wrong!</h4>"+err_user_role+"</div></div>";      
                    setButtonSpinner(".update_permission", "off");

                }else{
                    setButtonSpinner(".update_permission","off");
                    $("#tb_user").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_user").modal("hide");  
                }
            }
        });
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

    $("#btn-cancel").click(function(){
        $("#kt_modal_add_user").modal("hide");
    });

});
</script>
@endpush
