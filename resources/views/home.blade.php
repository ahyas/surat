@extends('layouts.app')

@section('content')
<!--begin::Post-->
<div class="content flex-column-fluid" id="kt_content">
    <div class="card h-100" >
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <p>Dashboard</p>
            </div>
        </div>
        <div class="card-body py-4">
            <h4 class="card-title align-items-start flex-column">			
                <span class="card-label fw-bold text-gray-800">Selamat Datang</span>
                
                <span class="text-primary">{{Auth::user()->name}}</span>
            </h4>
            <h4 class="text-gray-800">Di Aplikasi SIMANSUR</h4>
            <h4 class="text-gray-600">Sistem Informasi Manajemen Persuratan</h4>
        </div>
    </div>

</div>

@endsection
