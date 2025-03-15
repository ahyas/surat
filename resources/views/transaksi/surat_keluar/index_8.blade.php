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
                        <th class="min-w-125px">Tujuan / Penerima</th>
                        <th class="min-w-125px">Tanggal Surat</th>
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
                <div style="left: 0; width: 100%; height: 100%; position: relative;"><iframe id="preview" src="#" width='100%' height='650px' frameborder='0'></iframe></div>

                <div class="text-center pt-10" id="show_control_button">
                    <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                </div>

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
                <div style="left: 0; width: 100%; height: 100%; position: relative;"><iframe id="preview_office" src='#' width='100%' height='650px' frameborder='0'></iframe></div>

                <div class="text-center pt-10" id="show_control_button">
                    <button type="button" id="btn-cancel" class="btn btn-light-danger" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>      
</div>
<!--end::lampiran surat keluar ms office-->

<!--Daftar tujuan internal-->
<div class="modal fade" id="kt_modal_tujuan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h2 class="modal-title">Daftar Penerima Surat Internal</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
            <input type="hidden" id="count_penerima" />
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

<!--Daftar tujuan eksternal-->
<div class="modal fade" id="kt_modal_tujuan_eksternal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h2 class="modal-title">Penerima Surat Eksternal</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div id="notification2"></div>
                <form name="form_penerima_eksternal" id="form_penerima_eksternal" method="POST">
                    {{ csrf_field()}}
                    <input type="hidden" id="id_surat_keluar_eksternal"/>
                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Tujuan</label>
                        <input type="text" name="penerima_eksternal" id="penerima_eksternal" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tujuan surat" readonly/>
                    </div>
                    <div class="text-center pt-10">
                        <button type="submit" id="update_penerima_eksternal" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
    
    var current_user_id = "{{Auth::user()->id}}";
    $("#tb_surat_keluar").DataTable({
        ajax        : {
            url:"{{route('transaksi.surat_keluar.get_data')}}",
        },
        serverSide  :true,
        processing  :true,
        ordering    :false,
        responsive  :true,
        columns     :
        [
            {data:"no_surat",
                mRender:function(data, type, full){
                    return`<div class="d-flex flex-column">
                            <div class="text-gray-800 mb-1">${data}</div>
                        ${full["deskripsi"]}
                        </div>`;
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
            {data:"jumlah_tembusan", 
                mRender:function(data, type, full){
                    if(full["internal"] == 2){
                        var a = `<span class="badge badge-light-success" style="margin-bottom:10px">External</span>`;
                    }else if(full["internal"] == 1){
                        var a = `<span class="badge badge-light-primary" style="margin-bottom:10px">Internal</span>`;
                    }else{
                        var a = ``;
                    }

                    if(full["id_user"] == current_user_id){
                        var show_control = "show";
                    }else{
                        var show_control = "hide";
                    }
                    
                    //tujuan internal
                    if(data>0){
                        var show = `${a}<br><a href="javascript:void(0)" id="daftar_tujuan" data-id_surat='${full['id_surat']}' data-show_control='${show_control}'>
                        <span class="badge badge-info">${data} orang</span></a>`;
                        return show;
                    }else{//tujuan eksternal
                        return `${a}<br><span style="color:white; font-size:11px; font-weight:600; cursor: pointer;" id="tujuan_eksternal" data-id_surat='${full['id_surat']}' data-show_control='${show_control}'><div class="bg-info" style="padding:6px; border-radius:5px" >${full['tujuan']}</div></span>`;
                    }
                    
                }
            },
            {data:"tgl_surat"},
            {data:"file",
                mRender:function(data){
                    return`<a href='javascript:void(0)' data-filename='${data}' id="lampiran" data-url="{{asset('/public/uploads/surat_keluar/${data}')}}"><span class="badge badge-light-secondary">Berkas</span></a>`;
                }
            },
            {data:"dibuat_oleh"}
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

    $(("body")).on("click","#tujuan_eksternal", function(){
        
        let id_surat = $(this).data("id_surat");        

        $.ajax({
            url:`{{url('transaksi/surat_keluar/${id_surat}/detail_eksternal')}}`,
            type:"GET",
            success:function(data){
                console.log(data.tujuan)
                $("#penerima_eksternal").val(data.tujuan)
                
                $("#kt_modal_tujuan_eksternal").modal("show");
            }
        })
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
