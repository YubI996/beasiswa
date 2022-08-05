$(document).ajaxStart(function(){
    wait('facebook', 'default', '.card', 'Loading...');
    wait('facebook', 'default', '.modal-content', 'Loading...');
});

$(document).ajaxComplete(function(){
    stopWait('.card');
    stopWait('.modal-content');
});
$(document).ajaxSuccess(function(){
    stopWait('.card');
    stopWait('.modal-content');
});
$(document).ajaxError(function(){
    stopWait('.card');
    stopWait('.modal-content');
});
//fungsi agar scrolling multiple modal tetap ada
$("#modal-file2").on('hidden.bs.modal', function (event) {
  if ($('.modal:visible').length) //check if any modal is open
  {
    $('body').addClass('modal-open');//add class to body
  }
});

//panggil fungsi datepicker
$(function () {

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });

});

//fungsi tab
function tabN2(a){
    var aN = a;
    $('#tabs12').val(aN);
    $('#tabs22').val(aN);
}


$(document).ready(function(){


            var main = "beasiswaTA-data.php"; 
            $("#view2").load(main); //tampilkan data unduhan saat halaman dibuka

        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah2, #loading-simpan2,  #pesan-validasi, .ck2, #btn-reset2").hide();
        
        $("#btn-tambah2").click(function(){ // Ketika tombol tambah diklik
            $('#btn-close').click();
            $("#btn-simpan2").html('SIMPAN'); 
            $("#fileN2").hide(); 
            $("#aks2").val('add');
            $("#tabs12").val('7');
            $("#err2").val('1');
            $("#btn-simpan2").hide(); 
            $(".ck2").hide();  
            $(".fc2").show();  
            $("#btn-next2").show();  
            $("#btn-prev2").show();  
            $("#btn-prev2").removeAttr('class');
            $("#btn-prev2").attr('disabled', '');
            $("#btn-prev2").attr('class', 'btn bg-grey waves-effect');

            // Set judul modal dialog menjadi Form Tambah Data
            $("#modal-title2").html('Form Pengajuan Beasiswa Tugas Akhir');
        });

        $("#btn-next2").click(function(){ 
            var aktif = $('#tabs12').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs12').val(next);

            if ($('#tabs12').val() == 9) {
            $("#btn-simpan2").show(); 
            $("#btn-next2").hide(); 
            }           
        });

        $("#btn-prev2").click(function(){ 
            var aktif = $('#tabs12').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs12').val(next);
            $("#btn-next2").show(); 
            $("#btn-simpan2").hide(); 
            
            if($('#tabs12').val() == 7){
                $("#btn-simpan2").hide(); 
                $("#btn-next2").show(); 
                $("#btn-prev2").removeAttr('class');
                $("#btn-prev2").attr('disabled', '');
                $("#btn-prev2").attr('class', 'btn bg-grey waves-effect');

            }
        });
        $("#btn-next12").click(function(){ 
            var aktif = $('#tabs22').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs22').val(next);

            if ($('#tabs22').val() == 11) {
            $("#btn-tutup2").show(); 
            $("#btn-next12").hide(); 
            }           
        });

        $("#btn-prev12").click(function(){ 
            var aktif = $('#tabs22').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs22').val(next);
            $("#btn-next12").show(); 
            $("#btn-tutup2").hide(); 
            
            if($('#tabs12').val() == 10){
                $("#btn-tutup2").hide(); 
                $("#btn-next12").show(); 
                $("#btn-prev12").removeAttr('class');
                $("#btn-prev12").attr('disabled', '');
                $("#btn-prev12").attr('class', 'btn bg-grey waves-effect');
            }
        });


        $("#11").click(function(){ 
                $("#btn-tutup2").show(); 
                $("#btn-next12").hide(); 
                $("#btn-prev12").removeAttr('class');
                $("#btn-prev12").removeAttr('disabled');
                $("#btn-prev12").attr('class', 'btn bg-teal waves-effect');
        });
        $("#4").click(function(){ 
                $("#btn-simpan2").show(); 
                $("#btn-next2").hide(); 
                $("#btn-prev2").removeAttr('class');
                $("#btn-prev2").removeAttr('disabled');
                $("#btn-prev2").attr('class', 'btn bg-teal waves-effect');
        });
        $("#9").click(function(){ 
                $("#fileN2").show(); 
                $("#btn-simpan2").show(); 
                $("#btn-next2").hide(); 
                $("#btn-prev2").show(); 
                $("#btn-prev2").removeAttr('class');
                $("#btn-prev2").removeAttr('disabled');
                $("#btn-prev2").attr('class', 'btn bg-teal waves-effect');
        });
        $("#8").click(function(){ 
                $("#fileN2").show(); 
                $("#btn-simpan2").hide(); 
                $("#btn-next2").show(); 
                $("#btn-prev2").show(); 
                $("#btn-prev2").removeAttr('class');
                $("#btn-prev2").removeAttr('disabled');
                $("#btn-prev2").attr('class', 'btn bg-teal waves-effect');
        });

        $("#7").click(function(){ 
                $("#fileN2").hide(); 
                $("#btn-simpan2").hide(); 
                $("#btn-next2").show(); 
                $("#btn-prev2").removeAttr('class');
                $("#btn-prev2").attr('disabled', '');
                $("#btn-prev2").attr('class', 'btn bg-grey waves-effect');
        });
        $("#10").click(function(){ 
                $("#btn-tutup2").hide(); 
                $("#btn-next12").show(); 
                $("#btn-prev12").removeAttr('class');
                $("#btn-prev12").attr('disabled', '');
                $("#btn-prev12").attr('class', 'btn bg-grey waves-effect');
        });


function errorFocus(idFL, idtab, classFl, idpesan, pesan){
            var pe = document.querySelectorAll(classFl);
                $("#ultabs2").removeAttr('class');
                $("#ultabs2").attr('class', 'nav nav-tabs tab-nav-right tab-col-red');
                $("#"+idtab).click();
                pe[idFL].classList.add("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idFL, classFl, idpesan){
                var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.remove("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
                if ($("#err2").val() != 0) {
                    $("#ultabs2").removeAttr('class');
                    $("#ultabs2").attr('class', 'nav nav-tabs tab-nav-right');
                }
}


    function CheckExtension(file) {
        /*global document: false */
        var validFilesTypes = ["pdf"];
        var filePath = file;
        var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
        var isValidFile = false;

        for (var i = 0; i < validFilesTypes.length; i++) {
            if (ext == validFilesTypes[i]) {
                isValidFile = true;
                break;
            }
        }
        return isValidFile;
    }
    function validateFileSize(e) {
                /*global document: false */
                var file = e;
                var isValidFile = false;
                if (e !== 0 && e <= 1572864) {
                    isValidFile = true;
                }
                return isValidFile;
    }
$('.fc2').on('change', function(){ // on change of state
            var no = $(this).attr('data-no');
            var vn = $(this).attr('data-v');
            var id = $(this).attr('id');
            var tab = $('#tabs12').val();
                if(CheckExtension($('#'+id)[0].files[0].name) == true){  //cek tipe file  
                    if (validateFileSize($('#'+id)[0].files[0].size) == false) { //cek ukuran file 
                        errorFocus(no, tab, '.frr', vn, 'Ukuran File melebihi Batas, Maks. 1Mb');
                        return false;
                    }else{
                        errorClear(no, '.frr', vn);                        
                    }
                }else{
                            $('#err2').val('0');                            
                            $("#btn-simpan2").attr('disabled', '');
                        errorFocus(no, tab, '.frr', vn, 'Tipe File tidak didukung');
                        return false; 
                }

                            if ($(".vdt2").text() != "" && $("#err2").val() == 1) {
                                $('#err2').val('0');                            
                                    $("#btn-simpan2").attr('disabled', '');
                            }else if($(".vdt2").text() != "" && $("#err2").val() == 0){
                                $('#err2').val('0');                                                        
                                    $("#btn-simpan2").attr('disabled', '');
                            }else{
                                $('#err2').val('1');                                                                                    
                                $("#btn-simpan2").removeAttr('disabled');                    
                            }

                if ($("#err2").val() < 1) {
                    $("#btn-simpan2").attr('disabled', '');
                }else{
                    $("#btn-simpan2").removeAttr('disabled');                    
                }

});


            var re1 = /^[0-9]+$/;
            var re2 = /^[0-9]{1}([.][0-9]{3})+$/;
            var re3 = /^[0-9]{1,2}$/;

            $('#semester2').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(0, 7, '.fr2', 'vv4', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(0, '.fr2', 'vv4');
                }
                if ($(this).val() > 14) {
                    errorFocus(0, 7, '.fr2', 'vv4', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                    return false;
                }else{
                    errorClear(0, '.fr2', 'vv4');
                }
                if (!$(this).val().match(re3)) {
                    errorFocus(0, 7, '.fr2', 'vv4', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                    return false;
                }else{
                    errorClear(0, '.fr2', 'vv4');
                }
            })
            $('#ipk2').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(1, 7, '.fr2', 'vv5', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(1, '.fr2', 'vv5');
                }
                if ($(this).val() > 4) {
                    errorFocus(1, 7, '.fr2', 'vv5', 'IPK Maksimal adalah 4.000');
                    return false;
                }else{
                    errorClear(1, '.fr2', 'vv5');
                }
                if (!$(this).val().match(re2)) {
                    errorFocus(1, 7, '.fr2', 'vv5', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                    return false;
                }else{
                    errorClear(1, '.fr2', 'vv5');
                }
            });

        $("#btn-simpan2").click(function(){ // Ketika tombol simpan di klik

            var no = document.getElementById("no2").value; 
            var id_bta = document.getElementById("id_bta").value; 
            var periode = $("#periode2").attr('placeholder');  
            var tgl = $("#tgl2").attr('placeholder'); 
            var semester = document.getElementById("semester2").value; 
            var ipk = document.getElementById("ipk2").value; 
            var suratP = document.getElementById("suratP2").value; 
            var propPN1 = document.getElementById("propPN12").value; 
            var propPN2 = document.getElementById("propPN22").value; 
            var suratTA = document.getElementById("suratTA2").value; 
            var suratPN = document.getElementById("suratPN2").value; 
            var suratAK = document.getElementById("suratAK2").value; 
            var khs = document.getElementById("khs2").value; 
            var suratK = document.getElementById("suratK2").value; 
            var suratB = document.getElementById("suratB2").value; 
            var ktm = document.getElementById("ktm2").value; 
            var ktp = document.getElementById("ktp2").value; 
            //var akta = document.getElementById("akta2").value; 
            var kk = document.getElementById("kk2").value; 
            var domisili = document.getElementById("domisili2").value; 
            var suratN = document.getElementById("suratN2").value; 
            var sertifikat1 = document.getElementById("sertifikat12").value; 
            var sertifikat2 = document.getElementById("sertifikat22").value; 
            var sertifikat3 = document.getElementById("sertifikat32").value; 
            var burek = document.getElementById("burek2").value; 
            var ijazah1 = document.getElementById("ijazah12").value; 
            var ijazah2 = document.getElementById("ijazah22").value; 
            var aks = document.getElementById("aks2").value; 
            
            if (semester == "") {
                errorFocus(0, 7, '.fr2', 'vv4', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr2', 'vv4');
            
            }
            if (!semester.match(re3)) {
                errorFocus(0, 7, '.fr2', 'vv4', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                return false;
            }else{
                errorClear(0, '.fr2', 'vv4');
            }
            if (semester > 14) {
                errorFocus(0, 7, '.fr2', 'vv4', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                return false;
            }else{
                errorClear(0, '.fr2', 'vv4');
            }            
            if (ipk == "") {
                errorFocus(1, 7, '.fr2', 'vv5', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr2', 'vv5');
            }
            if (ipk > 4) {
                errorFocus(1, 7, '.fr2', 'vv5', 'IPK Maksimal adalah 4.000');
                return false;
            }else{
                errorClear(1, '.fr2', 'vv5');
            }                        
            if (!ipk.match(re2)) {
                errorFocus(1, 7, '.fr2', 'vv5', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                return false;
            }else{
                errorClear(1, '.fr2', 'vv5');
            }

            if ((aks == 'edt' && $("#cSP2").is(':checked') && suratP == "") || (aks == 'add' && suratP == "")) {
                errorFocus(0, 8, '.frr', 'vv6', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.frr', 'vv6');        
            }

            if ((aks == 'edt' && $("#cAK2").is(':checked') && suratAK == "") || (aks == 'add' && suratAK == "")) {
                errorFocus(1, 8, '.frr', 'vv7', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.frr', 'vv7');
            }
            if ((aks == 'edt' && $("#cSPN2").is(':checked') && suratPN == "") || (aks == 'add' && suratPN == "")) {
                errorFocus(2, 8, '.frr', 'vv71', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.frr', 'vv71');
            }
            if ((aks == 'edt' && $("#cPR12").is(':checked') && propPN1 == "") || (aks == 'add' && propPN1 == "")) {
                errorFocus(3, 8, '.frr', 'vv72', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.frr', 'vv72');
            }
            if ((aks == 'edt' && $("#cPR22").is(':checked') && propPN2 == "") || (aks == 'add' && propPN2 == "")) {
                errorFocus(4, 8, '.frr', 'vv73', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.frr', 'vv73');
            }
            if ((aks == 'edt' && $("#cSTA2").is(':checked') && suratTA == "") || (aks == 'add' && suratTA == "")) {
                errorFocus(5, 8, '.frr', 'vv74', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(5, '.frr', 'vv74');
            }
            if ((aks == 'edt' && $("#cKhs2").is(':checked') && khs == "") || (aks == 'add' && khs == "")) {
                errorFocus(6, 8, '.frr', 'vv8', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.frr', 'vv8');
            }
            if ((aks == 'edt' && $("#cSK2").is(':checked') && suratK == "") || (aks == 'add' && suratK == "")) {
                errorFocus(7, 8, '.frr', 'vv9', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(7, '.frr', 'vv9');
            }
            // if ((aks == 'edt' && $("#cSB2").is(':checked') && suratB == "") || (aks == 'add' && suratB == "")) {
            //     errorFocus(8, 8, '.frr', 'vv10', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(8, '.frr', 'vv10');
            // }
            if ((aks == 'edt' && $("#cKtm2").is(':checked') && ktm == "") || (aks == 'add' && ktm == "")) {
                errorFocus(9, 8, '.frr', 'vv11', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(9, '.frr', 'vv11');
            }
            /*if ((aks == 'edt' && $("#cAkta2").is(':checked') && akta == "") || (aks == 'add' && akta == "")) {
                errorFocus(10, 9, '.frr', 'vv12', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.frr', 'vv12');
            }*/
            if ((aks == 'edt' && $("#cKk2").is(':checked') && kk == "") || (aks == 'add' && kk == "")) {
                errorFocus(10, 9, '.frr', 'vv14', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.frr', 'vv14');
            }
            if ((aks == 'edt' && $("#cKtp2").is(':checked') && ktp == "") || (aks == 'add' && ktp == "")) {
                errorFocus(11, 9, '.frr', 'vv13', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(11, '.frr', 'vv13');
            }
            if ((aks == 'edt' && $("#cDom2").is(':checked') && domisili == "") || (aks == 'add' && domisili == "")) {
                errorFocus(12, 9, '.frr', 'vv15', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(12, '.frr', 'vv15');
            }
            // if ((aks == 'edt' && $("#cSN2").is(':checked') && suratN == "") || (aks == 'add' && suratN == "")) {
            //     errorFocus(13, 9, '.frr', 'vv16', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(13, '.frr', 'vv16');
            // }
            if (aks == 'edt' && $("#cS12").is(':checked') && sertifikat1 == "") {
                errorFocus(14, 9, '.frr', 'vv17', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(14, '.frr', 'vv17');
            }
            if (aks == 'edt' && $("#cS22").is(':checked') && sertifikat2 == "") {
                errorFocus(15, 9, '.frr', 'vv18', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(15, '.frr', 'vv18');
            }
            if (aks == 'edt' && $("#cS32").is(':checked') && sertifikat3 == "") {
                errorFocus(16, 9, '.frr', 'vv19', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(16, '.frr', 'vv19');
            }
            if ((aks == 'edt' && $("#cBR2").is(':checked') && burek == "") || (aks == 'add' && burek == "")) {
                errorFocus(17, 9, '.frr', 'vv20', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(17, '.frr', 'vv20');
            }
            if ((aks == 'edt' && $("#cIjz12").is(':checked') && ijazah1 == "") || (aks == 'add' && ijazah1 == "")) {
                errorFocus(18, 9, '.frr', 'vv21', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(18, '.frr', 'vv21');
            }
            if (aks == 'edt' && $("#cIjz22").is(':checked') && ijazah2 == "") {
                errorFocus(19, 9, '.frr', 'vv22', 'Field tidak boleh kosong');
                return false;
            }else{
                    errorClear(19, '.frr', 'vv22');

           //jika lolos validasi lanjut ke proses simpan data

            // Buat variabel data untuk menampung data hasil input dari form
                    var data = new FormData();
                    data.append('id_bta', id_bta); 
                    data.append('periode', periode); 
                    data.append('tgl', tgl); 
                    data.append('semester', $("#semester2").val()); 
                    data.append('ipk', ipk); 
                    data.append('suratP', $("#suratP2")[0].files[0]); 
                    data.append('suratAK', $("#suratAK2")[0].files[0]); 
                    data.append('suratPN', $("#suratPN2")[0].files[0]); 
                    data.append('propPN1', $("#propPN12")[0].files[0]); 
                    data.append('propPN2', $("#propPN22")[0].files[0]); 
                    data.append('suratTA', $("#suratTA2")[0].files[0]); 
                    data.append('khs', $("#khs2")[0].files[0]); 
                    data.append('suratK', $("#suratK2")[0].files[0]); 
                    data.append('suratB', $("#suratB2")[0].files[0]); 
                    data.append('ktm', $("#ktm2")[0].files[0]); 
                    data.append('ktp', $("#ktp2")[0].files[0]); 
                    //data.append('akta', $("#akta2")[0].files[0]); 
                    data.append('kk', $("#kk2")[0].files[0]); 
                    data.append('domisili', $("#domisili2")[0].files[0]); 
                    data.append('suratN', $("#suratN2")[0].files[0]); 
                    data.append('sertifikat1', $("#sertifikat12")[0].files[0]); 
                    data.append('sertifikat2', $("#sertifikat22")[0].files[0]); 
                    data.append('sertifikat3', $("#sertifikat32")[0].files[0]); 
                    data.append('burek', $("#burek2")[0].files[0]); 
                    data.append('ijazah1', $("#ijazah12")[0].files[0]); 
                    data.append('ijazah2', $("#ijazah22")[0].files[0]); 
                    data.append('aksi', aks); // set data aksi = add untuk pembanding aksi                    

            //document.write(suratP);
            wait('facebook', 'default', '.modal-content', 'Loading...');
            $('.waitMe_content').append('<br><div class="progress" style="width:90%; top:0; margin-left:auto; margin-right:auto;"> <div class="progress-bar bg-cyan progress-bar-striped active" id="progressbar2" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="color:#fff;"> </div> </div>'); 
            
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            console.log('Bytes Loaded : ' + e.loaded);
                            console.log('Total Size : ' + e.total);
                            console.log('Persen : ' + (e.loaded / e.total));
                            
                            var percent = Math.round((e.loaded / e.total) * 100);
                            
                            $('div#progressbar2').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                        }
                    });
                    return xhr;
                },

                url: 'beasiswaTA-aksi.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: data, // Set data yang akan dikirim
                processData: false,
                contentType: false,
                global: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil
                    $("#loading-simpan2").hide(); // Sembunyikan loading simpan
                    
                    if(response.status == "sukses"){ // Jika Statusnya = sukses
                        
                        $("#view2").load('beasiswaTA-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil disimpan!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });     

                        //$("#1").click();
                        $("#btn-reset2").click();  
                        $("#form-modal2").modal('hide'); // Close / Tutup Modal Dialog
                    }
                    else if (response.status == "double") {
                        $("#view2").load('beasiswaTA-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'DENIED!',
                            text:  'Anda telah mengajukan Permohonan Beasiswa! \nKetentuan : 1 User 1 kali pengajuan dalam 1 Periode.',
                            type: 'error',
                            showConfirmButton: true
                        });     

                        //$("#1").click();
                        $("#btn-reset2").click();  
                        $("#form-modal2").modal('hide'); // Close / Tutup Modal Dialog

                    }else{ // Jika statusnya = gagal
                        
                        //tampilkan pesan error
                        $("#pesan-error").show();
                        document.getElementById('pesan-error').innerHTML = response.pesan;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //$("#1").click();
                        $("#btn-reset2").click();  
                        $("#form-modal2").modal('hide'); // Close / Tutup Modal Dialog
                        $("#view2").load('beasiswaTA-data.php');

                        //munculkan pesan error dengan sweetalert
                        swal({
                            title: 'Gagal!',
                            text:  'Data gagal disimpan! \nError : ' +ajaxOptions+ ' - '+thrownError,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                }
            });

            }

        });
    


        

        $('#form-modal2').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset2").click(); // Klik tombol reset agar form kembali bersih
            $('#ultabs2 a:first').tab('show');

            $("#loading-ubah2, #loading-simpan2,  #pesan-validasi, #btn-reset2").hide();

            $(".vdt2").html('');
            $("#ultabs2").removeAttr('class');
            $("#ultabs2").attr('class', 'nav nav-tabs tab-nav-right');
        });
        $('#form-file12').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $('#ultabs22 a:first').tab('show');

        });


        $(".viewfile12").click(function(){ // Ketika tombol view di klik
            var data1 = $(this).attr('data-file'); //ubah title modal view file
            $("#md12").html('Lihat File - '+data1); //ubah title modal view file

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1+'" download>'+data1+'</a><hr><img src="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file2').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file2').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1+'" download>'+data1+'</a>';
                var vf = 'http://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file2').innerHTML = vf;
            }

        });

        $(".viewfile22").click(function(){ // Ketika tombol view di klik
            var data1 = $(this).attr('data-file'); //ubah title modal view file
            $("#md2").html('Lihat File - '+data1); //ubah title modal view file

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1+'" download>'+data1+'</a><hr><img src="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file2').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file2').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1+'" download>'+data1+'</a>';
                var vf = 'http://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_ta/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file2').innerHTML = vf;
            }
        });

    });


