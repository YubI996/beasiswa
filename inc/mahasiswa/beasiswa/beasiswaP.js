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
$("#modal-file1").on('hidden.bs.modal', function (event) {
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
function tabN1(a){
    var aN = a;
    $('#tabs11').val(aN);
    $('#tabs21').val(aN);
}


$(document).ready(function(){


            var main = "beasiswaP-data.php"; 
            $("#view1").load(main); //tampilkan data unduhan saat halaman dibuka 
        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset1
        $("#loading-ubah1, #loading-simpan1,  #pesan-validasi, .ck1, #btn-reset1").hide();
        
        $("#btn-tambah1").click(function(){ // Ketika tombol tambah diklik 
            $('#btn-close').click();
            $("#btn-simpan1").html('SIMPAN'); 
            $("#aks1").val('add');
            $("#tabs11").val('1');
            $("#btn-simpan1").hide(); 
            $("#fileN1").hide(); 
            $(".ck1").hide();  
            $(".fc1").show();  
            $("#btn-next1").show();  
            $("#btn-prev1").show();  
            $("#btn-prev1").removeAttr('class');
            $("#btn-prev1").attr('disabled', '');
            $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');

            // Set judul modal dialog menjadi Form Tambah Data
            $("#modal-title1").html('Form Pengajuan Beasiswa Prestasi');
        });

        $("#btn-next1").click(function(){ 
            var aktif = $('#tabs11').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs11').val(next);

            if ($('#tabs11').val() == 3) {
            $("#btn-simpan1").show(); 
            $("#btn-next1").hide(); 
            }           
        });

        $("#btn-prev1").click(function(){ 
            var aktif = $('#tabs11').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs11').val(next);
            $("#btn-next1").show(); 
            $("#btn-simpan1").hide(); 
            
            if($('#tabs11').val() == 1){
                $("#btn-simpan1").hide(); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").attr('disabled', '');
                $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');
            }

        });

        $("#btn-next11").click(function(){ 
            var aktif = $('#tabs21').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs21').val(next);

            if ($('#tabs21').val() == 6) {
            $("#btn-tutup1").show(); 
            $("#btn-next11").hide(); 
            }           
        });

        $("#btn-prev11").click(function(){ 
            var aktif = $('#tabs21').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs21').val(next);
            $("#btn-next11").show(); 
            $("#btn-tutup1").hide(); 
            
            if($('#tabs11').val() == 5){
                $("#btn-tutup1").hide(); 
                $("#btn-next11").show(); 
                $("#btn-prev11").removeAttr('class');
                $("#btn-prev11").attr('disabled', '');
                $("#btn-prev11").attr('class', 'btn bg-grey waves-effect');
            }
        });


        $("#6").click(function(){ 
                $("#btn-tutup1").show(); 
                $("#btn-next11").hide(); 
                $("#btn-prev11").removeAttr('class');
                $("#btn-prev11").removeAttr('disabled');
                $("#btn-prev11").attr('class', 'btn bg-teal waves-effect');
        });
        $("#4").click(function(){ 
                $("#btn-simpan1").show(); 
                $("#btn-next1").hide(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").removeAttr('disabled');
                $("#btn-prev1").attr('class', 'btn bg-teal waves-effect');
        });
        $("#3").click(function(){ 
                $("#btn-simpan1").show(); 
                $("#fileN1").show(); 
                $("#btn-next1").hide(); 
                $("#btn-prev1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").removeAttr('disabled');
                $("#btn-prev1").attr('class', 'btn bg-teal waves-effect');

        });
        $("#2").click(function(){ 
                $("#btn-simpan1").hide(); 
                $("#fileN1").show(); 
                $("#btn-next1").show(); 
                $("#btn-prev1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").removeAttr('disabled');
                $("#btn-prev1").attr('class', 'btn bg-teal waves-effect');

        });

        $("#1").click(function(){ 
                $("#btn-simpan1").hide(); 
                $("#fileN1").hide(); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").attr('disabled', '');
                $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');


        });
        $("#5").click(function(){ 
                $("#btn-tutup1").hide(); 
                $("#btn-next11").show(); 
                $("#btn-prev11").removeAttr('class');
                $("#btn-prev11").attr('disabled', '');
                $("#btn-prev11").attr('class', 'btn bg-grey waves-effect');
        });



function errorFocus(idFL, idtab, classFl, idpesan, pesan){
            var pe = document.querySelectorAll(classFl);
                $("#ultabs1").removeAttr('class');
                $("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right tab-col-red');
                $("#"+idtab).click();
                pe[idFL].classList.add("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idFL, classFl, idpesan){
                var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.remove("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
                $("#ultabs1").removeAttr('class');
                $("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right');
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
$('.fc1').on('change', function(){ // on change of state
            var no = $(this).attr('data-no');
            var vn = $(this).attr('data-v');
            var id = $(this).attr('id');
            var tab = $('#tabs11').val();
                if(CheckExtension($('#'+id)[0].files[0].name) == true){  //cek tipe file  
                    if (validateFileSize($('#'+id)[0].files[0].size) == false) { //cek ukuran file 
                        errorFocus(no, tab, '.fr', vn, 'Ukuran File melebihi Batas, Maks. 1Mb');
                        return false;
                    }else{
                        errorClear(no, '.fr', vn);                        
                    }
                }else{
                            $('#err1').val('0');                            
                            $("#btn-simpan1").attr('disabled', '');
                        errorFocus(no, tab, '.fr', vn, 'Tipe File tidak didukung');
                        return false; 
                }

                            if ($(".vdt1").text() != "" && $("#err1").val() == 1) {
                                $('#err1').val('0');                            
                                $("#btn-simpan1").attr('disabled', '');
                            }else if($(".vdt1").text() != "" && $("#err1").val() == 0){
                                $('#err1').val('0');                                                        
                                $("#btn-simpan1").attr('disabled', '');
                            }else{
                                $('#err1').val('1');                                                                                    
                                $("#btn-simpan1").removeAttr('disabled');                    
                            }

                if ($("#err1").val() < 1) {
                    $("#btn-simpan1").attr('disabled', '');
                }
                else{
                    $("#btn-simpan1").removeAttr('disabled');                    
                }
});




            var re1 = /^[0-9]+$/;
            var re2 = /^[0-9]{1}([.][0-9]{3})+$/;
            var re3 = /^[0-9]{1,2}$/;

            $('#semester1').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(0, 1, '.fr1', 'v4', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(0, '.fr1', 'v4');
                }
                if ($(this).val() > 14) {
                    errorFocus(0, 1, '.fr1', 'v4', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                    return false;
                }else{
                    errorClear(0, '.fr1', 'v4');
                }
                if (!$(this).val().match(re3)) {
                    errorFocus(0, 1, '.fr1', 'v4', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                    return false;
                }else{
                    errorClear(0, '.fr1', 'v4');
                }
            })
            $('#ipk1').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(1, 1, '.fr1', 'v5', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v5');
                }
                if ($(this).val() > 4) {
                    errorFocus(1, 1, '.fr1', 'v5', 'IPK Maksimal adalah 4.000');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v5');
                }
                if (!$(this).val().match(re2)) {
                    errorFocus(1, 1, '.fr1', 'v5', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v5');
                }
            });

        $("#btn-simpan1").click(function(){ // Ketika tombol simpan di klik

            var no = document.getElementById("no1").value; 
            var id_bp = document.getElementById("id_bp").value; 
            var periode = $("#periode1").attr('placeholder'); 
            var tgl = $("#tgl1").attr('placeholder'); 
            var semester = document.getElementById("semester1").value; 
            var ipk = document.getElementById("ipk1").value; 
            var suratP = document.getElementById("suratP1").value; 
            var suratAK = document.getElementById("suratAK1").value; 
            var khs = document.getElementById("khs1").value; 
            var suratK = document.getElementById("suratK1").value; 
            var suratB = document.getElementById("suratB1").value; 
            var ktm = document.getElementById("ktm1").value; 
            var ktp = document.getElementById("ktp1").value; 
            //var akta = document.getElementById("akta1").value; 
            var kk = document.getElementById("kk1").value; 
            var domisili = document.getElementById("domisili1").value; 
            var suratN = document.getElementById("suratN1").value; 
            var sertifikat1 = document.getElementById("sertifikat11").value; 
            var sertifikat2 = document.getElementById("sertifikat21").value; 
            var sertifikat3 = document.getElementById("sertifikat31").value; 
            var burek = document.getElementById("burek1").value; 
            var ijazah = document.getElementById("ijazah1").value; 
            var aks = document.getElementById("aks1").value; 
            
            if (semester == "") {
                errorFocus(0, 1, '.fr1', 'v4', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr1', 'v4');
            
            }
            if (!semester.match(re3)) {
                errorFocus(0, 1, '.fr1', 'v4', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                return false;
            }else{
                errorClear(0, '.fr1', 'v4');
            }
            if (semester > 14) {
                errorFocus(0, 1, '.fr1', 'v4', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a atau Anda terjebak kenangan mantan');
                return false;
            }else{
                errorClear(0, '.fr1', 'v4');
            }
            if (ipk == "") {
                errorFocus(1, 1, '.fr1', 'v5', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr1', 'v5');
            }
            if (ipk > 4) {
                errorFocus(1, 1, '.fr1', 'v5', 'IPK Maksimal adalah 4.000');
                return false;
            }else{
                errorClear(1, '.fr1', 'v5');
            }
            if (!ipk.match(re2)) {
                errorFocus(1, 1, '.fr1', 'v5', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                return false;
            }else{
                errorClear(1, '.fr1', 'v5');
            }
            if ((aks == 'edt' && $("#cSP1").is(':checked') && suratP == "") || (aks == 'add' && suratP == "")) {
                errorFocus(0, 2, '.fr', 'v6', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr', 'v6');        
            }

            if ((aks == 'edt' && $("#cAK1").is(':checked') && suratAK == "") || (aks == 'add' && suratAK == "")) {
                errorFocus(1, 2, '.fr', 'v7', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr', 'v7');
            }
            if ((aks == 'edt' && $("#cKhs1").is(':checked') && khs == "") || (aks == 'add' && khs == "")) {
                errorFocus(2, 2, '.fr', 'v8', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr', 'v8');
            }
            if ((aks == 'edt' && $("#cSK1").is(':checked') && suratK == "") || (aks == 'add' && suratK == "")) {
                errorFocus(3, 2, '.fr', 'v9', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.fr', 'v9');
            }
            // if ((aks == 'edt' && $("#cSB1").is(':checked') && suratB == "") || (aks == 'add' && suratB == "")) {
            //     errorFocus(4, 2, '.fr', 'v10', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(4, '.fr', 'v10');
            // }
            if ((aks == 'edt' && $("#cKtm1").is(':checked') && ktm == "") || (aks == 'add' && ktm == "")) {
                errorFocus(5, 2, '.fr', 'v11', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(5, '.fr', 'v11');
            }
            /*if ((aks == 'edt' && $("#cAkta1").is(':checked') && akta == "") || (aks == 'add' && akta == "")) {
                errorFocus(6, 2, '.fr', 'v12', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.fr', 'v12');
            }*/
            if ((aks == 'edt' && $("#cKk1").is(':checked') && kk == "") || (aks == 'add' && kk == "")) {
                errorFocus(6, 3, '.fr', 'v14', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.fr', 'v14');
            }
            if ((aks == 'edt' && $("#cKtp1").is(':checked') && ktp == "") || (aks == 'add' && ktp == "")) {
                errorFocus(7, 2, '.fr', 'v13', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(7, '.fr', 'v13');
            }
            if ((aks == 'edt' && $("#cDom1").is(':checked') && domisili == "") || (aks == 'add' && domisili == "")) {
                errorFocus(8, 3, '.fr', 'v15', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(8, '.fr', 'v15');
            }
            // if ((aks == 'edt' && $("#cSN1").is(':checked') && suratN == "") || (aks == 'add' && suratN == "")) {
            //     errorFocus(9, 3, '.fr', 'v16', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(9, '.fr', 'v16');
            // }
            if (aks == 'edt' && $("#cS11").is(':checked') && sertifikat1 == "") {
                errorFocus(10, 3, '.fr', 'v17', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.fr', 'v17');
            }
            if (aks == 'edt' && $("#cS21").is(':checked') && sertifikat2 == "") {
                errorFocus(11, 3, '.fr', 'v18', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(11, '.fr', 'v18');
            }
            if (aks == 'edt' && $("#cS31").is(':checked') && sertifikat3 == "") {
                errorFocus(12, 3, '.fr', 'v19', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(12, '.fr', 'v19');
            }
            if ((aks == 'edt' && $("#cBR1").is(':checked') && burek == "") || (aks == 'add' && burek == "")) {
                errorFocus(13, 3, '.fr', 'v20', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(13, '.fr', 'v20');
            }
            if ((aks == 'edt' && $("#cIjz1").is(':checked') && ijazah == "") || (aks == 'add' && ijazah == "")) {
                errorFocus(14, 3, '.fr', 'v21', 'Field tidak boleh kosong');
                return false;
            }else{
                    errorClear(14, '.fr', 'v21');
//*/
            //jika lolos validasi lanjut ke proses simpan data

            // Buat variabel data untuk menampung data hasil input dari form
            if (aks == 'edt') { //jika aksinya edt
                    var data = new FormData();
                    data.append('id_bp', id_bp); 
                    data.append('periode', periode); 
                    data.append('tgl', tgl); 
                    data.append('semester', semester); 
                    data.append('ipk', ipk); 
                    if ($('#suratP1').get(0).files.length !== 0) {
                    data.append('suratP', $("#suratP1")[0].files[0]);                 
                    }else{
                    data.append('suratP', $("#suratP1-value-" + no).val());
                    }
                    if ($('#suratAK1').get(0).files.length !== 0) {
                    data.append('suratAK', $("#suratAK1")[0].files[0]);                 
                    }else{
                    data.append('suratAK', $("#suratAK1-value-" + no).val());
                    } 
                    if ($('#khs1').get(0).files.length !== 0) {
                    data.append('khs', $("#khs1")[0].files[0]);                 
                    }else{
                    data.append('khs', $("#khs1-value-" + no).val());
                    } 
                    if ($('#suratK1').get(0).files.length !== 0) {
                    data.append('suratK', $("#suratK1")[0].files[0]);                 
                    }else{
                    data.append('suratK', $("#suratK1-value-" + no).val());
                    } 
                    if ($('#suratB1').get(0).files.length !== 0) {
                    data.append('suratB', $("#suratB1")[0].files[0]);                 
                    }else{
                    data.append('suratB', $("#suratB1-value-" + no).val());
                    } 
                    if ($('#ktm1').get(0).files.length !== 0) {
                    data.append('ktm', $("#ktm1")[0].files[0]);                 
                    }else{
                    data.append('ktm', $("#ktm1-value-" + no).val());
                    } 
                    if ($('#ktp1').get(0).files.length !== 0) {
                    data.append('ktp', $("#ktp1")[0].files[0]);                 
                    }else{
                    data.append('ktp', $("#ktp1-value-" + no).val());
                    } 
                    /*if ($('#akta1').get(0).files.length !== 0) {
                    data.append('akta', $("#akta1")[0].files[0]);                 
                    }else{
                    data.append('akta', $("#akta1-value-" + no).val());
                    } */
                    if ($('#kk1').get(0).files.length !== 0) {
                    data.append('kk', $("#kk1")[0].files[0]);                 
                    }else{
                    data.append('kk', $("#kk1-value-" + no).val());
                    } 
                    if ($('#domisili1').get(0).files.length !== 0) {
                    data.append('domisili', $("#domisili1")[0].files[0]);                 
                    }else{
                    data.append('domisili', $("#domisili1-value-" + no).val());
                    } 
                    if ($('#suratN1').get(0).files.length !== 0) {
                    data.append('suratN', $("#suratN1")[0].files[0]);                 
                    }else{
                    data.append('suratN', $("#suratN1-value-" + no).val());
                    } 
                    if ($('#sertifikat11').get(0).files.length !== 0) {
                    data.append('sertifikat1', $("#sertifikat11")[0].files[0]);                 
                    }else{
                    data.append('sertifikat1', $("#sertifikat11-value-" + no).val());
                    } 
                    if ($('#sertifikat21').get(0).files.length !== 0) {
                    data.append('sertifikat2', $("#sertifikat21")[0].files[0]);                 
                    }else{
                    data.append('sertifikat2', $("#sertifikat21-value-" + no).val());
                    } 
                    if ($('#sertifikat31').get(0).files.length !== 0) {
                    data.append('sertifikat3', $("#sertifikat31")[0].files[0]);                 
                    }else{
                    data.append('sertifikat3', $("#sertifikat31-value-" + no).val());
                    } 
                    if ($('#burek1').get(0).files.length !== 0) {
                    data.append('burek', $("#burek1")[0].files[0]);                 
                    }else{
                    data.append('burek', $("#burek1-value-" + no).val());
                    } 
                    if ($('#ijazah1').get(0).files.length !== 0) {
                    data.append('ijazah', $("#ijazah1")[0].files[0]);                 
                    }else{
                    data.append('ijazah', $("#ijazah1-value-" + no).val());
                    }
                    data.append('aksi', aks); // set data aksi = add untuk pembanding aksi

                }else{//jika aksinya add
                    var data = new FormData();
                    data.append('id_bp', id_bp); 
                    data.append('periode', periode); 
                    data.append('tgl', tgl); 
                    data.append('semester', semester); 
                    data.append('ipk', ipk); 
                    data.append('suratP', $("#suratP1")[0].files[0]); 
                    data.append('suratAK', $("#suratAK1")[0].files[0]); 
                    data.append('khs', $("#khs1")[0].files[0]); 
                    data.append('suratK', $("#suratK1")[0].files[0]); 
                    data.append('suratB', $("#suratB1")[0].files[0]); 
                    data.append('ktm', $("#ktm1")[0].files[0]); 
                    data.append('ktp', $("#ktp1")[0].files[0]); 
                    //data.append('akta', $("#akta1")[0].files[0]); 
                    data.append('kk', $("#kk1")[0].files[0]); 
                    data.append('domisili', $("#domisili1")[0].files[0]); 
                    data.append('suratN', $("#suratN1")[0].files[0]); 
                    data.append('sertifikat1', $("#sertifikat11")[0].files[0]); 
                    data.append('sertifikat2', $("#sertifikat21")[0].files[0]); 
                    data.append('sertifikat3', $("#sertifikat31")[0].files[0]); 
                    data.append('burek', $("#burek1")[0].files[0]); 
                    data.append('ijazah', $("#ijazah1")[0].files[0]); 
                    data.append('aksi', aks); // set data aksi = add untuk pembanding aksi                    
                }

            //document.write(suratP);
            wait('facebook', 'default', '.modal-content', 'Loading...');
            $('.waitMe_content').append('<br><div class="progress" style="width:90%; top:0; margin-left:auto; margin-right:auto;"> <div class="progress-bar bg-cyan progress-bar-striped active" id="progressbar1" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="color:#fff;"> </div> </div>'); 
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            console.log('Bytes Loaded : ' + e.loaded);
                            console.log('Total Size : ' + e.total);
                            console.log('Persen : ' + (e.loaded / e.total));
                            
                            var percent = Math.round((e.loaded / e.total) * 100);
                            
                            $('div#progressbar1').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                        }
                    });
                    return xhr;
                },

                url: 'beasiswaP-aksi.php', // File tujuan
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
                    $("#loading-simpan1").hide(); // Sembunyikan loading simpan
                    
                    if(response.status == "sukses"){ // Jika Statusnya = sukses
                        
                        $("#view1").load('beasiswaP-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil disimpan!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });     

                        //$("#1").click();
                        $("#btn-reset1").click();  
                        $("#form-modal1").modal('hide'); // Close / Tutup Modal Dialog
                    }
                    else if (response.status == "double") {
                        $("#view1").load('beasiswaP-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'DENIED!',
                            text:  'Anda telah mengajukan Permohonan Beasiswa! \nKetentuan : 1 User 1 kali pengajuan dalam 1 Periode.',
                            type: 'error',
                            showConfirmButton: true
                        });     

                        //$("#1").click();
                        $("#btn-reset1").click();  
                        $("#form-modal1").modal('hide'); // Close / Tutup Modal Dialog

                    }else{ // Jika statusnya = gagal
                        
                        swal({
                            title: 'GAGAL!',
                            text:  'Error : '+response.pesan,
                            type: 'error',
                            showConfirmButton: true
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //$("#1").click();
                        $("#btn-reset1").click();  
                        $("#form-modal1").modal('hide'); // Close / Tutup Modal Dialog
                        $("#view1").load('beasiswaP-data.php');

                        //munculkan pesan error dengan sweetalert
                        swal({
                            title: 'Gagal!',
                            text:  'Data gagal disimpan! \nError : ' +ajaxOptions+''+thrownError,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                }
            });

            }

        });
    


        

        $('#form-modal1').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset1").click(); // Klik tombol reset1 agar form kembali bersih
            $('#ultabs1 a:first').tab('show');

            $("#loading-ubah1, #loading-simpan1,  #pesan-validasi, #btn-reset1").hide();

            $(".vdt1").html('');
            $("#ultabs1").removeAttr('class');
            $("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right');
        });
        $('#form-file11').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $('#ultabs11 a:first').tab('show');
        });


        $(".viewfile11").click(function(){  
            var data1 = $(this).attr('data-file');  
            $("#md1").html('Lihat File - '+data1);  

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a><hr><img src="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file1').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file1').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a>';
                var vf = 'http://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file1').innerHTML = vf;
            }

        });

        $(".viewfile21").click(function(){  
            var data1 = $(this).attr('data-file');  
            $("#md1").html('Lihat File - '+data1);  

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a><hr><img src="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file1').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file1').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a>';
                var vf = 'http://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file1').innerHTML = vf;
            }
        });
    });


