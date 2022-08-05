<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
$sql = $con->prepare("SELECT * FROM persyaratan WHERE tampil='1'");
$sql->execute();
$d = $sql->fetch();
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" >
                            <h1 class="title">Persyaratan</h1>
                            <p>Persyaratan permohonan beasiswa prestasi dan tugas akhir program Diploma dan Sarjana </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#page-breadcrumb-->
        <section id="company-information" class="choose">
        <div class="container">
                <div class="col-sm-12 padding-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0ms">
                    <h2><?php echo $d['keterangan']; ?></h2>

                    <div id="persyaratan">    

                        <?php
                            echo $d['persyaratan'];
                        ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
<?php
require_once ($host1."/home/footer.php");
?>    <!--/#company-information-->
<script type="text/javascript">

    var ul = document.querySelectorAll("#persyaratan > ul");
    var i, j;

    for (i = 0; i < ul.length; i++) {
        ul[i].setAttribute("class", "elements");
        ul[i].setAttribute("id", "ul-"+(i+1));
    }

    for (i = 0; i < ul.length; i++) {
    var li = document.getElementById("ul-"+(i+1)).querySelectorAll("li");
    var x = li.length+1;
        for (j = 0; j < li.length; j++) {
            x--;
            var wd = (x*100) + "ms";
            var dd = ((j+1)*100) + "ms";
            li[j].setAttribute("class", "wow fadeInUp");
            li[j].setAttribute("data-wow-duration", wd);
            li[j].setAttribute("data-wow-delay", dd);
        }
    }

</script>
