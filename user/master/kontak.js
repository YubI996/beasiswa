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
        $("#loading-ubah, #loading-simpan, #pesan-validasi, #btn-reset").hide();
        
        $("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
        
            // Set judul modal dialog menjadi Form Tambah Data
            $("#modal-title").html('Form Tambah data');
            $("#btn-simpan").show();
        });

        
        $("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var email = document.getElementById("email").value; //validasi data kosong
            var pe = document.querySelectorAll(".form-line");
            if(email.length > 0 && !re.test(email)) {
                pe[0].classList.add("error"); //tambah class error pada form
                document.getElementById("email").focus(); //set fokus pada textfield
                document.getElementById("v1").innerHTML = 'Masukkan Alamat Email dengan benar';  
                return false;
            }
            else{
                 document.getElementById("v1").innerHTML = '';  
            
        
            
             //jika lolos validasi lanjut ke proses simpan data

            
            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
            data.append('email', $("#email").val()); 
            data.append('telp', $("#telp").val()); 
            data.append('fax', $("#fax").val()); 
            data.append('alamat', $("#alamat").val()); 
            data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi

            
                        var effect = 'timer';
                        var color = $.AdminBSB.options.colors['lightblue'];

                        var $loading = $('#card1').waitMe({
                            effect: effect,
                            text: 'Loading...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: color
                        });
            
            $.ajax({
                url: 'kontak-aksi.php', // File tujuan
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
                        $("#view").load('kontak-data.php');
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

            }

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


