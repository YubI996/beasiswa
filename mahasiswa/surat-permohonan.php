<?php
if (!isset($_SESSION)) {
    session_start();
}
$host1 = $_SERVER['DOCUMENT_ROOT']; 
require_once ($host1."/inc/koneksi.php");
include_once ($host1."/inc/security/cek-mahasiswa.php");
include_once ($host1."/inc/mpdf/mpdf.php");

        $periodeL = $_GET['periode'];
        $kategori = $_GET['kategori'];
        

       $sql = $con->query("SELECT m.*, u.since FROM mahasiswa m, user u WHERE m.id_user=u.id_user AND m.id_user='$_SESSION[id]'");
       $d = $sql->fetch();

        if ($_GET['kertas'] == 'custom') {
            //if ($_GET['layout'] == 'P') {
                $kertas = array($_GET['lebar'], $_GET['tinggi']);
            //}else{
            //    $kertas = array($_GET['tinggi'], $_GET['lebar']);
            //}
        }else{
            $kertas = 'A4-P';
        }

            $judul = 'Surat Permohonan Beasiswa';

            $nama_file = 'Surat Permohonan Beasiswa';

            $since = tglWaktu1($d['since']);
            $tglx = date('d/m/Y', strtotime($since));
            $region = ($d['daerah'] == 'KALIMANTAN TIMUR' ? 'D' : 'L');

            if ($_GET['ktg'] == 'pr') {
                $kategori = 'Prestasi';
                $row = '
                        <tr>
                            <td colspan="2">Semester</td>
                            <td colspan="3">: ....................</td> 
                        </tr>
                        <tr>
                            <td colspan="2">Indeks Prestasi (IP) KHS</td>
                            <td colspan="3">: ....................</td> 
                        </tr> ';
                $syarat = '
                        <tr>
                            <td>1.</td>
                            <td colspan="4">Surat keterangan Aktif Kuliah yang terbaru dari perguruan tinggi (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td colspan="4"> Fotokopi Kartu Hasil Studi (KHS) satu semester terakhir sebelum pengajuan permohonan yang telah di legalisir oleh pihak Perguruan Tinggi (melampilrkan yang asli) </td> 
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td colspan="4"> Surat Pernyataan bukan sebagai PNS / CPNS / Karyawan Perusahaan BUMN / BUMD / Perusahaan Swasta (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td colspan="4"> Surat Pernyataan tidak dalam keadaan menerima / akan menerima beasiswa dari lembaga manapun pada tahun 2019 yang diketahui oleh pihak Perguruan Tinggi (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td colspan="4"> Fotokopi Kartu Tanda Mahasiswa (KTM) yang masih berlaku dan telah dilegalisir oleh pihak Perguruan Tinggi </td> 
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td colspan="4"> Fotokopi Kartu Tanda Penduduk (KTP) yang masih berlaku dan telah dilegalisir oleh pejabat yang berwenang (melampirkan yang asli) </td> 
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td colspan="4"> Fotokopi Kartu Keluarga (KK) yang masih berlaku dan telah dilegalisir oleh pejabat yang berwenang (melampirkan yang asli) </td> 
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td colspan="4"> Surat Keterangan Domisili dari Kelurahan / Kecamatan setempat (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td colspan="4"> Surat pernyataan tidak menggunakan narkoba dari instansi yang berwenang mengeluarkan (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td colspan="4"> Sertifikat / Piagam Prestasi Akademik dan Non Akademik jika ada </td> 
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td colspan="4"> Fotokopi buku rekening tabungan bank atas nama pemohon (LEGALISIR BANK) </td> 
                        </tr>
                        <tr>
                            <td>12.</td>
                            <td colspan="4"> Fotokopi ijazah pendidikan SD/SMP/SMA yang pernah di tempuh di daerah yang di legalisir </td> 
                        </tr> 
                        <tr>
                            <td>13.</td>
                            <td colspan="4"> Fotokopi ijazah pendidikan dijenjang sebelumnya (Khusus S2) </td> 
                        </tr>

                ';


            }elseif ($_GET['ktg'] == 'ta') {
                $kategori = 'Tugas Akhir';
                $row = '
                        <tr>
                            <td colspan="2">Semester</td>
                            <td colspan="3">: ....................</td> 
                        </tr>
                        <tr>
                            <td colspan="2">Indeks Prestasi Kumulatif (IPK) </td>
                            <td colspan="3">: ....................</td> 
                        </tr> ';
                $syarat = '
                        <tr>
                            <td>1.</td>
                            <td colspan="4">Surat keterangan Aktif Kuliah yang terbaru dari perguruan tinggi (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td colspan="4">Melampirkan Proposal / Laporan /Skripsi penelitian yang telah disetujui oleh pembimbing   </td> 
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td colspan="4">Surat Keterangan melaksanakan Program TA dimaksud yang diketahui oleh perguruan tinggi </td> 
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td colspan="4">Fotokopi Transkrip nilai /IPK sementara yang telah dilegalisir oleh Pihak Perguruan Tinggi</td> 
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td colspan="4">Surat Pernyataan tidak dalam keadaan menerima / akan menerima beasiswa dari lembaga manapun pada tahun 2019 yang diketahui oleh pihak Perguruan Tinggi (ASLI)</td> 
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td colspan="4"> Surat Pernyataan bukan sebagai PNS / CPNS / Karyawan Perusahaan BUMN / BUMD / Perusahaan Swasta (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td colspan="4">Fotokopi Kartu Tanda Mahasiswa (KTM) yang masih berlaku dan telah dilegalisir oleh pihak Perguruan Tinggi</td> 
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td colspan="4">Fotokopi Kartu Tanda Penduduk (KTP) yang masih berlaku dan telah dilegalisir oleh  pejabat yang berwenang (melampirkan yang asli)</td> 
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td colspan="4">Fotokopi Kartu Keluarga (KK) yang masih berlaku dan telah dilegalisir oleh pejabat yang berwenang (melampirkan yang asli)</td> 
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td colspan="4">Surat Keterngan Domisili dari Kelurahan / Kecamatan setempat (ASLI)  </td> 
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td colspan="4">Surat pernyataan tidak menggunakan narkoba dari instansi yang berwenang mengeluarkan</td> 
                        </tr>
                        <tr>
                            <td>12.</td>
                            <td colspan="4">. Sertifikat / Piagam Prestasi Akademik dan Non Akademik jika ada  </td> 
                        </tr> 
                        <tr>
                            <td>13.</td>
                            <td colspan="4">Fotokopi buku rekening tabungan atas nama pemohon (LEGALISIR BANK) </td> 
                        </tr>
                        <tr>
                            <td>14.</td>
                            <td colspan="4">Fotokopi ijazah pendidikan SD/SMP/SMA yang pernah di tempuh di daerah yang di legalisir</td> 
                        </tr>
                        <tr>
                            <td>15.</td>
                            <td colspan="4">Fotokopi ijazah pendidikan dijenjang sebelumnya (Khusus S2)</td> 
                        </tr>

                ';


            }else{
                $kategori = 'Coass';
                $row = '
                        <tr>
                            <td colspan="2">Semester</td>
                            <td colspan="3">: ....................</td> 
                        </tr>
                        <tr>
                            <td colspan="2">Indeks Prestasi Kumulatif (IPK) </td>
                            <td colspan="3">: ....................</td> 
                        </tr> ';
                $syarat = '
                        <tr>
                            <td>1.</td>
                            <td colspan="4">Surat keterangan Aktif Kuliah yang terbaru dari perguruan tinggi (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td colspan="4">Surat Keterangan COASS dari instansi/lembaga tempat COAS 
                             </td> 
                        </tr> 
                        <tr>
                            <td>3.</td>
                            <td colspan="4">Fotokopi Transkrip nilai /IPK sementara yang telah dilegalisir oleh Pihak Perguruan Tinggi</td> 
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td colspan="4">Surat Pernyataan tidak dalam keadaan menerima / akan menerima beasiswa dari lembaga manapun pada tahun 2019 yang diketahui oleh pihak Perguruan Tinggi (ASLI)</td> 
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td colspan="4"> Surat Pernyataan bukan sebagai PNS / CPNS / Karyawan Perusahaan BUMN / BUMD / Perusahaan Swasta (ASLI) </td> 
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td colspan="4">Fotokopi Kartu Tanda Mahasiswa (KTM) yang masih berlaku dan telah dilegalisir oleh pihak Perguruan Tinggi</td> 
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td colspan="4">Fotokopi Kartu Tanda Penduduk (KTP) yang masih berlaku dan telah dilegalisir oleh  pejabat yang berwenang (melampirkan yang asli)</td> 
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td colspan="4">Fotokopi Kartu Keluarga (KK) yang masih berlaku dan telah dilegalisir oleh pejabat yang berwenang (melampirkan yang asli)</td> 
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td colspan="4">Surat Keterngan Domisili dari Kelurahan / Kecamatan setempat (ASLI)  </td> 
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td colspan="4">Surat pernyataan tidak menggunakan narkoba dari instansi yang berwenang mengeluarkan</td> 
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td colspan="4">. Sertifikat / Piagam Prestasi Akademik dan Non Akademik jika ada  </td> 
                        </tr> 
                        <tr>
                            <td>12.</td>
                            <td colspan="4">Fotokopi buku rekening tabungan atas nama pemohon (LEGALISIR BANK) </td> 
                        </tr>
                        <tr>
                            <td>13.</td>
                            <td colspan="4">Fotokopi ijazah Program Sarjana yang dilegalisir oleh perguruan tinggi</td> 
                        </tr>
                        <tr>
                            <td>14.</td>
                            <td colspan="4">Fotokopi ijazah pendidikan SD/SMP/SMA yang pernah di tempuh di daerah yang di legalisir</td> 
                        </tr>
                        <tr>
                            <td>15.</td>
                            <td colspan="4">Fotokopi ijazah pendidikan dijenjang sebelumnya (Khusus S2)</td> 
                        </tr>

                ';
            }


$html .= '<div class="noreg">NO.REG : PB.'.$d['id_user'].'/'.$region.'/'.$tglx.'</div>
<table class="table1">  
    <tr>
        <th style="vertical-align:top; width:6%;"><b>Hal :</b></th>
        <th style="vertical-align:top;"><b>Permohonan Bantuan Beasiswa Program '.$kategori.'</b></th>
        <th></th>
        <th colspan="2" style="vertical-align:top;"><b>Kepada Yth : <br> Walikota Bontang <br> cq. Kabag. Sosial dan Ekonomi Setda Bontang <br> <span style="margin-left: 10px;">di-</span><br> <span style="margin-left: 20px;">Bontang</span></b></th> 
    </tr>
    <tr> 
        <td colspan="5" style="vertical-align:top; height:50px;"></td>
    </tr> 
    <tr>
        <td></td>
        <td colspan="4">Saya yang bertanda tangan dibawah ini :</td> 
    </tr>
    <tr>
        <td colspan="2" >Nama</td>
        <td colspan="3">: '.$d['nama_mahasiswa'].'</td> 
    </tr>
    <tr>
        <td colspan="2">Tempat, Tanggal Lahir</td>
        <td colspan="3">: '.$d['tempat_lahir'].', '.tanggal($d['tgl_lahir']).'</td> 
    </tr>
    <tr>
        <td colspan="2">Alamat Rumah/Kost</td>
        <td colspan="3">: '.$d['alamat_sekarang'].'</td> 
    </tr>
    <tr>
        <td colspan="2">Telp/HP</td>
        <td colspan="3">: '.$d['telp_mahasiswa'].'</td> 
    </tr>
    <tr>
        <td colspan="2">Nama Orang Tua (Ayah dan Ibu)</td>
        <td colspan="3">: '.$d['nama_ayah'].' / '.$d['nama_ibu'].'</td> 
    </tr>
    <tr>
        <td colspan="2">Alamat/Telp/HP Orang Tua</td>
        <td colspan="3">: '.$d['alamat_ortu'].'</td> 
    </tr>
    <tr>
        <td colspan="2">Univ/Akademik/Sek. Tinggi/Institut</td>
        <td colspan="3">: '.$d['perguruan_tinggi'].'</td> 
    </tr>
    <tr>
        <td colspan="2">Jurusan/Program Studi</td>
        <td colspan="3">: '.$d['jurusan'].' / '.$d['program_studi'].'</td> 
    </tr>
    '.$row.'
    <tr>
        <td colspan="2">NIM</td>
        <td colspan="3">: ....................</td> 
    </tr>
    <tr> 
        <td colspan="5" style="vertical-align:top; height:20px;"></td>
    </tr> 
    <tr> 
        <td></td>
        <td colspan="4" style="text-align:justify;">Dengan ini mengajukan permohonan bantuan Beasiswa '.$kategori.' Pemerintah Kota Bontang</td>  
    </tr>
    <tr> 
        <td colspan="5">Tahun Anggaran '.date("Y").', dan sebagai bahan pertimbangan bersama permohonan ini saya lampirkan : </td> 
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>


    '.$syarat.'


    <tr> 
        <td colspan="5" style="vertical-align:top; height:20px;"></td>
    </tr> 
    <tr>
        <td > </td> 
        <td colspan="4">Demikian permohonan ini saya sampaikan dengan harapan Bapak/Ibu dapat mempertimbangkannya.</td> 
    </tr>
    <tr>
        <td colspan="5"></td> 
    </tr>
    <tr>
        <td colspan="5"></td> 
    </tr>
    <tr>
        <td colspan="5"></td> 
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="2"> Bontang, &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '.date("Y").'<br> Pemohon, </td> 
    </tr>
    <tr> 
        <td colspan="5" style="vertical-align:top; height:80px;"></td>
    </tr> 
    <tr>
        <td colspan="3"></td>
        <td colspan="2">'.$d['nama_mahasiswa'].'<br>NIM. ..........................................</td> 
    </tr>
</table>';


$mpdf = new mPDF("utf-8", $kertas, 0, "", 20, 20, 20, 20, 1, 1, 'P');

$header = '';
 
$footer = '<table cellpadding=0 cellspacing=0 style="border:none; width:100%; font-size:10px;">
           <tr><td style="margin-right:-5px;border:none;" align="left">
           Dicetak: '.date("Y-m-d H:i").'</td>
           <td style="margin-right:-5px;border:none;text-align:right;">
           Halaman: {PAGENO} / {nb}</td></tr></table>';  


try {
    $mpdf->SetTitle($nama_file);
    //$mpdf->setHTMLHeader($header);
    //$mpdf->setHTMLFooter($footer);
    $stylesheet = file_get_contents('tabel.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html);
    $mpdf->Output($nama_file.'.pdf','I');
} catch(Exception $e) {
    echo $e;
    exit;
}?>