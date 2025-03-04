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

                    <label class="fw-semibold fs-6 mb-2">Bulan</label>
                    <select name="bulan" id="bulan" class="form-select form-select-solid" data-placeholder="Select an option" data-hide-search="true" disabled>
                        <option selected value="0" >Pilih bulan</option>
                        <option value="01" >Januari</option>
                        <option value="02" >Februari</option>
                        <option value="03" >Maret</option>
                        <option value="04" >April</option>
                        <option value="05" >Mei</option>
                        <option value="06" >Juni</option>
                        <option value="07" >Juli</option>
                        <option value="08" >Agustus</option>
                        <option value="09" >September</option>
                        <option value="10" >Oktober</option>
                        <option value="11" >November</option>
                        <option value="12">Desember</option>
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
                        <th width="20px">No</th>
                        <th>Nomor surat</th>
                        <th width="350px">Pengirim</th>
                        <th class="w-125px">Tanggal</th>
                        <th width="450px">Perihal</th>
                        <th>Status</th>
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

    function getData(tahun, bulan){
        console.log('tahun ', tahun, ' bulan ', bulan);

        $("#tb_bidang").DataTable().clear().destroy();
        var table = $("#tb_bidang").DataTable({
            ajax        : {
                url:"register/surat_masuk/"+tahun+"/"+bulan+"/get_data",
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
                {"data": "no_surat",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {data:"no_surat", 
                    mRender:function(data, type, full){
                        if(full['kerahasiaan'] == 2){
                        var a = `<span class="badge badge-light-danger">Sangat Rahasia</span>`;
                        }else if(full['kerahasiaan'] == 1){
                            var a = `<span class="badge badge-light-warning">Rahasia</span>`;
                        }else{
                            var a = `<span class="badge badge-light-success">Biasa</span>`;
                        }

                        if(full['is_internal'] == 1){
                            var b = `<span class="badge badge-light-default">${full['kode_klasifikasi']} - ${full['klasifikasi']}</span>`;
                        }else{
                            var b = '';
                        }
                        
                        if(data.length>=29){
                            var result = data.slice(0, 29)+" ...";   
                        }else{
                            var result = data
                        }

                        return`<div class="d-flex flex-column">
                                    <span>${b}</span>
                                    <div class="text-gray-800 mb-1">${result} <div>
                                    <span>${a}</span>                   
                                </div>`;
                    }
                },
                {data:"pengirim",
                    mRender:function(data, type, full){
                        if(full['is_internal'] == 1){
                            var a = `<span class="badge badge-light-primary">Mahkamah Agung</span>`;
                        }else if(full['is_internal'] == 2){
                            var a = `<span class="badge badge-light-warning">Non Mahkamah Agung</span>`;
                        }else{
                            var a = `<span class="badge badge-light-danger">Undefined</span>`;
                        }

                        return `
                        <div class="d-flex flex-column">
                            <span>${a}</span>
                            <span>${data}</span>
                        </div>`;
                    }
                },
                {data:"tgl_surat"},
                {data:"perihal"},
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
                {data:"dibuat_oleh"},
            ]
        });

    }
    let tahun = "0000";
    let bulan = "0";
    getData(tahun, bulan);

    $("body").on("click","#tahun", function(){
        let tahun = $(this).val();
        let bulan = document.getElementById("bulan").value;

        getData(tahun, bulan);

        if(tahun !== "0000"){
            document.getElementById("btn_print").disabled = false;
            document.getElementById("bulan").disabled = false;
        }else{
            document.getElementById("btn_print").disabled = true;
            document.getElementById("bulan").disabled = true;
        }
    });

    $("body").on("click","#bulan", function(){
        let tahun = document.getElementById("tahun").value;
        let bulan = $(this).val();
        getData(tahun, bulan);
    });
});
</script>
@endpush
