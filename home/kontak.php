<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
$sql = $con->prepare("SELECT * FROM kontak");
$sql->execute();
$d = $sql->fetch();
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" style="font-size:14px;">
                            <h1 class="title">Kontak Kami</h1>
                            <p>Hubungi kami untuk info lebih lanjut</p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#action-->
<div class="col-md-1">
</div>
<div class="col-md-7">
    <section id="map-section">
            <div id="gmap"></div>
    </section>
</div>

<div class="col-md-3">
                <div class="contact-info">
                <h2>Kontak</h2>
                <address>
                E-mail: <a href="mailto:<?php echo $d['email']; ?>"><?php echo $d['email']; ?></a> <br> 
                Telepon: <?php echo $d['no_telp']; ?> <br> 
                <!--Fax: <?php echo $d['fax']; ?> <br> -->
                </address>

                <h2>Alamat</h2>
                <address>
                <?php echo $d['alamat']; ?> 
                </address>
                </div>
</div>
<div class="col-md-1">
</div>
<?php
require_once ($host1."/home/footer.php");
?>  
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiO7j20oWvF1aVujUPpjb7LvmSmebSZEk"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
