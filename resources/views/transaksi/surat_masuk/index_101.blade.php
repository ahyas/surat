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

                <div class="modal fade" id="kt_modal_add_surat_masuk" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_surat_masuk_header">
                                <div id="title"></div>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                            </div>
                            <div class="modal-body px-5 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_surat_masuk_form" name="add_surat_masuk_form" class="form" action="#" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                        
                                        <div id="notification"></div>
                                        
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
                                            <label class="required fw-semibold fs-6 mb-2">Perihal / Isi ringkas</label>
                                            <textarea class="form-control form-control-solid" placeholder="Perihal surat" id="perihal" name="perihal" rows="3" required></textarea>
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
                                        <button type="button" id="btn-cancel" class="btn btn-light-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-primary save_surat_masuk" id="save_surat_masuk" data-kt-indicator="off">
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

        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_masuk">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">No. Surat</th>
                        <th class="min-w-125px">Pengirim</th>
                        <th >Perihal / isi ringkas</th>
                        <th>Tanggal Surat</th>
                        <th class="text-end min-w-125px">Lampiran</th>
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

    $("#tgl_surat").flatpickr();
    var id_role = `{{$data['id_role']}}`;
    console.log(id_role);
    $("#tb_surat_masuk").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_masuk.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        ordering    :false,
        responsive:true,
        columns     :
        [
            {data:"no_surat", 
                mRender:function(data, type, full){
                    if(full['rahasia'] !== 'true'){
                        var a = `<span class="badge badge-light-success">Biasa</span>`;
                    }else{
                        var a = `<span class="badge badge-light-danger">Rahasia</span>`;
                    }

                    if(data.length>=29){
                        var result = data.slice(0, 29)+" ...";   
                    }else{
                        var result = data
                    }

                    return`<div class="d-flex flex-column">
                                <div class="text-gray-800 mb-1">${result}</div>
                                <span>${a}</span>                   
                            </div>`;
                }
            },
            {data:"pengirim"},
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
            {data:"tgl_surat", mRender:function(data){
                    return`<div style='white-space: nowrap'>${data}</div>`
                }},
            {data:"file", className: "text-end",
                mRender:function(data){
                    return`<a href='javascript:void(0)' id="lampiran" data-url="{{asset('/public/uploads/surat_masuk/${data}')}}"><span class="badge badge-secondary">Berkas</span></a>`;
                }
            }
        ]
    });

    $("body").on("click", "#lampiran", function(){
        $("#kt_modal_scrollable_2").modal("show");
        document.getElementById("preview").src = $(this).data("url")
    });

});
</script>
@endpush
