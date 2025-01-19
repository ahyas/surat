
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

#content tr td{
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
            <table style="border:none;" style="width:100%">
                <tr style="border-bottom: 2px solid grey;">
                    <td style=" width:80px; padding-bottom:10px"><img src="{{public_path('assets/media/logopta.png')}}" style="width:75px"/></td>
                    <td class="centered" style="padding-bottom:10px">
                        <div >
                        <span style="line-height:0; font-size:20px; font-weight:bold">MAHKAMAH AGUNG REPUBLIK INDONESIA</span>
                        <h1 style="line-height:10px; ">PENGADILAN TINGGI AGAMA PAPUA BARAT</h1>
                        <p>Jl. Brawijaya, Kelurahan Manokwari Timur, Distrik Manokwari,
Provinsi Papua Barat. Kode POS 98311</p>
                        </div>
                    </td>
                </tr>
            </table>

            <p style="font-size:20px; text-align:center; font-weight:bold; line-height:0; padding-top:15px">LEMBAR DISPOSISI</p>

            <table id="content" style="width:100%; font-size:13px; margin-right:30px;">
                <tr>
                    <td align="left" style="padding:8px;" valign="top">
                        <p><b>Nomor surat :</b> <br>{{$detail_surat->no_surat}}</p>
                        <p><b>Tanggal surat :</b><br> {{$detail_surat->tgl_surat}}</p>
                    </td>
                    <td align="left" style="padding:8px;" colspan="2" valign="top">
                        <p><b>Diterima tanggal :</b><br> {{$detail_surat->diterima_tanggal}}</p>
                        <p><b>Pengirim : </b><br>{{$detail_surat->pengirim}}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:8px;" align="left" valign="top">
                        <p><b>Perihal :</b> <br>{{$detail_surat->perihal}}</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px">
                        <b>Diteruskan kepada</b>
                    </td>
                    <td style="padding:8px"><b>Catatan</b></td>
                    <td style="padding:8px"><b>Petunjuk</b></td>
                </tr>
                @foreach($table as $row)
                <tr>
                    <td style="padding:8px">
                        <p><b>Dari :</b> {{$row->jab_pengirim}}</p>
                        <p><b>Ke :</b> {{$row->jab_penerima}}</p>
                        <p>{{$row->tanggal}} / {{$row->waktu}}</p>
                    </td>
                    <td style="padding:8px">{{$row->catatan}}</td>
                    <td style="padding:8px">{{$row->petunjuk}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="padding:9px">
                        <p><b>Ditindaklanjuti Oleh :</b> {{$detail_surat->jabatan_pegawai}}</p>
                        <p><b>Pada tanggal :</b> {{$detail_surat->tgl_tindak_lanjut}}</p>
                        <p><b>Keterangan :</b>{{$detail_surat->catatan_tindaklanjut}} </p>
                        <p><b>Status :</b> {{$detail_surat->status}}</p>
                    </td>
                </tr>
            </table>         
        </section>
    </body>
</html>