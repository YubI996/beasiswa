<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/inc/koneksi.php");

$id_berita = $_GET['b'];


if (@$_COOKIE['bacaBerita'][$id_berita] != '1') {
    $qb = $con->prepare("UPDATE berita SET baca = (baca + 1) WHERE id_berita='$id_berita'");
    $qb->execute();
    setcookie('bacaBerita['.$id_berita.']', '1', strtotime('+1 year'), '/');
}
require_once ($host1."/home/header.php");


$no = 0;
                        $sqlb = $con->prepare("SELECT b.*, u.nama_user FROM berita b, user u WHERE b.author=u.id_user AND id_berita='$id_berita'");
                        $sqlb->execute();
                        $db = $sqlb->fetch();

                            $pecah = explode(" ", $db['waktu_upload']);

                            $tgl=date_format(date_create($pecah[0]), "d-M-Y");
                            $waktu=date_format(date_create($db['waktu_upload']), "d-M-Y H:i:s");
                            $pecah1 = explode("-", $tgl);

                    ?>
      <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" >
                            <h1 class="title">What's going on in Bontang?</h1>
                            <p>Berita Seputar Kota Bontang </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#page-breadcrumb-->

  <section id="blog-details" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                            <div class="single-blog blog-details two-column">
                                <div class="post-thumb">
                                    <a href="#"><img src="../user/master/file_berita/<?php echo $db['foto']; ?>" class="img-responsive" alt=""></a>
                                    <div class="post-overlay">
                                        <span class="uppercase"><a href="#"><?php echo $pecah1[0]; ?> <br><small><?php echo $pecah1[1]; ?></small></a></span>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><?php echo $db['judul']; ?></h2>
                                    <h3 class="post-author"><a>Diposting oleh <?php echo $db['nama_user']. ' pada '. tglWaktu($db['waktu_upload']); ?></a></h3>
                                    <p style="text-align:justify;">
                                    <?php
                                        echo $db['isi_berita'];
                                    ?></p>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a><i class="fa fa-tag"></i>Berita</a></li>
                                            <li><a class="sukaib" style="cursor: pointer;" data-sk="sukab<?php echo $no; ?>" data-id="<?php echo $db['id_berita']; ?>"><i class="fa fa-thumbs-up"></i><span id="sukab<?php echo $no; ?>"></span><?php echo $db['suka']; ?> Suka</a></li>
                                            <li><a><i class="fa fa-eye"></i><?php echo $db['baca']; ?> kali dibaca</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>







                  <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item  recent">
                            <h3>Kalender</h3>
                            <?php
                            include_once ("calendar/calendar.php");
                            ?>
                        </div>
                        <div class="sidebar-item  recent">
                            <h3>Digital Clock</h3>
                            <?php
                            include_once ("calendar/clock.php");
                            ?>
                        </div>
                        <div class="sidebar-item  recent">
                            <h3>Berita Terbaru</h3>
                            <?php
                                $sqlb = $con->prepare("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 6");
                                $sqlb->execute();
                                while($dbt = $sqlb->fetch()){
                            ?>
                            <div class="media">
                                <div class="pull-left image-cropper1">
                                    <a href="detail.php?hal=detail&b=<?php echo $dbt['id_berita']; ?>"><img src="../user/master/file_berita/<?php echo $dbt['foto']; ?>" alt="" class="rectangle1"></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="detail.php?hal=detail&b=<?php echo $dbt['id_berita']; ?>"><?php echo $dbt['judul']; ?></a></h4>
                                    <p><a>Diposting pada <?php echo tglWaktu($dbt['waktu_upload']); ?></p>
                                </div>
                            </div>
                            <?php
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
require_once ($host1."/home/footer.php");
?>