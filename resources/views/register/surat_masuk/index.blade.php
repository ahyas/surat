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
                <p>Register surat masuk</p>
            </div>
            
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="fv-row mb-7">
                <form target="_blank" action="{{route('register.print')}}" method="POST">
                    {{ csrf_field()}}
                    <label class="fw-semibold fs-6 mb-2">Tahun</label>
                    <select name="tahun" id="tahun" class="form-select form-select-solid" data-placeholder="Select an option" data-hide-search="true" >
                        <option selected value="0000" >Pilih tahun</option>
                        <option value="2025" >2025</option>
                        <option value="2024">2024</option>
                    </select>
                    <div class="pt-5">
                        <button type="submit" class="btn btn-primary btn-sm" id="btn_print" disabled>
                        <i class="ki-duotone ki-plus fs-2"></i>Print register</a>
                    </div>
                </form>
            </div>
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_bidang">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Nomor</th>
                        <th width="350px">Pengirim</th>
                        <th class="w-125px">Tanggal</th>
                        <th>Status</th>
                        <th>Perihal</th>
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
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

    function getData(tahun){
        $("#tb_bidang").DataTable().clear().destroy();
        var table = $("#tb_bidang").DataTable({
            ajax        : {
                url:"register/surat_masuk/"+tahun+"/get_data",
                dataSrc:""
            },
            "drawCallback": function (settings) { 
                var response = settings.json;
                if(response !== undefined){
                    if(response.length > 0 ){
                        document.getElementById("btn_print").disabled = false;
                    }else{
                        document.getElementById("btn_print").disabled = true;
                    }
                }
            },
            serverSide  : false,
            stateSave   : true,
            ordering    : false,
            responsive  : true,
            searching   : false,
            columns     :
            [
                {data:"no_surat"},
                {data:"pengirim"},
                {data:"tgl_surat"},
                {data:"status",
                    mRender:function(data, type, full){
                        if(full['id_status'] == 3){
                            return `
                                <div style='white-space: nowrap'>${data}</div> 
                                <span class="badge badge-light-success">Sudah diarsipkan</span>                       
                                `;
                        }else if(full['id_status'] == 1 || full['id_status'] == 2 || full['id_status'] == 4 || full['id_status'] == 5){
                            return `
                                <div style='white-space: nowrap'>${data}</div> 
                                <span class="badge badge-light-danger">Belum diarsipkan</span>                       
                                `;
                        }else{
                            return `
                                <span class="badge badge-light-danger">Belum diproses</span>                       
                                `;
                        }
                    }
                },
                {data:"perihal"},
                {data:"dibuat_oleh"},
            ]
        });

    }
    let tahun = "0000";
    getData(tahun);

    $("body").on("click","#tahun", function(){
        let selected = $(this).val();
        getData(selected);
        if(selected !== "0000"){
            document.getElementById("btn_print").disabled = false;
        }else{
            document.getElementById("btn_print").disabled = true;
        }
    });
});
</script>
@endpush
