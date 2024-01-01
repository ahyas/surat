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
                <p>Daftar Role</p>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
               
                <!--end::Modal - New Card-->
                
                <!--end::Modal - Add task-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tb_role">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>ID</th>
                        <th class="min-w-125px">Role</th>
                        <th class="min-w-125px">Keterangan</th>
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
    $("#tb_role").DataTable({
        ajax        : {
            url:"{{route('user.role.get_data')}}",
            dataSrc:""
        },
        serverSide  : false,
        ordering    : false,
        columns     :
        [
            {data: "id_role"},
            {data:"role"},
            {data:"keterangan"}
        ]
    });
});
</script>
@endpush
