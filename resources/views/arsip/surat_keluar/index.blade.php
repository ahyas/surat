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
                <p>Arsip Surat Keluar</p>
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_surat_keluar">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nomor Surat</th>
                        <th>Perihal/Tentang</th>
                        <th class="min-w-125px">Tujuan / Penerima</th>
                        <th class="min-w-125px">Tanggal Surat</th>
                        <th>Lampiran</th>
                        <th>Dibuat oleh</th>
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

@endsection
@push('scripts')

<script type="text/javascript">
$(document).ready(function(){
    var current_user_id = "{{Auth::user()->id}}";
    let tb_surat_keluar = $("#tb_surat_keluar").DataTable({
        ajax        : {
            url:"{{route('arsip.surat_keluar.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        responsive  : true,
        columns     :
        [
            {data:"no_surat",
                mRender:function(data, type, full){

                    return`<div class="d-flex flex-column">
                            <div style='white-space: nowrap' class="text-gray-800 mb-1">${data}</div>
                            <div>${full['deskripsi']}</div>
                        </div>`;
                }
            },
            {data:"perihal"},
            {data:"jumlah_tembusan", 
                mRender:function(data, type, full){
                    if(full["internal"] == 2){
                        var a = `<span class="badge badge-light-danger" style="margin-bottom:10px">External</span>`;
                    }else if(full["internal"] == 1){
                        var a = `<span class="badge badge-light-primary" style="margin-bottom:10px">Internal</span>`;
                    }else{
                        var a = ``;
                    }
                    
                    //tujuan internal
                    if(data>0){
                        var show = `${a}<br><a href="javascript:void(0)" id="daftar_tujuan" data-id_surat='${full['id_surat']}'><span class="badge badge-info">${data} orang</span></a>`;
                        return show;
                    }else{//tujuan eksternal
                        return `${a}<br><span style="color:white; font-size:11px; font-weight:600; cursor: pointer;" id="tujuan_eksternal" data-id_surat='${full['id_surat']}'><div class="bg-info" style="padding:6px; border-radius:5px" >${full['tujuan']}</div></span>`;
                    }
                    
                }
            },
            {data:"tgl_surat"},
            {data:"file",
                mRender:function(data){
                    if(data !== null){
                        //return`<a href="{{asset('/public/uploads/surat_keluar/${data}')}}" target="_blank" >File</a>`;
                        return`<a href='javascript:void(0)' id="lampiran" data-url="{{asset('/public/uploads/surat_keluar/${data}')}}"><span class="badge badge-light-secondary">Berkas</span></a>`;
                    }else{
                        return '';
                    }
                }
            },
            {data:"dibuat_oleh"},
        ]
    });

    $("body").on("click","#daftar_tujuan",function(){
        var id_surat = $(this).data("id_surat");
        console.log(id_surat)
        $("#kt_modal_tujuan").modal("show");
        $("#tb_tembusan").DataTable({
            ajax        : {
                url:`{{url('transaksi/surat_keluar/${id_surat}/detail')}}`,
                dataSrc:function(res){  
                    return res.table
                }
            },
            "bDestroy": true,
            searching   : false, paging: false, info: false,
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

});
</script>
@endpush
