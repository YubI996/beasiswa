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
$("#modal-file3").on('hidden.bs.modal', function (event) {
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
function tabN3(a){
    var aN = a;
    $('#tabs13').val(aN);
    $('#tabs33').val(aN);
}


$(document).ready(function(){


            var main = "beasiswaC-data.php"; 
            $("#view3").load(main); //tampilkan data unduhan saat halaman dibuka

        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah3, #loading-simpan3,  #pesan-validasi, .ck2, #btn-reset3").hide();
        
        $("#btn-tambah3").click(function(){ // Ketika tombol tambah diklik
            $('#btn-close').click();
            $("#btn-simpan3").html('SIMPAN'); 
            $("#fileN3").hide(); 
            $("#aks3").val('add');
            $("#tabs13").val('12');
            $("#err3").val('1');
            $("#btn-simpan3").hide(); 
            $(".ck3").hide();  
            $(".fc3").show();  
            $("#btn-next3").show();  
            $("#btn-prev3").show();  
            $("#btn-prev3").removeAttr('class');
            $("#btn-prev3").attr('disabled', '');
            $("#btn-prev3").attr('class', 'btn bg-grey waves-effect');

            // Set judul modal dialog menjadi Form Tambah Data
            $("#modal-title3").html('Form Pengajuan Beasiswa Coass Kedokteran');
        });

        $("#btn-next3").click(function(){ 
            var aktif = $('#tabs13').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs13').val(next);

            if ($('#tabs13').val() == 14) {
            $("#btn-simpan3").show(); 
            $("#btn-next3").hide(); 
            }           
        });

        $("#btn-prev3").click(function(){ 
            var aktif = $('#tabs13').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs13').val(next);
            $("#btn-next3").show(); 
            $("#btn-simpan3").hide(); 
            
            if($('#tabs13').val() == 12){
                $("#btn-simpan3").hide(); 
                $("#btn-next3").show(); 
                $("#btn-prev3").removeAttr('class');
                $("#btn-prev3").attr('disabled', '');
                $("#btn-prev3").attr('class', 'btn bg-grey waves-effect');

            }
        });
        $("#btn-next13").click(function(){ 
            var aktif = $('#tabs33').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs33').val(next);

            if ($('#tabs33').val() == 16) {
            $("#btn-tutup3").show(); 
            $("#btn-next13").hide(); 
            }           
        });

        $("#btn-prev13").click(function(){ 
            var aktif = $('#tabs33').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs33').val(next);
            $("#btn-next13").show(); 
            $("#btn-tutup3").hide(); 
            
            if($('#tabs13').val() == 15){
                $("#btn-tutup3").hide(); 
                $("#btn-next13").show(); 
                $("#btn-prev13").removeAttr('class');
                $("#btn-prev13").attr('disabled', '');
                $("#btn-prev13").attr('class', 'btn bg-grey waves-effect');
            }
        });


        $("#16").click(function(){ 
                $("#btn-tutup3").show(); 
                $("#btn-next13").hide(); 
                $("#btn-prev13").removeAttr('class');
                $("#btn-prev13").removeAttr('disabled');
                $("#btn-prev13").attr('class', 'btn bg-teal waves-effect');
        }); 
        $("#14").click(function(){ 
                $("#fileN3").show(); 
                $("#btn-simpan3").show(); 
                $("#btn-next3").hide(); 
                $("#btn-prev3").show(); 
                $("#btn-prev3").removeAttr('class');
                $("#btn-prev3").removeAttr('disabled');
                $("#btn-prev3").attr('class', 'btn bg-teal waves-effect');
        });
        $("#13").click(function(){ 
                $("#fileN3").show(); 
                $("#btn-simpan3").hide(); 
                $("#btn-next3").show(); 
                $("#btn-prev3").show(); 
                $("#btn-prev3").removeAttr('class');
                $("#btn-prev3").removeAttr('disabled');
                $("#btn-prev3").attr('class', 'btn bg-teal waves-effect');
        });

        $("#12").click(function(){ 
                $("#fileN3").hide(); 
                $("#btn-simpan3").hide(); 
                $("#btn-next3").show(); 
                $("#btn-prev3").removeAttr('class');
                $("#btn-prev3").attr('disabled', '');
                $("#btn-prev3").attr('class', 'btn bg-grey waves-effect');
        });
        $("#15").click(function(){ 
                $("#btn-tutup3").hide(); 
                $("#btn-next13").show(); 
                $("#btn-prev13").removeAttr('class');
                $("#btn-prev13").attr('disabled', '');
                $("#btn-prev13").attr('class', 'btn bg-grey waves-effect');
        });


function errorFocus(idFL, idtab, classFl, idpesan, pesan){
            var pe = document.querySelectorAll(classFl);
                $("#ultabs3").removeAttr('class');
                $("#ultabs3").attr('class', 'nav nav-tabs tab-nav-right tab-col-red');
                $("#"+idtab).click();
                pe[idFL].classList.add("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idFL, classFl, idpesan){
                var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.remove("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
                if ($("#err3").val() != 0) {
                    $("#ultabs3").removeAttr('class');
                    $("#ultabs3").attr('class', 'nav nav-tabs tab-nav-right');
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
                if (e !== 0 && e <= 5242880) {
                    isValidFile = true;
                }
                return isValidFile;
    }
$('.fc3').on('change', function(){ // on change of state
            var no = $(this).attr('data-no');
            var vn = $(this).attr('data-v');
            var id = $(this).attr('id');
            var tab = $('#tabs13').val();
                if(CheckExtension($('#'+id)[0].files[0].name) == true){  //cek tipe file  
                    if (validateFileSize($('#'+id)[0].files[0].size) == false) { //cek ukuran file 
                        errorFocus(no, tab, '.frr', vn, 'Ukuran File melebihi Batas, Maks. 5Mb');
                        return false;
                    }else{
                        errorClear(no, '.frr', vn);                        
                    }
                }else{
                            $('#err3').val('0');                            
                            $("#btn-simpan3").attr('disabled', '');
                        errorFocus(no, tab, '.frr', vn, 'Tipe File tidak didukung');
                        return false; 
                }

                            if ($(".vdt3").text() != "" && $("#err3").val() == 1) {
                                $('#err3').val('0');                            
                                    $("#btn-simpan3").attr('disabled', '');
                            }else if($(".vdt3").text() != "" && $("#err3").val() == 0){
                                $('#err3').val('0');                                                        
                                    $("#btn-simpan3").attr('disabled', '');
                            }else{
                                $('#err3').val('1');                                                                                    
                                $("#btn-simpan3").removeAttr('disabled');                    
                            }

                if ($("#err3").val() < 1) {
                    $("#btn-simpan3").attr('disabled', '');
                }else{
                    $("#btn-simpan3").removeAttr('disabled');                    
                }

});


            var re1 = /^[0-9]+$/;
            var re2 = /^[0-9]{1}([.][0-9]{3})+$/;
            var re3 = /^[0-9]{1,2}$/;

            $('#semester3').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(0, 12, '.fr3', 'vv41', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(0, '.fr3', 'vv41');
                }
                if ($(this).val() > 14) {
                    errorFocus(0, 12, '.fr3', 'vv41', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                    return false;
                }else{
                    errorClear(0, '.fr3', 'vv41');
                }
                if (!$(this).val().match(re3)) {
                    errorFocus(0, 12, '.fr3', 'vv41', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                    return false;
                }else{
                    errorClear(0, '.fr3', 'vv41');
                }
            })
            $('#ipk3').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(1, 12, '.fr3', 'vv51', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(1, '.fr3', 'vv51');
                }
                if ($(this).val() > 4) {
                    errorFocus(1, 12, '.fr3', 'vv51', 'IPK Maksimal adalah 4.000');
                    return false;
                }else{
                    errorClear(1, '.fr3', 'vv51');
                }
                if (!$(this).val().match(re2)) {
                    errorFocus(1, 12, '.fr3', 'vv51', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                    return false;
                }else{
                    errorClear(1, '.fr3', 'vv51');
                }
            });

        $("#btn-simpan3").click(function(){ // Ketika tombol simpan di klik

            var no = document.getElementById("no3").value; 
            var id_bcs = document.getElementById("id_bcs").value; 
            var periode = $("#periode3").attr('placeholder');  
            var tgl = $("#tgl3").attr('placeholder'); 
            var semester = document.getElementById("semester3").value; 
            var ipk = document.getElementById("ipk3").value; 
            var suratP = document.getElementById("suratP3").value; 
            // var propPN1 = document.getElementById("propPN13").value; 
            // var propPN2 = document.getElementById("propPN23").value; 
            var suratTA = document.getElementById("suratTA3").value; 
            // var suratPN = document.getElementById("suratPN3").value; 
            var suratAK = document.getElementById("suratAK3").value; 
            var khs = document.getElementById("khs3").value; 
            var suratK = document.getElementById("suratK3").value; 
            var suratB = document.getElementById("suratB3").value; 
            var ktm = document.getElementById("ktm3").value; 
            var ktp = document.getElementById("ktp3").value; 
            //var akta = document.getElementById("akta3").value; 
            var kk = document.getElementById("kk3").value; 
            var domisili = document.getElementById("domisili3").value; 
            var suratN = document.getElementById("suratN3").value; 
            var sertifikat1 = document.getElementById("sertifikat13").value; 
            var sertifikat2 = document.getElementById("sertifikat23").value; 
            var sertifikat3 = document.getElementById("sertifikat33").value; 
            var burek = document.getElementById("burek3").value; 
            var ijazah1 = document.getElementById("ijazah13").value; 
            var ijazah2 = document.getElementById("ijazah23").value; 
            var aks = document.getElementById("aks3").value; 
            
            if (semester == "") {
                errorFocus(0, 12, '.fr3', 'vv41', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr3', 'vv41');
            
            }
            if (!semester.match(re3)) {
                errorFocus(0, 12, '.fr3', 'vv41', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                return false;
            }else{
                errorClear(0, '.fr3', 'vv41');
            }
            if (semester > 14) {
                errorFocus(0, 12, '.fr3', 'vv41', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                return false;
            }else{
                errorClear(0, '.fr3', 'vv41');
            }            
            if (ipk == "") {
                errorFocus(1, 12, '.fr3', 'vv51', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr3', 'vv51');
            }
            if (ipk > 4) {
                errorFocus(1, 12, '.fr3', 'vv51', 'IPK Maksimal adalah 4.000');
                return false;
            }else{
                errorClear(1, '.fr3', 'vv51');
            }                        
            if (!ipk.match(re2)) {
                errorFocus(1, 12, '.fr3', 'vv51', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                return false;
            }else{
                errorClear(1, '.fr3', 'vv51');
            }

            if ((aks == 'edt' && $("#cSP3").is(':checked') && suratP == "") || (aks == 'add' && suratP == "")) {
                errorFocus(0, 13, '.frrr', 'vv61', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.frrr', 'vv61');        
            }

            if ((aks == 'edt' && $("#cAK3").is(':checked') && suratAK == "") || (aks == 'add' && suratAK == "")) {
                errorFocus(1, 13, '.frrr', 'vv71x', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.frrr', 'vv71x');
            }
/*            if ((aks == 'edt' && $("#cSPN3").is(':checked') && suratPN == "") || (aks == 'add' && suratPN == "")) {
                errorFocus(2, 13, '.frrr', 'vv711', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.frrr', 'vv711');
            }
            if ((aks == 'edt' && $("#cPR13").is(':checked') && propPN1 == "") || (aks == 'add' && propPN1 == "")) {
                errorFocus(3, 13, '.frrr', 'vv731', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.frrr', 'vv731');
            }
            if ((aks == 'edt' && $("#cPR23").is(':checked') && propPN2 == "") || (aks == 'add' && propPN2 == "")) {
                errorFocus(4, 13, '.frrr', 'vv731', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.frrr', 'vv731');
            }*/
            if ((aks == 'edt' && $("#cSTA3").is(':checked') && suratTA == "") || (aks == 'add' && suratTA == "")) {
                errorFocus(2, 13, '.frrr', 'vv741', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.frrr', 'vv741');
            }
            if ((aks == 'edt' && $("#cKhs3").is(':checked') && khs == "") || (aks == 'add' && khs == "")) {
                errorFocus(3, 13, '.frrr', 'vv81', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.frrr', 'vv81');
            }
            if ((aks == 'edt' && $("#cSK3").is(':checked') && suratK == "") || (aks == 'add' && suratK == "")) {
                errorFocus(4, 13, '.frrr', 'vv91', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.frrr', 'vv91');
            }
            // if ((aks == 'edt' && $("#cSB3").is(':checked') && suratB == "") || (aks == 'add' && suratB == "")) {
            //     errorFocus(5, 13, '.frrr', 'vv101', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(5, '.frrr', 'vv101');
            // }
            if ((aks == 'edt' && $("#cKtm3").is(':checked') && ktm == "") || (aks == 'add' && ktm == "")) {
                errorFocus(6, 13, '.frrr', 'vv111', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.frrr', 'vv111');
            }
            /*if ((aks == 'edt' && $("#cAkta3").is(':checked') && akta == "") || (aks == 'add' && akta == "")) {
                errorFocus(10, 14, '.frrr', 'vv131', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.frrr', 'vv131');
            }*/
            if ((aks == 'edt' && $("#cKk3").is(':checked') && kk == "") || (aks == 'add' && kk == "")) {
                errorFocus(7, 14, '.frrr', 'vv141', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(7, '.frrr', 'vv141');
            }
            if ((aks == 'edt' && $("#cKtp3").is(':checked') && ktp == "") || (aks == 'add' && ktp == "")) {
                errorFocus(8, 14, '.frrr', 'vv131', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(8, '.frrr', 'vv131');
            }
            if ((aks == 'edt' && $("#cDom3").is(':checked') && domisili == "") || (aks == 'add' && domisili == "")) {
                errorFocus(9, 14, '.frrr', 'vv151', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(9, '.frrr', 'vv151');
            }
            // if ((aks == 'edt' && $("#cSN3").is(':checked') && suratN == "") || (aks == 'add' && suratN == "")) {
            //     errorFocus(10, 14, '.frrr', 'vv161', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(10, '.frrr', 'vv161');
            // }
            if (aks == 'edt' && $("#cS13").is(':checked') && sertifikat1 == "") {
                errorFocus(11, 14, '.frrr', 'vv171', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(11, '.frrr', 'vv171');
            }
            if (aks == 'edt' && $("#cS23").is(':checked') && sertifikat2 == "") {
                errorFocus(12, 14, '.frrr', 'vv181', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(12, '.frrr', 'vv181');
            }
            if (aks == 'edt' && $("#cS33").is(':checked') && sertifikat3 == "") {
                errorFocus(13, 14, '.frrr', 'vv191', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(13, '.frrr', 'vv191');
            }
            if ((aks == 'edt' && $("#cBR3").is(':checked') && burek == "") || (aks == 'add' && burek == "")) {
                errorFocus(14, 14, '.frrr', 'vv201', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(14, '.frrr', 'vv201');
            }
            if ((aks == 'edt' && $("#cIjz13").is(':checked') && ijazah1 == "") || (aks == 'add' && ijazah1 == "")) {
                errorFocus(15, 14, '.frrr', 'vv211', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(15, '.frrr', 'vv211');
            }
            if (aks == 'edt' && $("#cIjz23").is(':checked') && ijazah2 == "") {
                errorFocus(16, 14, '.frrr', 'vv231', 'Field tidak boleh kosong');
                return false;
            }else{
                    errorClear(16, '.frrr', 'vv231');

           //jika lolos validasi lanjut ke proses simpan data

            // Buat variabel data untuk menampung data hasil input dari form
                    var data = new FormData();
                    data.append('id_bcs', id_bcs); 
                    data.append('periode', periode); 
                    data.append('tgl', tgl); 
                    data.append('semester', $("#semester3").val()); 
                    data.append('ipk', ipk); 
                    data.append('suratP', $("#suratP3")[0].files[0]); 
                    data.append('suratAK', $("#suratAK3")[0].files[0]); 
                    // data.append('suratPN', $("#suratPN3")[0].files[0]); 
                    // data.append('propPN1', $("#propPN13")[0].files[0]); 
                    // data.append('propPN2', $("#propPN23")[0].files[0]); 
                    data.append('suratTA', $("#suratTA3")[0].files[0]); 
                    data.append('khs', $("#khs3")[0].files[0]); 
                    data.append('suratK', $("#suratK3")[0].files[0]); 
                    data.append('suratB', $("#suratB3")[0].files[0]); 
                    data.append('ktm', $("#ktm3")[0].files[0]); 
                    data.append('ktp', $("#ktp3")[0].files[0]); 
                    //data.append('akta', $("#akta3")[0].files[0]); 
                    data.append('kk', $("#kk3")[0].files[0]); 
                    data.append('domisili', $("#domisili3")[0].files[0]); 
                    data.append('suratN', $("#suratN3")[0].files[0]); 
                    data.append('sertifikat1', $("#sertifikat13")[0].files[0]); 
                    data.append('sertifikat3', $("#sertifikat23")[0].files[0]); 
                    data.append('sertifikat3', $("#sertifikat33")[0].files[0]); 
                    data.append('burek', $("#burek3")[0].files[0]); 
                    data.append('ijazah1', $("#ijazah13")[0].files[0]); 
                    data.append('ijazah2', $("#ijazah23")[0].files[0]); 
                    data.append('aksi', aks); // set data aksi = add untuk pembanding aksi                    

            //document.write(suratP);
            wait('facebook', 'default', '.modal-content', 'Loading...');
            $('.waitMe_content').append('<br><div class="progress" style="width:90%; top:0; margin-left:auto; margin-right:auto;"> <div class="progress-bar bg-cyan progress-bar-striped active" id="progressbar3" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="color:#fff;"> </div> </div>'); 
            
            $.ajax({
                xhr : function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e){
                        if(e.lengthComputable){
                            console.log('Bytes Loaded : ' + e.loaded);
                            console.log('Total Size : ' + e.total);
                            console.log('Persen : ' + (e.loaded / e.total));
                            
                            var percent = Math.round((e.loaded / e.total) * 100);
                            
                            $('div#progressbar3').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                        }
                    });
                    return xhr;
                },

                url: 'beasiswaC-aksi.php', // File tujuan
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
                    $("#loading-simpan3").hide(); // Sembunyikan loading simpan
                    
                    if(response.status == "sukses"){ // Jika Statusnya = sukses
                        
                        $("#view3").load('beasiswaC-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil disimpan!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });     

                        //$("#1").click();
                        $("#btn-reset3").click();  
                        $("#form-modal3").modal('hide'); // Close / Tutup Modal Dialog
                    }
                    else if (response.status == "double") {
                        $("#view3").load('beasiswaC-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'DENIED!',
                            text:  'Anda telah mengajukan Permohonan Beasiswa! \nKetentuan : 1 User 1 kali pengajuan dalam 1 Periode.',
                            type: 'error',
                            showConfirmButton: true
                        });     

                        //$("#1").click();
                        $("#btn-reset3").click();  
                        $("#form-modal3").modal('hide'); // Close / Tutup Modal Dialog

                    }else{ // Jika statusnya = gagal
                        
                        //tampilkan pesan error
                        $("#pesan-error").show();
                        document.getElementById('pesan-error').innerHTML = response.pesan;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //$("#1").click();
                        $("#btn-reset3").click();  
                        $("#form-modal3").modal('hide'); // Close / Tutup Modal Dialog
                        $("#view3").load('beasiswaC-data.php');

                        //munculkan pesan error dengan sweetalert
                        swal({
                            title: 'Gagal!',
                            text:  'Data gagal disimpan! \nError : ' +xhr.thrownError,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                }
            });

            }

        });
    


        

        $('#form-modal3').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset3").click(); // Klik tombol reset agar form kembali bersih
            $('#ultabs2 a:first').tab('show');

            $("#loading-ubah3, #loading-simpan3,  #pesan-validasi, #btn-reset3").hide();

            $(".vdt3").html('');
            $("#ultabs3").removeAttr('class');
            $("#ultabs3").attr('class', 'nav nav-tabs tab-nav-right');
        });
        $('#form-file13').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $('#ultabs33 a:first').tab('show');

        });


        $(".viewfile13").click(function(){ // Ketika tombol view di klik
            var data1 = $(this).attr('data-file'); //ubah title modal view file
            $("#md13").html('Lihat File - '+data1); //ubah title modal view file

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a><hr><img src="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file3').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file3').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a>';
                var vf = 'http://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file3').innerHTML = vf;
            }

        });

        $(".viewfile23").click(function(){ // Ketika tombol view di klik
            var data1 = $(this).attr('data-file'); //ubah title modal view file
            $("#md3").html('Lihat File - '+data1); //ubah title modal view file

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a><hr><img src="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file3').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file3').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a>';
                var vf = 'http://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=http://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file3').innerHTML = vf;
            }
        });

    });


