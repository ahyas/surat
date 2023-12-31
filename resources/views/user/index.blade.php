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
                                <h2 class="fw-bold">Add User</h2>
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
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" />
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
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary" id="save_user" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Save</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="update_user" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Update</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                        <th class="min-w-125px">Bidang</th>
                        <th class="text-end min-w-125px">Actions</th>
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

<script src="{{asset('public/assets/js/custom/apps/user-management/users/list/add.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#tb_user").DataTable({
        ajax        : {
            url:"{{route('user.list.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
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
            {data:"bidang"},
            {data:"id_user", className: "text-end",
                mRender:function(data, type, full){
                    return`<div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a href="javascript:void(0)" class="dropdown-item" id="edit_user" data-id_user='${data}'>Edit</a></li>
                                    <li><a href="javascript:void(0)" class="dropdown-item delete_user" data-id_user='${data}'>Delete</a></li>
                                </ul>
                            </div>`;
                }
            }
        ]
    });

    $("body").on("click", "#edit_user", function(){
        var id_user = $(this).data("id_user");
        document.getElementById("update_user").style.display = "inline-block";
        document.getElementById("save_user").style.display = "none";
        $("#kt_modal_add_user_form").trigger("reset");
        $.ajax({
            type:"GET",
            url:`{{url('user/list/${id_user}/edit')}}`,
            dataType:"JSON",
            success:function(data){
                console.log(data);
                $("input[name='id_user']").val(data.id_user);
                $("input[name='name']").val(data.nama);
                $("input[name='email']").val(data.email);
                $("#bidang").val(data.id_bidang).trigger('change');
                $("#kt_modal_add_user").modal("show");
            }
        });
    });

    $("#update_user").click(function(e){
        e.preventDefault();
        var id_user = $("input[name='id_user']").val();
        $.ajax({
            type    : "POST",
            url     : `{{url('user/list/${id_user}/update')}}`,
            data    : $("#kt_modal_add_user_form").serialize(),
            dataType: "JSON",
            success :function(data){
                console.log("Sip");
                $("#tb_user").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_user").modal("hide");  
            }
        });
    });

    $("body").on("click","#add_user", function(){
        document.getElementById("update_user").style.display = "none";
        document.getElementById("save_user").style.display = "inline-block";
        $("#kt_modal_add_user_form").trigger("reset");
        $("#bidang").val("").trigger('change');
        $("#kt_modal_add_user").modal("show");
    });

    $("#save_user").click(function(e){
        e.preventDefault();
        console.log($("input[name='email']").val());
        $.ajax({
            type    : "POST",
            url     : "{{route('user.list.save')}}",
            data    : $("#kt_modal_add_user_form").serialize(),
            dataType: "JSON",
            success :function(data){
                console.log("Sip");
                $("#tb_user").DataTable().ajax.reload(null, false);
                $("#kt_modal_add_user").modal("hide");
            }
        });
    });

    $("body").on("click", ".delete_user", function(){
        console.log($(this).data("id_user"));
        var id_user = $(this).data("id_user");
        if(confirm("Anda yakin ingin menghapus data ini?")){
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
});
</script>
@endpush
