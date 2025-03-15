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
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_keluar">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nomor Surat</th>
                        <th>Perihal/Isi ringkas</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th class="min-w-125px">Diinput tanggal</th>
                        <th>Lampiran</th>
                        <th class="min-w-125px">Dibuat Oleh</th>
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
            <div class="d-flex flex-row" style="gap:20px">
                <h2 class="modal-title">Preview</h2>
                <a href="#" id="download_pdf" target="_blank" class="btn btn-light-success btn-sm">Download</a>
            </div>

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
<!--start::lampiran surat keluar ms office -->
<div class="modal fade" id="office_preview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
            <div class="d-flex flex-row" style="gap:20px">
                <h2 class="modal-title">Preview</h2>
                <a href="#" id="download_office" target="_blank" class="btn btn-light-success btn-sm">Download</a>
            </div>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            
            <div class="modal-body" >
                <div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 129.4118%;"><iframe id="preview_office" src='#' width='100%' height='650px' frameborder='0'></iframe></div>
            </div>
        </div>
    </div>      
</div>

<div class="modal fade" id="kt_modal_tembusan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h2 class="modal-title">Daftar tembusan surat</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_tembusan">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
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

@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){

    $("#tgl_surat").flatpickr();
    var id_role = `{{$data['id_role']}}`;
    

    $("#tb_surat_keluar").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_keluar.get_data')}}",
            dataSrc:""
        },
        serverSide  :false,
        ordering    :false,
        responsive  :true,
        columns     :
        [
            {data:"no_surat",
                mRender:function(data, type, full){
                    if(full["internal"] == 2){
                        var a = `<span class="badge badge-light-success">External</span>`;
                    }else if(full["internal"] == 1){
                        var a = `<span class="badge badge-light-primary">Internal</span>`;
                    }else{
                        var a = ``;
                    }

                    return`<div class="d-flex flex-column">
                        <div class="text-gray-800 mb-1">${data}</div>
                        ${full["deskripsi"]}
                        </div>${a}`;
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
            {data:"tgl_surat"},
            {data:"diinput_tanggal"},
            {data:"file",
                mRender:function(data){
                    //return`<a href="{{asset('/public/uploads/surat_keluar/${data}')}}" target="_blank" >File</a>`;
                    return`<a href='javascript:void(0)' data-filename='${data}' id="lampiran" data-url="{{asset('/public/uploads/surat_keluar/${data}')}}"><span class="badge badge-light-secondary">Berkas</span></a>`;
                }
            },
            {data:"dibuat_oleh"}
        ]
    });

    $("body").on("click","#daftar_tembusan",function(){
        var id_surat = $(this).data("id_surat");
        $("#kt_modal_tembusan").modal("show");
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
                    }
                }
            ]
        });
    });

    $("body").on("click", "#lampiran", function(){
        console.log($(this).data("filename"));
        var filename = $(this).data("filename");
        var extension = filename.substr(filename.indexOf('.')); 
        var url = $(this).data("url");
        console.log($(this).data("url"))
        if(extension == '.pdf'){
            $("#modal_preview").modal("show");
            document.getElementById("preview").src = url;
            document.getElementById("download_pdf").href = url;
        }else{
            $("#office_preview").modal("show");
            document.getElementById("preview_office").src = `https://view.officeapps.live.com/op/embed.aspx?src=${url}`;
            document.getElementById("download_office").href = url;
        }
    });

});
</script>
@endpush
