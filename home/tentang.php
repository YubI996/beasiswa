<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Tentang Aplikasi</h1>
                            <p>Apa itu e-Beasiswa?</p>
                        </div>
                     </div>
                </div>
            </div>
        </div>
   </section>
    <section id="company-information" class="padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                            <video width="100%" controls>
                              <source src="../inc/images/<?php echo $dk1['video']; ?>">
                              Browser Anda tidak mendukung untuk menampilkan video ini.
                            </video>                            
                </div>
                <div class="col-sm-4">
                    <p style="text-align:justify;"><?php echo $dk1['ket_video']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!--/#page-breadcrumb-->
    <section id="team">
        <div class="container">
            <div class="row">
                <h1 class="title text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="300ms">Visi & Misi Kota Bontang</h1>
                <p class="text-center wow fadeInDown" data-wow-duration="400ms" data-wow-delay="400ms">Menguatkan Kota Bontang Sebagai Kota Maritim Berkebudayaan Industri yang Bertumpu</p>
                <p class="text-center wow fadeInDown" data-wow-duration="400ms" data-wow-delay="400ms">Pada Kualitas Sumber Daya Manusia dan Lingkungan Hidup untuk Kesejahteraan Masyarakat.</p>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">
                            <img src="images/smart.png" alt="">
                        </div>
                        <h2>Smart City</h2>
                        <p>Menjadikan Kota Bontang Sebagai Smart City Melalui Peningkatan Kualitas Sumber Daya Manusia</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="600ms">
                            <img src="images/green.png" alt="">
                        </div>
                        <h2>Green City</h2>
                        <p>Menjadikan Kota Bontang Sebagai Green City Melalui Peningkatan Kualitas Lingkungan Hidup</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="900ms">
                            <img src="images/creative.png" alt="">
                        </div>
                        <h2>Creative City</h2>
                        <p>Menjadikan Kota Bontang Sebagai Creative City Melalui Pengembangan Kegiatan Perkekonomian Berbasis Sektor Maritim</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/#services-->

<?php
require_once ($host1."/home/footer.php");
?>