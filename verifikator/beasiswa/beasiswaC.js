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
$("#modal-file").on('hidden.bs.modal', function (event) {
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
function tabN(a){
    var aN = a;
    $('#tabs1').val(aN);
    $('#tabs2').val(aN);
}

function errorFocus(idFL, idtab, classFl, idpesan, pesan){
            var pe = document.querySelectorAll(classFl);
                $("#ultabs").removeAttr('class');
                $("#ultabs").attr('class', 'nav nav-tabs tab-nav-right tab-col-red');
                $("#"+idtab).click();
                pe[idFL].classList.add("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idFL, classFl, idpesan){
                var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.remove("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
                $("#ultabs").removeAttr('class');
                $("#ultabs").attr('class', 'nav nav-tabs tab-nav-right');
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


$(document).ready(function(){


            var main = "beasiswaC-data.php"; 
            $("#view").load(main); //tampilkan data unduhan saat halaman dibuka

        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan,  #pesan-validasi, .ck, #btn-reset").hide();
        
        $("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
            $("#fileN2").hide(); 
            $("#btn-simpan").html('SIMPAN'); 
            $("#aks").val('add');
            $("#tabs1").val('1');
            $("#btn-simpan").hide(); 
            $(".ck").hide();  
            $(".fc").show();  
            $("#btn-next").show();  
            $("#btn-prev").show();  
            $("#btn-prev").removeAttr('class');
            $("#btn-prev").attr('disabled', '');
            $("#btn-prev").attr('class', 'btn bg-grey waves-effect');

            // Set judul modal dialog menjadi Form Tambah Data
            $("#modal-title").html('Form Tambah data');
        });

        $("#btn-next").click(function(){ 
            var aktif = $('#tabs1').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs1').val(next);

            if ($('#tabs1').val() == 3) {
            $("#btn-simpan").show(); 
            $("#btn-next").hide(); 
            }           
        });

        $("#btn-prev").click(function(){ 
            var aktif = $('#tabs1').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs1').val(next);
            $("#btn-next").show(); 
            $("#btn-simpan").hide(); 
            
            if($('#tabs1').val() == 1){
                $("#btn-simpan").hide(); 
                $("#btn-next").show(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").attr('disabled', '');
                $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
            }
        });
        $("#btn-next1").click(function(){ 
            var aktif = $('#tabs2').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs2').val(next);

            if ($('#tabs2').val() == 6) {
            $("#btn-tutup").show(); 
            $("#btn-next1").hide(); 
            }           
        });

        $("#btn-prev1").click(function(){ 
            var aktif = $('#tabs2').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1-angka2);
            $('#'+next).click();
            $('#tabs2').val(next);
            $("#btn-next1").show(); 
            $("#btn-tutup").hide(); 
            
            if($('#tabs1').val() == 5){
                $("#btn-tutup").hide(); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").attr('disabled', '');
                $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');
            }
        });


        $("#6").click(function(){ 
                $("#btn-tutup").show(); 
                $("#btn-next1").hide(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").removeAttr('disabled');
                $("#btn-prev1").attr('class', 'btn bg-teal waves-effect');
        });
        $("#4").click(function(){ 
                $("#btn-simpan").show(); 
                $("#btn-next").hide(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").removeAttr('disabled');
                $("#btn-prev").attr('class', 'btn bg-teal waves-effect');
        });
        $("#3").click(function(){ 
                $("#fileN2").show(); 
                $("#btn-simpan").show(); 
                $("#btn-next").hide(); 
                $("#btn-prev").show(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").removeAttr('disabled');
                $("#btn-prev").attr('class', 'btn bg-teal waves-effect');
        });
        $("#2").click(function(){ 
                $("#fileN2").show(); 
                $("#btn-simpan").hide(); 
                $("#btn-next").show(); 
                $("#btn-prev").show(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").removeAttr('disabled');
                $("#btn-prev").attr('class', 'btn bg-teal waves-effect');
        });

        $("#1").click(function(){ 
                $("#fileN2").hide(); 
                $("#btn-simpan").hide(); 
                $("#btn-next").show(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").attr('disabled', '');
                $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
        });
        $("#5").click(function(){ 
                $("#btn-tutup").hide(); 
                $("#btn-next1").show(); 
                $("#btn-prev1").removeAttr('class');
                $("#btn-prev1").attr('disabled', '');
                $("#btn-prev1").attr('class', 'btn bg-grey waves-effect');
        });


$('.fc').on('change', function(){ // on change of state
            var no = $(this).attr('data-no');
            var vn = $(this).attr('data-v');
            var id = $(this).attr('id');
            var tab = $('#tabs1').val();
                if(CheckExtension($('#'+id)[0].files[0].name) == true){  //cek tipe file  
                    if (validateFileSize($('#'+id)[0].files[0].size) == false) { //cek ukuran file 
                        errorFocus(no, tab, '.fr', vn, 'Ukuran File melebihi Batas, Maks. 1Mb');
                        return false;
                    }else{
                        errorClear(no, '.fr', vn);                        
                    }
                }else{
                        $('#err1').val('0');                            
                        $("#btn-simpan").attr('disabled', '');
                        errorFocus(no, tab, '.fr', vn, 'Tipe File tidak didukung');
                        return false; 
                }
                            if ($(".vdt").text() != "" && $("#err1").val() == 1) {
                                $('#err1').val('0');                            
                                $("#btn-simpan").attr('disabled', '');
                            }else if($(".vdt").text() != "" && $("#err1").val() == 0){
                                $('#err1').val('0');                                                        
                                $("#btn-simpan").attr('disabled', '');
                            }else{
                                $('#err1').val('1');                                                                                    
                                $("#btn-simpan").removeAttr('disabled');                    
                            }

                if ($("#err1").val() < 1) {
                    $("#btn-simpan").attr('disabled', '');
                }
                else{
                    $("#btn-simpan").removeAttr('disabled');                    
                }
});


            var re1 = /^[0-9]+$/;
            var re2 = /^[0-9]{1}([.][0-9]{3})+$/;
            var re3 = /^[0-9]{1,2}$/;


            $('#id_mahasiswa').on('change', function(){
                if ($(this).val() == "" || $(this).val() == 0) {
                    errorFocus(0, 1, '.fr1', 'v1', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(0, '.fr1', 'v1');
                }
            })
            $('#periode').on('change', function(){
                if ($(this).val() == "") {
                    errorFocus(1, 1, '.fr1', 'v2', 'Field tidak boleh kosong. Silakan Pilih periode');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v2');
                }
            })
            $('#tgl').on('change', function(){
                if ($(this).val() == "") {
                    errorFocus(0, 1, '.fr1', 'v3', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(0, '.fr1', 'v3');
                }
            })
            $('#semester').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(1, 1, '.fr1', 'v4', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v4');
                }
                if ($(this).val() > 14) {
                    errorFocus(1, 1, '.fr1', 'v4', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v4');
                }
                if (!$(this).val().match(re3)) {
                    errorFocus(1, 1, '.fr1', 'v4', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                    return false;
                }else{
                    errorClear(1, '.fr1', 'v4');
                }
            })
            $('#ipk').on('change keyup blur', function(){
                if ($(this).val() == "") {
                    errorFocus(2, 1, '.fr1', 'v5', 'Field tidak boleh kosong');
                    return false;
                }else{
                    errorClear(2, '.fr1', 'v5');
                }
                if ($(this).val() > 4) {
                    errorFocus(2, 1, '.fr1', 'v5', 'IPK Maksimal adalah 4.000');
                    return false;
                }else{
                    errorClear(2, '.fr1', 'v5');
                }
                if (!$(this).val().match(re2)) {
                    errorFocus(2, 1, '.fr1', 'v5', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                    return false;
                }else{
                    errorClear(2, '.fr1', 'v5');
                }
            });

        $("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

            var no = document.getElementById("no").value; 
            var id_bcs = document.getElementById("id_bcs").value; 
            var id_mahasiswa = document.getElementById("id_mahasiswa").value; 
            var periode = document.getElementById("periode").value; 
            var tgl = document.getElementById("tgl").value; 
            var semester = document.getElementById("semester").value; 
            var ipk = document.getElementById("ipk").value; 
            var suratP = document.getElementById("suratP").value; 
            var propPN1 = document.getElementById("propPN1").value; 
            var propPN2 = document.getElementById("propPN2").value; 
            var suratTA = document.getElementById("suratTA").value; 
            var suratPN = document.getElementById("suratPN").value; 
            var suratAK = document.getElementById("suratAK").value; 
            var khs = document.getElementById("khs").value; 
            var suratK = document.getElementById("suratK").value; 
            var suratB = document.getElementById("suratB").value; 
            var ktm = document.getElementById("ktm").value; 
            var ktp = document.getElementById("ktp").value; 
            //var akta = document.getElementById("akta").value; 
            var kk = document.getElementById("kk").value; 
            var domisili = document.getElementById("domisili").value; 
            var suratN = document.getElementById("suratN").value; 
            var sertifikat1 = document.getElementById("sertifikat1").value; 
            var sertifikat2 = document.getElementById("sertifikat2").value; 
            var sertifikat3 = document.getElementById("sertifikat3").value; 
            var burek = document.getElementById("burek").value; 
            var ijazah1 = document.getElementById("ijazah1").value; 
            var ijazah2 = document.getElementById("ijazah2").value; 
            var aks = document.getElementById("aks").value; 

            
            if (id_mahasiswa == "" || id_mahasiswa == 0) {
                errorFocus(0, 1, '.fr1', 'v1', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr1', 'v1');
            }
            if (periode == "") {
                errorFocus(1, 1, '.fr1', 'v2', 'Field tidak boleh kosong. Silakan Pilih periode');
                return false;
            }else{
                errorClear(1, '.fr1', 'v2');
            }
            if (tgl == "") {
                errorFocus(2, 1, '.fr1', 'v3', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr1', 'v3');
            }
            if (semester == "") {
                errorFocus(2, 1, '.fr1', 'v4', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr1', 'v4');
            
            }
            if (!semester.match(re3)) {
                errorFocus(2, 1, '.fr1', 'v4', 'Inputan harus angka, Maksimal 2 karakter (Ex: 4)');
                return false;
            }else{
                errorClear(2, '.fr1', 'v4');
            }
            if (semester > 14) {
                errorFocus(2, 1, '.fr1', 'v4', 'Batas Maksimal semester adalah 14 semester. Anda butuh Aq*a');
                return false;
            }else{
                errorClear(2, '.fr1', 'v4');
            }            
            if (ipk == "") {
                errorFocus(2, 1, '.fr1', 'v5', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr1', 'v5');
            }
            if (ipk > 4) {
                errorFocus(2, 1, '.fr1', 'v5', 'IPK Maksimal adalah 4.000');
                return false;
            }else{
                errorClear(2, '.fr1', 'v5');
            }            
            if (!ipk.match(re2)) {
                errorFocus(2, 1, '.fr1', 'v5', 'Inputan Harus Angka. Masukkan IPK dengan Benar, dengan 3 Angka dibelakang Titik. (Ex: 3.250)');
                return false;
            }else{
                errorClear(2, '.fr1', 'v5');
            }

            if ((aks == 'edt' && $("#cSP").is(':checked') && suratP == "") || (aks == 'add' && suratP == "")) {
                errorFocus(0, 2, '.fr', 'v6', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr', 'v6');        
            }

            if ((aks == 'edt' && $("#cAK").is(':checked') && suratAK == "") || (aks == 'add' && suratAK == "")) {
                errorFocus(1, 2, '.fr', 'v7', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr', 'v7');
            }
            if ((aks == 'edt' && $("#cSPN").is(':checked') && suratPN == "") || (aks == 'add' && suratPN == "")) {
                errorFocus(2, 2, '.fr', 'v71', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr', 'v71');
            }
            if ((aks == 'edt' && $("#cPR1").is(':checked') && propPN1 == "") || (aks == 'add' && propPN1 == "")) {
                errorFocus(3, 2, '.fr', 'v72', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.fr', 'v72');
            }
            if ((aks == 'edt' && $("#cPR2").is(':checked') && propPN2 == "") || (aks == 'add' && propPN2 == "")) {
                errorFocus(4, 2, '.fr', 'v73', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.fr', 'v73');
            }
            if ((aks == 'edt' && $("#cSTA").is(':checked') && suratTA == "") || (aks == 'add' && suratTA == "")) {
                errorFocus(5, 2, '.fr', 'v74', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(5, '.fr', 'v74');
            }
            if ((aks == 'edt' && $("#cKhs").is(':checked') && khs == "") || (aks == 'add' && khs == "")) {
                errorFocus(6, 2, '.fr', 'v8', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.fr', 'v8');
            }
            if ((aks == 'edt' && $("#cSK").is(':checked') && suratK == "") || (aks == 'add' && suratK == "")) {
                errorFocus(7, 2, '.fr', 'v9', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(7, '.fr', 'v9');
            }
            // if ((aks == 'edt' && $("#cSB").is(':checked') && suratB == "") || (aks == 'add' && suratB == "")) {
            //     errorFocus(8, 2, '.fr', 'v10', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(8, '.fr', 'v10');
            // }
            if ((aks == 'edt' && $("#cKtm").is(':checked') && ktm == "") || (aks == 'add' && ktm == "")) {
                errorFocus(9, 2, '.fr', 'v11', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(9, '.fr', 'v11');
            }
            /*if ((aks == 'edt' && $("#cAkta").is(':checked') && akta == "") || (aks == 'add' && akta == "")) {
                errorFocus(10, 3, '.fr', 'v12', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.fr', 'v12');
            }*/
            if ((aks == 'edt' && $("#cKk").is(':checked') && kk == "") || (aks == 'add' && kk == "")) {
                errorFocus(10, 3, '.fr', 'v14', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.fr', 'v14');
            }
            if ((aks == 'edt' && $("#cKtp").is(':checked') && ktp == "") || (aks == 'add' && ktp == "")) {
                errorFocus(11, 3, '.fr', 'v13', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(11, '.fr', 'v13');
            }
            if ((aks == 'edt' && $("#cDom").is(':checked') && domisili == "") || (aks == 'add' && domisili == "")) {
                errorFocus(12, 3, '.fr', 'v15', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(12, '.fr', 'v15');
            }
            // if ((aks == 'edt' && $("#cSN").is(':checked') && suratN == "") || (aks == 'add' && suratN == "")) {
            //     errorFocus(13, 3, '.fr', 'v16', 'Field tidak boleh kosong');
            //     return false;
            // }else{
            //     errorClear(13, '.fr', 'v16');
            // }
            if (aks == 'edt' && $("#cS1").is(':checked') && sertifikat1 == "") {
                errorFocus(14, 3, '.fr', 'v17', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(14, '.fr', 'v17');
            }
            if (aks == 'edt' && $("#cS2").is(':checked') && sertifikat2 == "") {
                errorFocus(15, 3, '.fr', 'v18', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(15, '.fr', 'v18');
            }
            if (aks == 'edt' && $("#cS3").is(':checked') && sertifikat3 == "") {
                errorFocus(16, 3, '.fr', 'v19', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(16, '.fr', 'v19');
            }
            if ((aks == 'edt' && $("#cBR").is(':checked') && burek == "") || (aks == 'add' && burek == "")) {
                errorFocus(17, 3, '.fr', 'v20', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(17, '.fr', 'v20');
            }
            if ((aks == 'edt' && $("#cIjz1").is(':checked') && ijazah1 == "") || (aks == 'add' && ijazah1 == "")) {
                errorFocus(18, 3, '.fr', 'v21', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(18, '.fr', 'v21');
            }
            if (aks == 'edt' && $("#cIjz2").is(':checked') && ijazah2 == "") {
                errorFocus(19, 3, '.fr', 'v22', 'Field tidak boleh kosong');
                return false;
            }else{
                if ($(".vdt1").text() != "") {
                    return false;
                }else{
                    errorClear(19, '.fr', 'v22');
                }
                if ($(".vdt").text() != "") {
                    return false;
                }else{
                    errorClear(19, '.fr', 'v22');
                }

           //jika lolos validasi lanjut ke proses simpan data

            // Buat variabel data untuk menampung data hasil input dari form
                    var data = new FormData();
                    data.append('id_bcs', id_bcs); 
                    data.append('id_mahasiswa', id_mahasiswa); 
                    data.append('periode', periode); 
                    data.append('tgl', tgl); 
                    data.append('semester', semester); 
                    data.append('ipk', ipk); 
                    data.append('suratP', $("#suratP")[0].files[0]); 
                    data.append('suratAK', $("#suratAK")[0].files[0]); 
                    data.append('suratPN', $("#suratPN")[0].files[0]); 
                    data.append('propPN1', $("#propPN1")[0].files[0]); 
                    data.append('propPN2', $("#propPN2")[0].files[0]); 
                    data.append('suratTA', $("#suratTA")[0].files[0]); 
                    data.append('khs', $("#khs")[0].files[0]); 
                    data.append('suratK', $("#suratK")[0].files[0]); 
                    data.append('suratB', $("#suratB")[0].files[0]); 
                    data.append('ktm', $("#ktm")[0].files[0]); 
                    data.append('ktp', $("#ktp")[0].files[0]); 
                    //data.append('akta', $("#akta")[0].files[0]); 
                    data.append('kk', $("#kk")[0].files[0]); 
                    data.append('domisili', $("#domisili")[0].files[0]); 
                    data.append('suratN', $("#suratN")[0].files[0]); 
                    data.append('sertifikat1', $("#sertifikat1")[0].files[0]); 
                    data.append('sertifikat2', $("#sertifikat2")[0].files[0]); 
                    data.append('sertifikat3', $("#sertifikat3")[0].files[0]); 
                    data.append('burek', $("#burek")[0].files[0]); 
                    data.append('ijazah1', $("#ijazah1")[0].files[0]); 
                    data.append('ijazah2', $("#ijazah2")[0].files[0]); 
                    data.append('aksi', aks); // set data aksi = add untuk pembanding aksi                    


            //document.write(suratP);
            $("#fileN2").hide(); 
            $("#loading-simpan").show(); // Munculkan loading simpan
            
            $.ajax({
                url: 'beasiswaC-aksi.php', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: data, // Set data yang akan dikirim
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil
                    $("#loading-simpan").hide(); // Sembunyikan loading simpan
                    
                    if(response.status == "sukses"){ // Jika Statusnya = sukses
                        
                        $("#view").load('beasiswaC-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil disimpan!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });     

                        //$("#1").click();
                        $("#btn-reset").click();  
                        $("#form-modal").modal('hide'); // Close / Tutup Modal Dialog
                    }
                    else if (response.status == "double") {
                        $("#view").load('beasiswaC-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'DENIED!',
                            text:  'User ini telah terdaftar dalam Permohonan Beasiswa! \nKetentuan : 1 User 1 kali mendaftar dalam 1 Periode.',
                            type: 'error',
                            showConfirmButton: true
                        });     

                        //$("#1").click();
                        $("#btn-reset").click();  
                        $("#form-modal").modal('hide'); // Close / Tutup Modal Dialog

                    }
                    else{ // Jika statusnya = gagal
                        
                        //tampilkan pesan error
                        $("#pesan-error").show();
                        document.getElementById('pesan-error').innerHTML = response.pesan;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //$("#1").click();
                        $("#btn-reset").click();  
                        $("#form-modal").modal('hide'); // Close / Tutup Modal Dialog
                        $("#view").load('beasiswaC-data.php');

                        //munculkan pesan error dengan sweetalert
                        swal({
                            title: 'Gagal!',
                            text:  'Data gagal disimpan! \nError : ' +xhr.responseText,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                }
            });

            }

        });
    


        

        $('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset").click(); // Klik tombol reset agar form kembali bersih
            $('#ultabs a:first').tab('show');

            $("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-reset").hide();

            $(".vdt").html('');
            $("#ultabs").removeAttr('class');
            $("#ultabs").attr('class', 'nav nav-tabs tab-nav-right');
            $("#id_mahasiswa").val('').change();
            $("#periode").val('').change();
        });

        $('#form-file1').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $('#ultabs1 a:first').tab('show');
        });


        $(".viewfile1").click(function(){  
            var data1 = $(this).attr('data-file');  
            $("#md").html('Lihat File - '+data1);  

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a><hr><img src="file_berkas_cs/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a>';
                var vf = 'https://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file').innerHTML = vf;
            }

        });

        $(".viewfile2").click(function(){  
            var data1 = $(this).attr('data-file');  
            $("#md").html('Lihat File - '+data1);  

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a><hr><img src="file_berkas_cs/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1+'" download>'+data1+'</a>';
                var vf = 'https://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_cs/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file').innerHTML = vf;
            }
        });

    });


