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
                <p>Surat Masuk</p>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    
                    <button type="button" class="btn btn-primary btn-sm" id="add_surat_masuk">
                    <i class="ki-duotone ki-plus fs-2"></i>Add Surat Masuk</button>
                    <!--end::Add user-->
                </div>

                <div class="modal fade" id="kt_modal_add_surat_masuk" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_surat_masuk_header">
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_surat_masuk_form" name="add_surat_masuk_form" class="form" action="#" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        <input type="hidden" name="id_surat_masuk" class="form-control" />
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Nomor surat</label>
                                            <input type="text" name="nomor_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nomor surat" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Pengirim</label>
                                            <input type="text" name="pengirim" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pengirim surat" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Perihal</label>
                                            <input type="text" name="perihal" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Perihal surat" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">Tanggal surat</label>
                                            <input type="text" name="tgl_surat" id="tgl_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tanggal surat" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-semibold fs-6 mb-2">File</label>
                                            <input class="form-control form-control-solid mb-3 mb-lg-0" name="file_surat" type="file" id="file_surat" >
                                        </div>
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-10">
                                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary" id="save_surat_masuk" data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Save</span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="update_surat_masuk" data-kt-users-modal-action="submit">
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_masuk">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">No. Surat</th>
                        <th class="min-w-125px">Pengirim</th>
                        <th >Perihal</th>
                        <th >Tanggal Surat</th>
                        <th class="text-end min-w-125px">Lampiran</th>
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

    $("#tgl_surat").flatpickr();

    $("#tb_surat_masuk").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_masuk.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        columns     :
        [
            {data:"no_surat"},
            {data:"pengirim"},
            {data:"perihal"},
            {data:"tgl_surat"},
            {data:"file", className: "text-end",
                mRender:function(data){
                    return`<a href="{{asset('/public/uploads/surat_masuk/${data}')}}" >File</a>`;
                }
            }
        ]
    });

    $("body").on("click","#add_surat_masuk", function(){
        document.getElementById("update_surat_masuk").style.display = "none";
        document.getElementById("save_surat_masuk").style.display = "inline-block";
        document.getElementById("kt_modal_add_surat_masuk_header").innerHTML = `<h2 class="fw-bold">Add surat masuk</h2>`;
        $("#kt_modal_add_surat_masuk_form").trigger("reset");
        $("#bidang").val("").trigger('change');
        $("#kt_modal_add_surat_masuk").modal("show");
    });

    $("#save_surat_masuk").click(function(e){
        e.preventDefault();
        var formData = new FormData(document.getElementById("kt_modal_add_surat_masuk_form"));        
        if(confirm("periksa kembali data Anda. Data yang sudah terkirim tidak dapat diubah!")){
            $.ajax({
                url:`{{route('transaksi.surat_masuk.save')}}`,
                type:"POST",
                dataType:"JSON",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    $("#tb_surat_masuk").DataTable().ajax.reload(null, false);
                    $("#kt_modal_add_surat_masuk").modal("hide");
                }
            });
        }
    });

});
</script>
@endpush
