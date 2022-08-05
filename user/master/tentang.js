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
    $(document).ready(function(){


        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan, #pesan-validasi, #video, #btn-reset").hide();
        
function errorFocus(idFL, classFl, idpesan, pesan){
            var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.add("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idFL, classFl, idpesan){
                var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.remove("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
}
     function CheckExtension(file) {
        /*global document: false */
        var validFilesTypes = ["mp4", "3gp", "avi", "mov", "mkv"];
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
                if (e !== 0 && e <= 134217728) {
                    isValidFile = true;
                }
                return isValidFile;
    }
$('#video').on('change', function(){ // on change of state
                if(CheckExtension($('#video')[0].files[0].name) == true){  //cek tipe file  
                    if (validateFileSize($('#video')[0].files[0].size) == false) { //cek ukuran file 
                        errorFocus(0,'.fr', 'v1', 'Ukuran File melebihi Batas, Maks. 128 Mb');
                        return false;
                    }else{
                        errorClear(0, '.fr', 'v1');                        
                    }
                }else{
                        errorFocus(0,'.fr', 'v1', 'Tipe File tidak didukung');
                        return false; 
                }
});
       
        $("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

       //jika lolos validasi lanjut ke proses simpan data

            
            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
            data.append('video', $("#video")[0].files[0]);                 
            data.append('kv', $("#kv").val()); 
            data.append('quote', $("#quote").val()); 
            data.append('aq', $("#aq").val()); 
            data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi

            
                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['lime'];

                        var $loading = $('#card1').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });
            
            $.ajax({
                url: 'tentang-aksi.php', // File tujuan
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
                    $('#card1').waitMe('hide'); // Sembunyikan loading ubah
                    
                    if(response.status == "sukses"){ // Jika Statusnya = sukses

                        // Ganti isi dari div view dengan view yang diambil dari proses_ubah.php
                        $('#btn-reset').click();
                        location.reload(); 
                        $("#view").load('tantang-data.php');
                        //munculkan pesan berhasil dengan sweetalert
                        /*swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil diubah!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });*/     
                        
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                    $('#card1').waitMe('hide'); // Sembunyikan loading ubah
                        $('#btn-reset').click();

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


        });




        $('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset").click(); // Klik tombol reset agar form kembali bersih
            $("#loading-ubah, #loading-simpan, #btn-reset").hide();
            
            var pe = document.querySelectorAll(".form-line");
            pe[0].classList.remove("error");  
            pe[1].classList.remove("error");  
            pe[2].classList.remove("error");  
            pe[3].classList.remove("error");  
            document.getElementById("v1").innerHTML = ''; 
            document.getElementById("v2").innerHTML = '';  
            document.getElementById("v3").innerHTML = '';  
            document.getElementById("v4").innerHTML = ''; 
        });


    });


