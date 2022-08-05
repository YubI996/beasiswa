<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" >
                            <h1 class="title">Unduhan</h1>
                            <p>Unduh file </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#page-breadcrumb-->

    <section id="company-information" class="choose">
        <div class="container">
            <div class="row">
                <div class="single-features">
                    <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <img src="images/beasiswa/bgu.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2>Butuh File?</h2>
                        <P>Silakan unduh berkas yang ada disini untuk melengkapi persyaratan berkas pengajuan beasiswa atau untuk mengunduh berkas lainnya. Anda dapat menggunakan fasilitas Pencarian untuk mempermudah Anda dalam mencari berkas.</P>
                    </div>
                </div>
                <div class="col-sm-12 padding-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="form-group">
                            <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Cari File Unduhan..." id="cari">
                                  <span class="input-group-btn">
                                    <button class="btn btn-info" style="height:40px;" type="submit"><i class="fa fa-search"></i> Cari</button>
                                  </span>
                                </div><!-- /input-group -->                            
                            </div>
                    <ul class="elements">
                        <div id="list"></div>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--/#company-information-->
    <br>                <div class="col-sm-12 text-center bottom-separator">
                </div>

<?php
require_once ($host1."/home/footer.php");
?>