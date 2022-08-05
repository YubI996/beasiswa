<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
?>   
    <section id="home-slider">
        <div class="container">
            <div class="row">
                <div class="main-slider">
                    <div class="col-md-12">
                        <div class="slide-text">
                            <h1><?php echo $dk2['judul_tag_front']; ?></h1>
                            <p><?php echo $dk2['tag_front']; ?></p>
                            <a href="login-register.php" class="btn btn-common">Ayo Daftar</a>
                        </div>
                    </div>
                        <img src="images/beasiswa/sun1.png" class="slider-sun" alt="slider image">
                        <img src="images/beasiswa/awan1.png" class="slider-awan" alt="slider image">
                        <img src="images/beasiswa/hill1.png" class="slider-univ" alt="slider image">
                        <img src="images/beasiswa/cewe1.png" class="slider-cewe" alt="slider image">
                        <img src="images/beasiswa/cowo1.png" class="slider-cowo" alt="slider image">
                </div>
            </div>
        </div>
        <div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>
    </section>
    <!--/#home-slider-->
    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">

                    <div class="row">

                    <?php
                    // jumlah data yang akan ditampilkan per halaman
                $paging=3;     
                $dataPerhalaman = $paging;

                // apabila $_GET['halaman'] sudah didefinisikan, gunakan nomor halaman tersebut, 
                // sedangkan apabila belum, nomor halamannya 1.
                if(isset($_GET['halaman'])){
                    $nohalaman = $_GET['halaman'];
                }else{ 
                    $nohalaman = 1;
                }

                // perhitungan offset
                $offset = ($nohalaman - 1) * $dataPerhalaman;

                        $sql = $con->prepare("SELECT b.*, u.nama_user FROM berita b, user u WHERE b.author=u.id_user ORDER BY b.id_berita DESC LIMIT $offset, $dataPerhalaman");
                        $sql->execute();
                        $no = 0;
                        while($d = $sql->fetch()){
                            $no++;
                            $pecah = explode(" ", $d['waktu_upload']);

                            $tgl=date_format(date_create($pecah[0]), "d-M-Y");
                            $waktu=date_format(date_create($d['waktu_upload']), "d-M-Y H:i:s");
                            $pecah1 = explode("-", $tgl);

                    ?>
                         <div class="col-md-12 col-sm-12">
                            <div class="single-blog two-column">
                                <div class="post-thumb">
                                    <div class="image-cropper">
                                        <a href="detail.php?hal=detail&b=<?php echo $d['id_berita']; ?>"><img src="../user/master/file_berita/<?php echo $d['foto']; ?>" class="img-responsive rectangle" alt=""></a>
                                    </div>
                                    
                                    <div class="post-overlay">
                                        <span class="uppercase"><a href="detail.php?hal=detail&b=<?php echo $d['id_berita']; ?>"><?php echo $pecah1[0]; ?> <br><small><?php echo $pecah1[1]; ?></small></a></span>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="detail.php?hal=detail&b=<?php echo $d['id_berita']; ?>"><?php echo $d['judul']; ?></a></h2>
                                    <h3 class="post-author"><a>Diposting oleh <?php echo $d['nama_user']. ' pada '. tglWaktu($d['waktu_upload']); ?></a></h3>
                                    <?php
                                        echo batasiBerita($d['isi_berita']);
                                    ?><br>
                                    <a href="detail.php?hal=detail&b=<?php echo $d['id_berita']; ?>" class="read-more">Baca Selengkapya</a>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a><i class="fa fa-tag"></i>Berita</a></li>
                                            <li><a class="sukaib" style="cursor: pointer;" onclick="setCookie(<?php echo $d['id_berita']; ?>, 1, 90)" data-sk="sukab<?php echo $no; ?>" data-id="<?php echo $d['id_berita']; ?>"><i class="fa fa-thumbs-up"></i><span id="sukab<?php echo $no; ?>"><?php echo $d['suka']; ?></span> Suka</a></li>
                                            <li><a><i class="fa fa-eye"></i><?php echo $d['baca']; ?> kali dibaca</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    ?>

                    </div>
                    <div class="blog-pagination">
                        <ul class="pagination">

<?php
// jumlah data yang akan ditampilkan per halaman
$paging=3;     
$dataPerhalaman = $paging;
$carian="";
$cetak="";
$url_cari="";
$url_cetak="";



// apabila $_GET['halaman'] sudah didefinisikan, gunakan nomor halaman tersebut, 
// sedangkan apabila belum, nomor halamannya 1.
if(isset($_GET['halaman'])){
    $nohalaman = $_GET['halaman'];
}else{ 
    $nohalaman = 1;
}

// perhitungan offset
$offset = ($nohalaman - 1) * $dataPerhalaman;


// mencari jumlah semua data dalam tabel guestbook      
$s  = $con->prepare("SELECT COUNT(*) AS jumData  FROM berita $pencarian");
$s->execute();
$data   = $s->fetch();

$jumData = $data['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumhalaman = ceil($jumData/$dataPerhalaman);

// menampilkan link previous
if ($nohalaman > 1){
    echo '<li><a href="'.$_SERVER['PHP_SELF'].'?halaman='.($nohalaman-1). $url_carian.'">left</a></li>';
}else{
    echo '<li><a>left</a></li>';
}


// memunculkan nomor halaman dan linknya
for($halaman = 1; $halaman <= $jumhalaman; $halaman++)
{

         if ((($halaman >= $nohalaman - 3) && ($halaman <= $nohalaman + 3)) || ($halaman == 1) || ($halaman == $jumhalaman)) 
         {   
            if (($showhalaman == 1) && ($halaman != 2)){  echo "<li>...</li>";} 
            if (($showhalaman != ($jumhalaman - 1)) && ($halaman == $jumhalaman)){  echo "<li>...</li>";}
            if ($halaman == $nohalaman){ 
                echo "<li class='active'><a>".$halaman."</a></li>";
            }else{ 
                echo '<li><a href="'.$_SERVER['PHP_SELF'].'?halaman='.$halaman. $url_carian.'">'.$halaman.'</a></li>';
            }
            $showhalaman = $halaman;          
         }

}

// menampilkan link next
if ($nohalaman < $jumhalaman){
    echo '<li><a href="'.$_SERVER['PHP_SELF'].'?halaman='.($nohalaman+1). $url_carian.'">right</a></li>';
}else{
    echo '<li><a>right</a></li>';
}
?>


                        </ul>
                    </div>
                 </div>
                  <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item  recent">
                            <h3>Pengumuman Terbaru</h3>
                            <?php
                                $sqlA = $con->prepare("SELECT judul_pengumuman, isi_pengumuman FROM pengumuman WHERE tampil='1'");
                                $sqlA->execute();
                                $dA = $sqlA->fetch();
                                $n = $sqlA->rowCount();
                                if ($n > 0) {
                            ?>
                                <blockquote style="text-align: justify;border:3px dashed #f39c12;">
                                <b><u><?php echo $dA['judul_pengumuman']; ?></u></b><br>
                                <?php echo $dA['isi_pengumuman']; ?>    
                                </blockquote>
                            
                            <?php
                            }else{
                                echo '<center>Tidak ada pengumuman terbaru</center>';
                            }
                            ?>
                        </div>
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
    <!--/#blog-->
<?php
require_once ($host1."/home/footer.php");
?>