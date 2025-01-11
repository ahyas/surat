<h3 style="line-height:10px; text-align:center">REGISTER SURAT MASUK</h3>
<h3 style="text-align:center">TAHUN 2024</h3>

<table class="table table-striped table-sm table-bordered" style="width:100%; font-size:13px; margin-top:20px;">
    <tr>
        <th align="left" width="150px">Nomor</th>
        <th align="left">Pengirim</th>
        <th align="left" width="100px">Tanggal</th>
        <th align="left">Perihal</th>
    </tr>
    @foreach($table as $row)
    <tr>
        <td>{{$row->no_surat}}</td>
        <td>{{$row->pengirim}}</td>
        <td>{{$row->tgl_surat}}</td>
        <td>{{$row->perihal}}</td>
    </tr>
    @endforeach
</table>