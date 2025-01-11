<style>
    @page { margin: 30px; font-family: 'Verdana';}
</style>



<style>
    * {
    font-size: 10pt;
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
        <title>Print Register Surat Keluar</title>
    </head>
    <body class="receipt">

        <section class="sheet">
            <h3 style=" text-align:center">REGISTER SURAT KELUAR</h3>
            <h3 style="line-height:5px; text-align:center">PENGADILAN TINGGI AGAMA PAPUA BARAT</h3>
            <h3 style="line-height:5px; text-align:center">TAHUN {{$tahun}}</h3>

            <table style="width:100%; font-size:13px; margin-right:30px;">
                <tr style="background-color:gray; color:white">
                    <th align="left" style="padding:8px; width:250px">Nomor</th>
                    <th align="left" style="padding:8px;">Tujuan</th>
                    <th align="left" style="padding:8px; width:80px">Tanggal</th>
                    <th align="left" style="padding:8px; width:300px">Perihal</th>
                </tr>
                @foreach($table as $row)
                <tr>
                    <td style="padding:8px;">{{$row->no_surat}}</td>
                    <td style="padding:8px;">{{$row->tujuan}}</td>
                    <td style="padding:8px;">{{$row->tgl_surat}}</td>
                    <td style="padding:8px;">{{$row->perihal}}</td>
                </tr>
                @endforeach
            </table>          
        </section>
    </body>
</html>
