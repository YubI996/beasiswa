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

            var main = "profil-data.php"; 
            $("#view").load(main); //tampilkan data unduhan saat halaman dibuka


        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan, #datamhs, #datamhs1, #pesan-validasi, #pass, #foto, #btn-reset, #btn-reset1").hide();
        

        $("#btn-ubah").click(function(){ // Ketika tombol simpan di klik

            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var re1 = /^[0-9]+$/;
            var email = document.getElementById("email").value; //validasi data kosong
            var foto = document.getElementById("foto").value; //validasi data kosong
            var password1 = document.getElementById("passwordA").value; //validasi data kosong
            var password2 = document.getElementById("passwordB").value; //validasi data kosong
            var pe = document.querySelectorAll(".fr");

            if(email.length > 0 && !re.test(email)) {
                
                pe[1].classList.add("error"); //tambah class error pada form
                document.getElementById("email").focus(); //set fokus pada textfield
                document.getElementById("v2").innerHTML = 'Masukkan Email dengan benar';
                return false;
            }else{
                document.getElementById("v2").innerHTML = ''; //tampilkan persan error ke id v1             
            }
            
            if($("#cek1").is(':checked') && password1 == ""){
                pe[3].classList.add("error"); //tambah class error pada form
                document.getElementById("passwordA").focus(); //set fokus pada textfield
                document.getElementById("v4").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v4").innerHTML = '';
            }
            
            if($("#cek1").is(':checked') && $('#passwordA').val().length < 6){
                pe[3].classList.add("error"); //tambah class error pada form
                document.getElementById("passwordA").focus(); //set fokus pada textfield
                document.getElementById("v4").innerHTML = 'Password minimal 6 karakter'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v4").innerHTML = '';
            }
            
            if($("#cek1").is(':checked') && $('#passwordB').val() == ""){
                pe[4].classList.add("error"); //tambah class error pada form
                document.getElementById("passwordB").focus(); //set fokus pada textfield
                document.getElementById("v5").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v5").innerHTML = '';
            }
            
            if($("#cek1").is(':checked') && password2 != password1){
                pe[4].classList.add("error");
                document.getElementById("passwordB").focus(); //set fokus pada textfield
                document.getElementById("v5").innerHTML = 'Konfirmasi Password tidak sama'; //tampilkan persan error ke id v1
                return false;
            }else{ //jika lolos validasi lanjut ke proses simpan data
                document.getElementById("v5").innerHTML = '';
            }

            if($("#cek2").is(':checked') && foto == ""){
                pe[5].classList.add("error"); //tambah class error pada form
                document.getElementById("foto").focus(); //set fokus pada textfield
                document.getElementById("v6").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v6").innerHTML = '';
            }

            if($("#cek2").is(':checked') && CheckExtensionIMG($('#foto')[0].files[0].name) == false){  //cek tipe file  
                $('#v6').html('Tipe file tidak didukung!');
                $('#foto').focus();
                $('#ftt').addClass('error');
                return false; 
            }else{ 

            

            
            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
/**/
            data.append('nama', $("#nama").val()); 
            data.append('email', $("#email").val()); 
            data.append('username', $("#username").val()); 
            data.append('password', $("#passwordA").val()); 
            data.append('fl', $("#fl").val()); 
            data.append('level', $("#level").val()); 
            data.append('foto', $("#foto")[0].files[0]); 
            data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi

            
                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['lightBlue'];

                        var $loading = $('#card1').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });
            
            $.ajax({
                url: 'profil-aksi.php', // File tujuan
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
                        $("#view").load('profil-data.php');
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

