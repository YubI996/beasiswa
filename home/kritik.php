<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
$sql = $con->prepare("SELECT * FROM kontak");
$sql->execute();
$d = $sql->fetch();
?>

<style type="text/css">
    @media (min-width: 767px){
        .kritik{
            width:250px; height:250px; padding:10px; color:#fff; 
        }
    }
    @media (max-width: 767px){
        .kritik{
            width:100%; height:250px; padding:10px; color:#fff; 
        }
    }
</style>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" style="font-size:14px;">
                            <h1 class="title">Kritik & Saran</h1>
                            <p>Berikan kami kritik dan saran yang membangun</p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
   </section>

    <section id="company-information" class="choose">
        <div class="container">
            <div class="row">
                    <div class="col-sm-12 col-md-6 text-center wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <div class="single-features">
                        <center><img src="images/beasiswa/kritik1.png" class="img-responsive" alt=""></center>
                        <p>&nbsp;</p>
                        <p>Ayo bantu kami untuk memberikan pelayanan lebih baik lagi dengan memberikan kritik dan saran yang membangun kepada kami. Kritik dan saran Anda akan kami tampilkan untuk menjadi motivasi kami agar meningkatkan kualitas pelayanan kami. Kritik dan Saran Anda menentukan masa depan yang lebih baik lagi.</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <center><div class="contact-form">
                            <h2>Beri Kritik atau Saran</h2>
                            <form method="post" id="kritikform">
                                <div class="form-group">
                                    <input type="text" id="name1" name="name1" class="form-control" required="required" placeholder="Ketikkan nama Anda">
                                </div>
                                <div class="form-group">
                                    <input type="email" id="email1" name="email1" class="form-control" required="required" placeholder="Ketikkan email Anda">
                                </div>
                                <div class="form-group">
                                    <textarea name="message1" id="message1" required="required" class="form-control" rows="8" placeholder="Ketikkan Kritik atau Saran Anda"></textarea>
                                </div>  
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-submit1"  id="btn-simpann1"><i class="fa fa-send"></i> Kirim </button>
                                </div>
                                <button type="reset" id="resett1" style="display:none;"></button>
                            </form>
                        </div></center>
                    </div>
            </div>
        </div>
    </section>
    <!--/#company-information-->

    <section id="team" style="padding: 0;">
        <div class="container">
                <h2 class="title text-center wow fadeInDown" data-wow-duration="500ms" data-wow-delay="300ms">Kritik & Saran Terbaik Pengunjung</h2>
                <div id="team-carousel" class="carousel slide wow fadeIn" data-ride="carousel" data-wow-duration="400ms" data-wow-delay="400ms">
                    <!-- Indicators -->
                    <ol class="carousel-indicators visible-xs">
                        <li data-target="#team-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#team-carousel" data-slide-to="1"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

<?php  
    $qs = $con->prepare("SELECT * FROM kritik WHERE tampil='1' ORDER BY id_kritik DESC LIMIT 12");
    $qs->execute();

    $no = 0;
    $no1 = 0;
    while ($ds = $qs->fetch()) {
        $no++;
        if ($no >= 0 && $no <= 8) {
            $no1++;
        }else{
            $no1 = rand(1, 8);
        }

        if ($no == 1) {
            echo '<div class="item active">';
        }else{
            echo '';
        }
?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="team-single-wrapper">
                                    <div class="team-single">
                                        <div class="person-thumb text-center kritik" style="background: url('images/aboutus/<?php echo $no1; ?>.jpg') no-repeat;">
                                            <?php echo $ds['kritik']; ?>
                                        </div>
                                        <div class="social-profile">
                                            <ul class="nav nav-pills" style="color:#fff;">
                                                <li><a style="cursor: pointer;" class="sukai" data-sk="suka<?php echo $no; ?>" data-id="<?php echo $ds['id_kritik']; ?>"><i class="fa fa-thumbs-up"></i></a><span id="suka<?php echo $no; ?>"><?php echo $ds['suka']; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="person-info text-center">
                                        <h2><?php echo $ds['nama']; ?></h2>
                                        <p><?php echo tanggal($ds['tgl_kritik']); ?></p>
                                    </div>
                                </div>
                            </div>

<?php
        if ($no == 4 || $no == 8) {
            echo '</div><div class="item">';
        }else{
            echo '';
        }
    }
?>


                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left team-carousel-control hidden-xs" href="#team-carousel" data-slide="prev">left</a>
                    <a class="right team-carousel-control hidden-xs" href="#team-carousel" data-slide="next">right</a>
                </div>
            </div>
        </div>
    </section>
    <!--/#team-->

<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
require_once ($host1."/home/footer.php");
?>  
