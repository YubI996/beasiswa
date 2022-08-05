    $(document).ready(function(){

         $("#loader").hide();


         $("#btn-login").click(function(){ 
            
         $("#or").hide(); 
         $("#loader").show(); 
            
            var username = $("#username").val();
            var password = $("#password").val();

            var data = new FormData();
            data.append('username', username); 
            data.append('password', password); 

            $.ajax({
                url: 'login-user.php', // File tujuan
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
                    $("#loader").hide(); // Sembunyikan loading simpan
                    $("#or").show(); // Sembunyikan loading simpan
                    
                        
                        var judul = response.title;
                        var pesan = response.pesan;
                        var tipe = response.tipe;
                        var waktu = response.waktu;
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: ''+judul,
                            text:  ''+pesan,
                            type: ''+tipe,
                            timer: waktu,
                            showConfirmButton: false
                        });     
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //munculkan pesan error dengan sweetalert
                        swal({
                            title: 'ERROR!',
                            text:  'Error : ' +xhr.responseText+' '+ajaxOptions+' '+thrownError,
                            type: 'error',
                            html: true,
                            showConfirmButton: true
                        });     
                }
            });

         });
    });


    
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


var usernm = get('usr');
var eml = get('eml');

    if(get('msg') == "bR"){ //pesan berhasil registrasi

        setTimeout(function () {    
            swal({
                title: 'Berhasil',
                text:  'Berhasil Registrasi! \nSilakan Buka Email Anda untuk mengaktivasi Akun Anda.',
                type: 'success',
                timer: 6000,
                showConfirmButton: false
            });     
        },10);  
        window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }
    
    if(get('msg') == "gR"){ // pesan gagal registrasi
var pesan = get('psn');
var psnBaru = pesan.replace(/_/g, ' '); 
        setTimeout(function () {    
            swal({
                title: 'Gagal',
                text:  'Gagal melakukan registrasi!  \nError : ' + psnBaru + '!',
                type: 'error',
                timer: 6000,
                showConfirmButton: false
            });     
        },10);  
        window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 

    }

    if(get('msg') == "gU"){ //pesan ketika username sama
       setTimeout(function () {     
            swal({
                title: 'Gagal',
                text:  'Maaf Username `' + usernm + '` sudah dipakai, silakan gunakan nama yang lain!',
                type: 'error',
                timer: 4000,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }

    if(get('msg') == "gE"){ //pesan ketika username sama
       setTimeout(function () {     
            swal({
                title: 'Gagal',
                text:  'Maaf Email `' + eml + '` sudah dipakai, silakan gunakan email yang lain!',
                type: 'error',
                timer: 4000,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }

    
    if(get('msg') == "gL"){ //pesan ketika gagal Login
       setTimeout(function () {     
            swal({
                title: 'Gagal',
                text:  'Maaf username atau password Anda salah, silakan ulangi dengan benar!',
                type: 'error',
                timer: 4000,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }  

    if(get('msg') == "bL"){ //pesan ketika belum Login
       setTimeout(function () {     
            swal({
                title: 'AKSES DITOLAK!',
                text:  'Maaf Anda harus Login terlebih dahulu!',
                type: 'error',
                timer: 4000,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }  

    if(get('msg') == "bA"){ //pesan ketika berhasil aktivasi
       setTimeout(function () {     
            swal({
                title: 'ACTIVATED!',
                text:  'Akun Anda telah teraktivasi, silakan login dengan Username dan Password Anda!',
                type: 'success',
                timer: 4000,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }  

    if(get('msg') == "bA1"){ //pesan ketika belum aktivasi
       setTimeout(function () {     
            swal({
                title: 'NOT-ACTIVATED!',
                text:  'Akun Anda belum diaktivasi, silakan buka email Anda dan aktivasi akun Anda!',
                type: 'error',
                timer: 4000,
                showConfirmButton: false
            });     
        },10);  
       window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 
    }  
    
    if(get('msg') == "gA"){ // pesan gagal aktivasi akun
var pesan = get('psn');
var psnBaru = pesan.replace(/_/g, ' '); 
        setTimeout(function () {    
            swal({
                title: 'Gagal',
                text:  'Gagal melakukan Aktivasi Akun!  \nError : ' + psnBaru + '! \nSilakan hubungi Administrator melalui email.',
                type: 'error',
                timer: 6000,
                showConfirmButton: false
            });     
        },10);  
        window.setTimeout(function(){ 
            window.location.replace('login-register.php');
        } ,4000); 

    }
