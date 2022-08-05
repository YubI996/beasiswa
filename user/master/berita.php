<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT'];  
unset($_SESSION['page']);
$_SESSION['page'] = 'berita';
require_once ($host1."/inc/assets/header.php");

?>
    <div class="page-loader-wrapper" id="loading">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Mohon Tunggu...</p>
        </div>
    </div>


    <section class="content" style>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                            <ol class="breadcrumb breadcrumb-bg-teal"></ol>
                        <div class="header">
                            <h2>
                                DATA BERITA
                            </h2>
                        </div>
                        <div class="body table-responsive">
                           <button type="button" class="btn btn-success waves-effect m-r-20" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="btn-tambah" data-target="#form-modal">Tambah Data <i class="material-icons" style="font-size:16px;" >playlist_add</i></button><br><br>

						<div id="view"></div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
            <!-- #END# Basic Examples -->





            <!-- Default Size -->
            <div class="modal fade" id="form-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">assignment</i> <span style="position:relative; top:-5px;" id="modal-title"></span></div>

                        </div>
                        <div class="modal-body">
                        <div id="pesan-validasi" class="alert bg-red alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <form id="form1" method="post" enctype="multipart/form-data">
                                
                                        <input type="hidden" id="id_berita" name="id_berita" class="form-control" placeholder="Masukkan berita">
                                        <input type="hidden" id="isiberita" name="isiberita" />
                                <label for="berita">Judul</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan Judul Berita">
                                    </div>
                                         <span style="color:#f00;font-size:12px;" id="v1"></span>
                                </div>
                                <label for="berita">Foto Berita</label>
                                <div class="form-group" id="cek-file">
                                    <input type="checkbox" id="checkbox" class="cek1" name="checkbox">
                                    <label for="checkbox">Centang jika ingin mengganti foto</label>
                                    <div id="idf"><a class="badge bg-indigo" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="viewfile1" data-target="#modal-file" data-toool="tooltip" data-placement="bottom" title="Lihat Foto"><span id="nmfile"></span></a></div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="foto" name="foto" class="form-control" placeholder="Cari File" required >
                                    </div>
                                    <span style="color:#f00;font-size:12px;" id="v2"></span>
                                </div>
                                <label for="berita">Isi Berita</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="isi" name="isi" required>
                                        </textarea>
                                    </div>
                                    <span style="color:#f00;font-size:12px;" id="v3"></span>
                                </div>
                                        <input type="hidden" id="ceklis" name="ceklis" class="form-control" value="0" placeholder="Masukkan berita">
                                    <button type="reset" id="btn-reset"></button>
                            </form>
                        </div>
                        <div class="modal-footer"> 

                            <button type="submit" class="btn btn-primary waves-effect" id="btn-simpan">SIMPAN</button>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn-ubah">UBAH</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Default Size -->
            <div class="modal fade" id="modal-file" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background:url('../inc/assets/images/bg.jpg') no-repeat; background-size:cover; color:#fff;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-title"><i class="material-icons">pageview</i> <span style="position:relative; top:-5px;" id="md">Lihat Data</span></div>

                        </div>
                        <div class="modal-body">
                        <div class="table-responsive" id="view-file">
                        </div>
                        <div class="modal-footer">

                              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>
  

<?php
    require_once ($host1."/inc/assets/footer.php");
?>
    <script src="berita.js"></script>

<script type="text/javascript">

$(function () {
tinymce.init({
    selector: "textarea",
    theme: "modern",
    paste_data_images: true,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    toolbar2: "print preview media | forecolor backcolor emoticons",

    templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }, {
      title: 'Test template 2',
      content: 'Test 2'
    }]
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../inc/assets/plugins/tinymce';
});

//agar tidak terjadi konflik antaa tinyMCE dan modal
$(document).on('focusin', function(e) {
        if ($(e.target).closest(".mce-window").length) {
            e.stopImmediatePropagation();
        }
    });

$('.cek1').on('change', function(){ // fungsi ketika dicentang ceklis ubah foto
   if(this.checked) // jika di centang
    {
        $("#foto").show(); // tampilkan field foto  
        $("#ceklis").val('1'); // ubah value textbox ceklis menjadi 1
    }else{
        $("#foto").hide(); // jika tidak tercentang sembunyikan field foto
        $("#ceklis").val('0'); //uah value textbox ceklis menjadi 0
          
    }
});

        $("#viewfile1").click(function(){ // Ketika tombol view di klik
            var idview = $(this).attr('id'); //ubah title modal view file
            var data1 = $('#'+idview).attr('data-judul'); //ambil data nama file dari atribut data-file
            var data2 = $('#'+idview).attr('data-foto'); //ambil data nama file dari atribut data-file
            $("#md").html('Foto Berita - '+data1+ ' ('+data2+')'); //ubah title modal view file

                var vf = '<img src="file_berita/'+ data2 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar

            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
        });

//fungsi agar scrolling multiple modal tetap ada
$("#modal-file").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});
</script>