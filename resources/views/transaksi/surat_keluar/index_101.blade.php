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
                        <th class="min-w-125px">Nomor Surat</th>
                        <th >Perihal/Isi Ringkas</th>
                        <th >Tujuan</th>
                        <th class="min-w-150px">Tanggal Surat</th>
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
    

    $("#tb_surat_keluar").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_keluar.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        ordering    :false,
        responsive  : true,
        columns     :
        [
            {data:"no_surat",
                mRender:function(data, type, full){
                    if(full['id_nomenklatur_jabatan'] == 1){
                        var a = `<span class="badge badge-light-danger">Pimpinan</span>`;
                    }

                    if(full['id_nomenklatur_jabatan'] == 2){
                        var a = `<span class="badge badge-light-primary">Kepaniteraan</span>`; 
                    }

                    if(full['id_nomenklatur_jabatan'] == 3){
                        var a = `<span class="badge badge-light-success">Kesekretariatan</span>`;
                    }

                    return`<div class="d-flex flex-column">
                        <div class="text-gray-800 mb-1">${data}</div>
                        <span>${full['deskripsi']}</span>
                        <span>${a}</span>
                        
                    </div>`;
                }
            },
            {data:"perihal"},
            {data:"jumlah_tujuan", 
                mRender:function(data, type, full){
                    if(data>0){
                        var show = `<a href="javascript:void(0)" id="tujuan" data-id_surat='${full['id_surat']}'><span class="badge badge-info">${data} orang</span></a>`;
                        return show;
                    }else{
                        return '';
                    }
                    
                }
            },
            {data:"tgl_surat"},
            {data:"file",className: "text-end",
                mRender:function(data){
                    //return`<a href="{{asset('/public/uploads/surat_keluar/${data}')}}" target="_blank" >File</a>`;
                    return`<a href='javascript:void(0)' id="lampiran" data-url="{{asset('/public/uploads/surat_keluar/${data}')}}"><span class="badge badge-danger">Berkas</span></a>`;
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
