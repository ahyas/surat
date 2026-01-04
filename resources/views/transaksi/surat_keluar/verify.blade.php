<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document QR authentication</title>
  </head>
  <body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                
                    <?php if($surat_keluar == ''){ ?>
                        <div class="alert alert-danger" style="margin-top:40px" role="alert">
                            <img alt="Logo" src="{{asset('assets/media/logos/default-small.svg')}}" style="margin-bottom:15px; width:50px;"><h2>SIMISOL Document authentication</h2>
                            <p style="color: red; font-weight:bold">Oops! Data tidak valid atau tidak ditemukan didalam sistem!</p>
                        </div>
                        <?php }else{ ?>
                            <div class="alert alert-primary" style="margin-top:40px" role="alert">
                            <img alt="Logo" src="{{asset('assets/media/logos/default-small.svg')}}" style="margin-bottom:15px; width:50px;"><h2>SIMISOL Document authentication</h2>
                            <p>Dokumen telah terverifikasi oleh aplikasi SIMISOL dan dinyatakan valid. Pastikan detail surat keluar sesuai dengan informasi dibawah ini:</p>
                        <ul>
                            <li>Nomor: {{$surat_keluar->no_surat}}</li>
                            <li>Tanggal surat: {{$surat_keluar->tgl_surat}}</li>
                            <li>Perihal: {{$surat_keluar->perihal}}</li>
                            <li>Tanggal dibuat: {{$surat_keluar->created_at}}</li>
                            <li>Dibuat oleh: {{$surat_keluar->dibuat_oleh}}</li>
                        </ul>
                        <a href="<?php echo asset('/uploads/surat_keluar/'.$surat_keluar->file); ?>" target="_blank"><b>Download</b></a></apan>
                        </div>
                    <?php } ?>

                    <div style="left: 0; width: 100%; height: 100%; position: relative;"><iframe id="preview_document" src='#' width='100%' height='650px' frameborder='0'></iframe></div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<script type="text/JavaScript">
    $(document).ready(function(){
        var filename = "{{$surat_keluar->file}}";
        var extension = filename.substr(filename.indexOf('.'));
        
        var url = "{{asset('/uploads/surat_keluar/'.$surat_keluar->file)}}";

        if(extension == '.pdf'){    
            document.getElementById("preview_document").src = url;
        }else{
            document.getElementById("preview_document").src = `https://view.officeapps.live.com/op/embed.aspx?src=${url}`;
        }
    });
</script>

