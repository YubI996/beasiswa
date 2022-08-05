
    $(document).ready(function(){

        $("#v1").hide();
        $("#v2").hide();
        $("#btn-load").hide();
        $("#btn-stop").hide();
        $("#btn-reset").hide();
        $("#reseter").hide();

         $(".btc").click(function(){ 
            $("#v1").fadeOut(700);            
            $("#v2").fadeOut(700);            
         });

         $("#btn-login").click(function(){ 
            
            
            var username = $("#username").val();
            var password = $("#password").val();

            if (username == "") {
                $("#v1").fadeIn(700);
                return false;
            }else{
                $("#v1").hide();                
            }
            if (password == "") {
                $("#v2").fadeIn(700);
                return false;
            }else{
                $("#v2").hide();                
            

            var data = new FormData();
            data.append('username', username); 
            data.append('password', password); 
         

                        var effect = 'timer';

                        var $loading = $('#card1').waitMe({
                            effect: effect,
                            text: 'Autentikasi User...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: '#fcb215'
                        });

            $.ajax({
                url: 'login_user.php', // File tujuan
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
                        
                        var status = response.status;
                        var hal = response.hal;
                        var judul = response.title;
                        var pesan = response.pesan;
                        var tipe = response.tipe;
                        var waktu = response.waktu;
                        if (status == "solol") {
                            $("#btn-stop").click(); 
                            $("#btn-reset").click(); 
                            window.location = hal;
                        }else{
                        //munculkan pesan dengan sweetalert
                        swal({
                            title: ''+judul,
                            text:  ''+pesan,
                            type: ''+tipe,
                            timer: waktu,
                            showConfirmButton: false
                        });     

                        $("#btn-stop").click(); 
                        $("#btn-reset").click(); 

                        }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //munculkan pesan error dengan sweetalert
                    $('#card1').waitMe('hide'); // Sembunyikan loading ubah
                        swal({
                            title: 'ERROR!',
                            text:  'Error : ' +xhr.responseText,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                        $("#btn-stop").click(); 
                        $("#btn-reset").click(); 
                }
            });
        }

         }); //btn-login


         //reset password
         $("form#respasswd").submit(function(e){ 
            e.preventDefault();
            
            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var email = $("#email2").val(); 

            if (email == "") {
                errorFocus('v61', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v61');
            }
            if (!email.match(re)) {
                errorFocus('v61', 'Masukkan Email dengan benar');
                return false;
            }else{
                errorClear('v61');                
            

            var data = new FormData();
            data.append('email', email);  
            data.append('aksi', 'reset');  
         

                        var effect = 'timer';

                        var $loading = $('#card3').waitMe({
                            effect: effect,
                            text: 'Autentikasi User...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: '#fcb215'
                        });

            $.ajax({
                url: 'login_user.php', // File tujuan
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
             
                    $('#card3').waitMe('hide'); // Sembunyikan loading ubah
                        
                        var status = response.status;
                        var hal = response.hal;
                        var judul = response.title;
                        var pesan = response.pesan;
                        var tipe = response.tipe;
                        var waktu = response.waktu;

                        //munculkan pesan dengan sweetalert
                        swal({
                            title: ''+judul,
                            text:  ''+pesan,
                            type: ''+tipe,
                            timer: waktu,
                            showConfirmButton: false
                        });     
                        
                        $('#btl1').click();
                        $("form").trigger('reset');  
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //munculkan pesan error dengan sweetalert
                    $('#card1').waitMe('hide'); // Sembunyikan loading ubah
                        swal({
                            title: 'ERROR!',
                            text:  'Error : ' +xhr.responseText,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                        $("#btn-stop").click(); 
                        $("#btn-reset").click(); 
                }
            });
        }

         }); //reset pass






function errorFocus(idpesan, pesan){
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idpesan){
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
}


         $("#btn-register").click(function(){ 
            
            
            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var re1 = /^[0-9]+$/;
            var ktm = $("#ktm1").val();
            var ktp = $("#ktp1").val();
            var nama = $("#nama1").val();
            var email = $("#email1").val();
            //var username = $("#username1").val();
            //var password = $("#password1").val();

            if (ktm == "") {
                errorFocus('v3', 'Field tidak boleh kosong.');
                return false;
            }else{
                errorClear('v3');
            }
            /*if (!ktm.match(re1)) {
                errorFocus('v3', 'Inputan Harus Angka');
                return false;
            }else{
                errorClear('v3');
            }*/
            if (ktm.length < 3) {
                errorFocus('v3', 'KTM Minimal 3 Digit');
                return false;
            }else{
                errorClear('v3');
            }
            if (ktp == "") {
                errorFocus('v4', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v4');
            }
            if (!ktp.match(re1)) {
                errorFocus('v4', 'Inputan Harus Angka');
                return false;
            }else{
                errorClear('v4');
            }
            if (ktp.length < 16) {
                errorFocus('v4', 'Inputan Minimal 16 Digit (Inputan : '+ktp.length+' dari 16)');
                return false;
            }else{
                errorClear('v4');
            }
            if (ktp == "") {
                errorFocus('v4', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v4');
            }
            if (nama == "") {
                errorFocus('v5', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v5');
            }
            if (email == "") {
                errorFocus('v6', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v6');
            }
            if (!email.match(re)) {
                errorFocus('v6', 'Masukkan Email dengan benar');
                return false;
            }else{
                errorClear('v6');
            /*}
            if (username == "") {
                errorFocus('v7', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v7');
            }
            if (password == "") {
                errorFocus('v8', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear('v8');
            }
            if (password.length < 6) {
                errorFocus('v8', 'Password Minimal 6 karakter (Inputan : '+password.length+' dari 6)');
                return false;
            }else{
                errorClear('v8');*/
            
            

            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
            data.append('nama', $("#nama1").val()); // Ambil data keterangan
            data.append('email', $("#email1").val()); // Ambil data keterangan
            //data.append('username', $("#username1").val()); // Ambil data keterangan
            //data.append('password', $("#password1").val()); // Ambil data keterangan
            data.append('ktm', $("#ktm1").val()); // Ambil data keterangan
            data.append('ktp', $("#ktp1").val()); // Ambil data keterangan

            
                        var effect = 'timer';

                        var $loading = $('#card2').waitMe({
                            effect: effect,
                            text: 'Sedang menyimpan data...',
                            bg: 'rgba(255,255,255,0.90)',
                            color: '#fcb215'
                        });
            
            $.ajax({
                url: 'registrasi_user.php', // File tujuan
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
                        
                    $('#card2').waitMe('hide'); // Sembunyikan loading ubah
                        var status = response.status;
                        var judul = response.title;
                        var pesan = response.pesan;
                        var tipe = response.tipe;
                        var waktu = response.waktu;

                        $('#btl').click();
                        //munculkan pesan dengan sweetalert
                        swal({
                            title: ''+judul,
                            text:  ''+pesan,
                            type: ''+tipe,
                            timer: waktu,
                            html: true,
                            showConfirmButton: false
                        });     
                        
                        $("#reseter").click();
                        $("#btn-stop").click(); 
                        $("#btn-reset1").click(); 
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //munculkan pesan error dengan sweetalert
                        //document.write(xhr.responseText);
                        $('#card2').waitMe('hide'); // Sembunyikan loading ubah
                        $('#btl').click();
                        
                        swal({
                            title: 'ERROR!',
                            text:  'Error : ' +ajaxOptions+'<br>'+thrownError,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });
                        
                        $("#btn-stop").click(); 
                        $("#btn-reset1").click(); 

                }
            });
        }

         }); //btn-register

        $('#modalUser').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset").click(); 
            $("#btn-reset1").click();  
            $("#v1").hide();
            $("#v2").hide();
            $("#btn-load").hide();
            $("#btn-stop").hide();
            $("#btn-reset").hide();

            document.getElementById("v3").innerHTML = '';  
            document.getElementById("v4").innerHTML = '';  
            document.getElementById("v5").innerHTML = '';  
            document.getElementById("v6").innerHTML = '';  
            document.getElementById("v7").innerHTML = '';  
            document.getElementById("v8").innerHTML = '';  
        });

    }); //document ready





    
function get(property){
var url=window.location.search;
  url=url.substring(1).split('&');
  for(var i=0;i < url.length;i++){
    var data=url[i].split('=');
    if(data[0] == property){
      return data[1];
    }
  }
}
 
    if(get('msg') == "bL"){ //pesan ketika belum Login
       setTimeout(function () {     
            swal({
                title: 'AKSES DITOLAK!',
                text:  'Maaf Anda harus Login terlebih dahulu!',
                type: 'error',
                timer: 5000,
                html: true,
                showConfirmButton: true
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,5000); 
    }  

    if(get('msg') == "bA"){ //pesan ketika berhasil aktivasi
       setTimeout(function () {     
            swal({
                title: 'ACTIVATED!',
                text:  'Akun Anda telah teraktivasi, silakan login dengan Username dan Password Anda!',
                type: 'success',
                timer: 5000,
                html: true,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,5000); 
    }  

    if(get('msg') == "uB"){ //pesan ketika berhasil aktivasi
       setTimeout(function () {     
            swal({
                title: 'BLOCKED!',
                text:  'Akun Anda telah di non-aktifkan oleh Administrator e-Beasiswa, Silakan hubungi Administrator e-Beasiswa untuk mengaktivasi kembali!',
                type: 'error',
                timer: 5000,
                html: true,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,5000); 
    }  

    if(get('msg') == "sA"){ //pesan ketika berhasil aktivasi
       setTimeout(function () {     
            swal({
                title: 'Ups!',
                text:  'Link Aktivasi telah kadaluarsa!<br>Silakan hubungi Administrator e-Beasiswa.',
                type: 'info',
                timer: 5000,
                html: true,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,5000); 
    }  

    if(get('msg') == "uGD"){ //pesan ketika berhasil aktivasi
       setTimeout(function () {     
            swal({
                title: 'NOT FOUND!',
                text:  'Akun Anda tidak ditemukan, mungkin saja Akun Anda telah dihapus oleh Admin karena sesuatu hal silakan hubungi Administrator e-Beasiswa.',
                type: 'warning',
                timer: 5000,
                html: true,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,5000); 
    }  
