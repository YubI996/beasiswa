<?php
$host1 = $_SERVER['DOCUMENT_ROOT'];  
require_once ($host1."/home/header.php");
    $keyword = "";  
    $queryCondition = "";
    if(!empty($_POST["keyword"])) {
        $keyword = $_POST["keyword"];
        $wordsAry = explode(" ", $keyword);
        $wordsCount = count($wordsAry);
        $queryCondition1 = " WHERE ";
        $queryCondition2 = " WHERE ";
        $queryCondition3 = " WHERE ";

        for($i=0;$i<$wordsCount;$i++) {
            $queryCondition1 .= "judul LIKE '%" . $wordsAry[$i] . "%' OR isi_berita LIKE '%" . $wordsAry[$i] . "%'";
            $queryCondition2 .= "nama_file LIKE '%" . $wordsAry[$i] . "%' OR keterangan_file LIKE '%" . $wordsAry[$i] . "%'";
            $queryCondition3 .= "persyaratan LIKE '%" . $wordsAry[$i] . "%'";
            if($i!=$wordsCount-1) {
                $queryCondition1 .= " OR ";
                $queryCondition2 .= " OR ";
                $queryCondition3 .= " OR ";
            }
        }
    }

    $q1 =  "SELECT * FROM berita  " . $queryCondition1;
    $q2 =  "SELECT * FROM download  " . $queryCondition2;
    $q3 =  "SELECT * FROM persyaratan  " . $queryCondition3;

    $sql1 = $con->prepare("$q1");
    $sql1->execute();

    $sql2 = $con->prepare("$q2");
    $sql2->execute();

    $sql3 = $con->prepare("$q3");
    $sql3->execute();


    $n1 = $sql1->rowCount();
    $n2 = $sql2->rowCount();
    $n3 = $sql3->rowCount();



    function highlightKeywords($text, $keyword) {
        $wordsAry = explode(" ", $keyword);
        $wordsCount = count($wordsAry);
        
        for($i=0;$i<$wordsCount;$i++) {
            $highlighted_text = "<span style='font-weight:bold;background:#C0FBDA;'>$wordsAry[$i]</span>";
            $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
        }

        return $text;
    }



    
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12" >
                            <h1 class="title">What you looking for?</h1>
                            <p>I got this</p>
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
                <div class="col-sm-6 padding-top wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0ms">
                    <?php
                        if ($n1 == 0 && $n2 == 0 && $n3 == 0) {
                            echo '
                                <h2>Maaf kami tidak menemukan apapun dengan katakunci &quot;'.$_POST['keyword'].'&quot;</h2>
                                <p>Coba dengan katakunci yang lain</p>
                            ';
                        }else{
                    ?>
                    <h2>Pencarian dengan kata kunci &quot;<?php echo $_POST['keyword']; ?>&quot;</h2>
                    <p>Berikut adalah beberapa hal yang kami temukan dengan katakunci tersebut, apakah ini yang Anda cari?
                    </p>
                    <ul class="elements">
                        <div id="x1">
                            <?php
                                if ($n1 == 0) {
                                    $judul = '';
                                    $isi_berita = '';
                                }else{
                                        echo '<h2><u>Berita</u></h2>';
                                        while($row1 = $sql1->fetch()) { 
                                        $judul = $row1["judul"];
                                        if(!empty($_POST["keyword"])) {
                                            $judul = highlightKeywords($row1["judul"],$_POST["keyword"]);
                                        }
                                        $isi_berita = $row1["isi_berita"];
                                        if(!empty($_POST["keyword"])) {
                                            $isi_berita = highlightKeywords($row1["isi_berita"],$_POST["keyword"]);
                                        }
                                        echo '<h2 class="post-title bold"><a href="detail.php?hal=detail&b='.$row1['id_berita'].'">'.$row1['judul'].'</a></h2>'. batasiBerita($isi_berita).'<a href="detail.php?hal=detail&b='.$row1['id_berita'].'" class="read-more"> Baca Selengkapya</a> <hr>';
                                    }
                                }

                                if ($n2 == 0) {
                                    $nama_file = '';
                                    $keterangan_file = '';
                                }else{
                                        echo '<h2><u>File Unduhan</u></h2>';
                                        echo '<ul class="elements">';
                                        while($row2 = $sql2->fetch()) { 
                                        $nama_file = $row2["nama_file"];
                                        if(!empty($_POST["keyword"])) {
                                            $nama_file = highlightKeywords($row2["nama_file"],$_POST["keyword"]);
                                        }
                                        $keterangan_file = $row2["keterangan_file"];
                                        if(!empty($_POST["keyword"])) {
                                            $keterangan_file = highlightKeywords($row2["keterangan_file"],$_POST["keyword"]);
                                        }
                                        echo "<li class='wow fadeInUp'><i class='fa fa-angle-right'></i> <a href='download.php?file=".$row2['nama_file']."' style='color:#0E76BC;'>$keterangan_file - $nama_file</a></li>";
                                    } echo '</ul>';
                                }

                                if ($n3 == 0) {
                                    $persyaratan = '';
                                }else{
                                        echo '<div id="persyaratan">   <h2><u>Persyaratan Beasiswa</u></h2>';
                                        while($row3 = $sql3->fetch()) { 
                                        $persyaratan = $row3["persyaratan"];
                                        if(!empty($_POST["keyword"])) {
                                            $persyaratan = highlightKeywords($row3["persyaratan"],$_POST["keyword"]);
                                        }
                                    }
                                        echo $persyaratan . '</div>';
                                }

                            ?>
                        </div>
                    </ul> 
                    <?php 
                        } 
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!--/#company-information-->
    <br>
<?php
require_once ($host1."/home/footer.php");
?>

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
