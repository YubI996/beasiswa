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
$('#aniimated-thumbnials').lightGallery({
        thumbnail: true,
        selector: 'a'
    });
        $(document).ready(function(){



        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan, #pesan-validasi, #logoT, #logoF, #logoU, #btn-reset").hide();
        

        $("#btn-ubah").click(function(){ // Ketika tombol simpan di klik

            var title = document.getElementById("title").value; 
            var jft = document.getElementById("jft").value; 
            var tf = document.getElementById("tf").value; 
            var versi = document.getElementById("versi").value; 
            var owner = document.getElementById("owner").value; 
            var logo1 = document.getElementById("logo1").value; 
            var logo2 = document.getElementById("logo2").value; 
            var logo3 = document.getElementById("logo3").value; 
            var pe = document.querySelectorAll(".fr");

           
            if($("#cek1").is(':checked') && logo1 == ""){
                pe[5].classList.add("error"); //tambah class error pada form
                document.getElementById("logo1").focus(); //set fokus pada textfield
                document.getElementById("v5").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v5").innerHTML = '';
            }
            if($("#cek2").is(':checked') && logo2 == ""){
                pe[6].classList.add("error"); //tambah class error pada form
                document.getElementById("logo2").focus(); //set fokus pada textfield
                document.getElementById("v6").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v6").innerHTML = '';
            }
            if($("#cek3").is(':checked') && logo3 == ""){
                pe[7].classList.add("error"); //tambah class error pada form
                document.getElementById("logo3").focus(); //set fokus pada textfield
                document.getElementById("v7").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v7").innerHTML = '';
            

            
            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
/**/
            data.append('title', $("#title").val()); 
            data.append('jft', $("#jft").val()); 
            data.append('tf', $("#tf").val()); 
            data.append('versi', $("#versi").val()); 
            data.append('owner', $("#owner").val()); 
            data.append('logo1', $("#logo1")[0].files[0]); 
            data.append('logo2', $("#logo2")[0].files[0]); 
            data.append('logo3', $("#logo3")[0].files[0]); 
            data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi

            
                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['pink'];

                        var $loading = $('#card1').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });
            
            $.ajax({
                url: 'aplikasi-aksi.php', // File tujuan
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
                        $("#view").load('aplikasi-data.php');
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

                        //munculkan pesan error dengan sweetalert
                        swal({
                            title: 'Gagal!',
                            text:  'Data gagal disimpan! \nError : ' +xhr.responseText,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                        $("#form-modal1").modal('hide'); // Close / Tutup Modal Dialog
                    $('#card1').waitMe('hide'); // Sembunyikan loading ubah

                }
            });

          }  

        });
    



    });

