<style>
    @page { margin: 30px; font-family: 'Verdana';}
</style>



<style>
    * {
    font-size: 9pt;
}

@page { margin: 10mm;} 

body.receipt .sheet 
{ width: auto;  margin:auto;} /* change height as you like */

@media print 
{ body.receipt { width: auto;} } /* this line is needed for fixing Chrome's bug */

td,
th,
tr,
table {
    border: 1px solid gray;
    border-collapse: collapse;
    width: 100%;
}

.centered {
    text-align: center;
    align-content: center;
}

</style>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
        <link type="image/x-icon" sizes="16x16" rel="icon" href="{{asset('public/images/fav.png')}}">
        <title>Print Register Surat Masuk</title>
    </head>
    <body class="receipt">

        <section class="sheet">
            <h3 style=" text-align:center">REGISTER SURAT MASUK</h3>
            <h3 style="line-height:5px; text-align:center">PENGADILAN TINGGI AGAMA PAPUA BARAT</h3>
            <h3 style="line-height:5px; text-align:center"> <?php if($bulan !== ''){
                switch ($bulan){
                    case '01':
                        echo 'BULAN JANUARI';
                    break;

                    case '02':
                        echo 'BULAN FEBRUARI';
                    break;

                    case '03':
                        echo 'BULAN MARET';
                    break;

                    case '04':
                        echo 'BULAN APRIL';
                    break;

                    case '05':
                        echo 'BULAN MEI';
                    break;

                    case '06':
                        echo 'BULAN JUNI';
                    break;

                    case '07':
                        echo 'BULAN JULI';
                    break;

                    case '08':
                        echo 'BULAN AGUSTUS';
                    break;

                    case '09':
                        echo 'BULAN SEPTEMBER';
                    break;

                    case '10':
                        echo 'BULAN OKTOBER';
                    break;

                    case '11':
                        echo 'BULAN NOVEMBER';
                    break;

                    default:
                        echo 'BULAN DESEMBER';
                }
                 
                } ?> TAHUN {{$tahun}}</h3>
            @php $row_num = 1; @endphp
            <table style="width:100%; font-size:13px; margin-right:30px;">
                <tr style="background-color:gray; color:white">
                    <th align="left" style="padding:8px; width:20px">No.</th>
                    <th align="left" style="padding:8px; width:150px">Nomor surat</th>
                    <th align="left" style="padding:8px;">Tujuan</th>
                    <th align="left" style="padding:8px; width:80px">Tanggal</th>
                    <th align="left" style="padding:8px; width:200px">Perihal</th>
                    <th align="left" style="padding:8px;">Status</th>
                    <th align="left" style="padding:8px; width:120px">DIbuat oleh</th>
                </tr>
                @foreach($table as $row)
                <tr>
                    <td style="padding:8px;">{{$row_num}}</td>
                    <td style="padding:8px;">{{$row->no_surat}}</td>
                    <td style="padding:8px;">{{$row->pengirim}}</td>
                    <td style="padding:8px;">{{$row->tgl_surat}}</td>
                    <td style="padding:8px;">{{$row->perihal}}</td>
                    <td style="padding:8px;">
                        @if($row->id_status == 3)
                                <div style='white-space: nowrap'><i>{{$row->status}}</i></div> 
                                <span class="badge badge-light-success">Sudah diarsipkan</span>                       
                        @elseif($row->id_status == 1 || $row->id_status == 2 || $row->id_status == 4 || $row->id_status == 5)
                                <div style='white-space: nowrap'><i>{{$row->status}}</i></div> 
                                <span class="badge badge-light-danger">Belum diarsipkan</span>                       
                        @else
                                <span class="badge badge-light-danger">Unprocessed</span>
                        @endif
                    </td>
                    <td style="padding:8px;">{{$row->dibuat_oleh}}</td>
                </tr>
                @php $row_num += 1; @endphp
                @endforeach
            </table>          
        </section>
    </body>
</html>
