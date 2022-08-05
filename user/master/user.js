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
function viewfile(id){

                    var data = new FormData();
                    data.append('id_user', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'user-aksi.php', 
                        type: 'POST', 
                        data: data,  
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        beforeSend: function(e) {
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        },
                        success: function(response){  

                            var data2 = response.foto;

                            var id = response.id; // Ambil id dari input type hidden
                            var nama = response.nama; 
                            var email = response.email; 
                            var level = response.level; 
                            var aktivasi = response.statusA; 
                            var kode = response.kodeA; 
                            var last = response.lastlog; 
                            var since = response.since; 
                            var username = response.username; 
                            if (aktivasi == '1') {
                                var status = 'Teraktivasi';
                            }else{
                                var status = 'Belum Teraktivasi';
                            }
 
                            $("#md").html('Lihat User - ' + nama); //ubah title modal view file

                                var vf = '<div class="col-md-12"><img src="foto_user/'+ data2 +'" style="height:auto; width:130px; margin:0px 10px 5px 0px; "></div><div class="col-md-12"><table width="100%" ><tr><tdvalign="top"><table class="table"><tr><td width="35%"><strong>ID User</strong></td><td width="65%">: '+id+'</td></tr><tr><td><strong>Nama User</strong></td><td style="word-wrap: break-word; word-break: break-all; white-space: normal;">: '+nama+'</td></tr><tr><td><strong>Email</strong></td><td style="word-wrap: break-word; word-break: break-all; white-space: normal;">: '+email+'</td></tr><tr><td><strong>Level</strong></td><td>: '+level+'</td></tr><tr><td><strong>Bergabung Sejak</strong></td><td>: '+since+'</td></tr><tr><td><strong>Terakhir Login</strong></td><td>: '+last+'</td></tr><tr><td><strong>Kode Aktivasi</strong></td><td>: '+kode+'</td></tr><tr><td><strong>Status Aktivasi</strong></td><td>: '+status+'</td></tr></table></td></tr></table></div>'; 

                            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
                                                
                        }
                
                    });

}



    $(document).ready(function(){

            var main = "user-data.php"; 
            $("#view").load(main); //tampilkan data unduhan saat halaman dibuka

        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan, #datamhs, #datamhs1, #pesan-validasi, #btn-reset, #btn-reset1").hide();
        
        $("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
        
            // Set judul modal dialog menjadi Form Tambah Data
            $("#modal-title").html('Form Tambah data');
            $("#btn-simpan1").show();
        });

        
        $("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var nama = document.getElementById("nama1").value; //validasi data kosong
            var email = document.getElementById("email1").value; //validasi data kosong
            var username = document.getElementById("username1").value; //validasi data kosong
            var password = document.getElementById("password1").value; //validasi data kosong
            var level = document.getElementById("level1").value; //validasi data kosong
            var ktm = document.getElementById("ktm1").value; //validasi data kosong
            var ktp = document.getElementById("ktp1").value; //validasi data kosong
            var pe = document.querySelectorAll(".form-line");
            if (nama == "") {
                pe[0].classList.add("error"); //tambah class error pada form
                document.getElementById("nama1").focus(); //set fokus pada textfield
                document.getElementById("v1").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }
            else{
                document.getElementById("v1").innerHTML = ''; //tampilkan persan error ke id v1

            } if(email == "" || !re.test(email)) {
                pe[1].classList.add("error"); //tambah class error pada form
                document.getElementById("email1").focus(); //set fokus pada textfield
                document.getElementById("v2").innerHTML = 'Masukkan Alamat Email dengan benar'; //tampilkan persan error ke id v1
                return false;
            }
            else{
                 document.getElementById("v2").innerHTML = ''; //tampilkan persan error ke id v1
            
            } if(username == ""){
                pe[2].classList.add("error"); //tambah class error pada form
                document.getElementById("username1").focus(); //set fokus pada textfield
                document.getElementById("v3").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }
            else{
                document.getElementById("v3").innerHTML = ''; //tampilkan persan error ke id v1

            } if(password == "" || password.length < 6){
                pe[3].classList.add("error"); //tambah class error pada form
                document.getElementById("password1").focus(); //set fokus pada textfield
                document.getElementById("v4").innerHTML = 'Password minimal 6 karakter'; //tampilkan persan error ke id v1
                return false;
            }
            else{
                 document.getElementById("v4").innerHTML = ''; //tampilkan persan error ke id v1
            
            } if(level == ""){
                pe[4].classList.add("error"); //tambah class error pada form
                document.getElementById("level1").focus(); //set fokus pada textfield
                document.getElementById("v5").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }
            else{
                 document.getElementById("v5").innerHTML = ''; //tampilkan persan error ke id v1
            
            } if(level == "Mahasiswa" && ktm == ""){
                pe[5].classList.add("error"); //tambah class error pada form
                document.getElementById("ktm1").focus(); //set fokus pada textfield
                document.getElementById("v6").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }
            else{
                 document.getElementById("v6").innerHTML = ''; //tampilkan persan error ke id v1
            
            } if(level == "Mahasiswa" && ktp == ""){
                pe[6].classList.add("error"); //tambah class error pada form
                document.getElementById("ktp1").focus(); //set fokus pada textfield
                document.getElementById("v7").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{ //jika lolos validasi lanjut ke proses simpan data

            
            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
            data.append('nama', $("#nama1").val()); // Ambil data keterangan
            data.append('email', $("#email1").val()); // Ambil data keterangan
            data.append('username', $("#username1").val()); // Ambil data keterangan
            data.append('password', $("#password1").val()); // Ambil data keterangan
            data.append('level', $("#level1").val()); // Ambil data keterangan
            data.append('ktm', $("#ktm1").val()); // Ambil data keterangan
            data.append('ktp', $("#ktp1").val()); // Ambil data keterangan
            data.append('aksi', 'add'); // set data aksi = add untuk pembanding aksi

            
            $("#loading-simpan").show(); // Munculkan loading simpan
            
            $.ajax({
                url: 'user-aksi.php', // File tujuan
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
                        
                        $("#view").load('user-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil disimpan!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });     

                        $("#form-modal").modal('hide'); // Close / Tutup Modal Dialog
                    }else{ // Jika statusnya = gagal
                        
                        //tampilkan pesan error
                        $("#pesan-error").show();
                        document.getElementById('pesan-error').innerHTML = response.pesan;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        $("#form-modal").modal('hide'); // Close / Tutup Modal Dialog
                        $("#view").load('user-data.php');

                        $("#form-user").fadeOut(); 
                        $("#view").fadeIn(); 

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

            //var ktm = document.getElementById("ktm2").value; //validasi data kosong
            //var ktp = document.getElementById("ktp2").value; //validasi data kosong

        $("#btn-ubah").click(function(){ // Ketika tombol simpan di klik

            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var re1 = /^[0-9]+$/;
            var nama = document.getElementById("nama2").value; //validasi data kosong
            var email = document.getElementById("email2").value; //validasi data kosong
            var ceklisF = document.getElementById("ceklis1").value; //validasi data kosong
            var foto = document.getElementById("foto").value; //validasi data kosong
            var level = document.getElementById("level2").value; //validasi data kosong
            var username = document.getElementById("username2").value; //validasi data kosong
            var ceklisP = document.getElementById("ceklis2").value; //validasi data kosong
            var password1 = document.getElementById("passwordA").value; //validasi data kosong
            var password2 = document.getElementById("passwordB").value; //validasi data kosong
            var aktivasi = document.getElementById("cek-aktivasi").value; //validasi data kosong
            var pe = document.querySelectorAll(".fr");
            var pe1 = document.querySelectorAll(".fr1");
            if (nama == "" || nama == 0) {
                pe[0].classList.add("error"); //tambah class error pada form
                document.getElementById("nama2").focus(); //set fokus pada textfield
                document.getElementById("v8").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v8").innerHTML = ''; //tampilkan persan error ke id v1             
            }

            if(email == "" || email == 0) {
                
                pe[1].classList.add("error"); //tambah class error pada form
                document.getElementById("email2").focus(); //set fokus pada textfield
                document.getElementById("v9").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v9").innerHTML = ''; //tampilkan persan error ke id v1             
            }

            if(!re.test(email)) {
                
                pe[1].classList.add("error"); //tambah class error pada form
                document.getElementById("email2").focus(); //set fokus pada textfield
                document.getElementById("v9").innerHTML = 'Masukkan Email dengan benar';
                return false;
            }else{
                document.getElementById("v9").innerHTML = ''; //tampilkan persan error ke id v1             
            }
            
            if(ceklisF == "1" && foto == ""){
                pe[2].classList.add("error"); //tambah class error pada form
                document.getElementById("foto").focus(); //set fokus pada textfield
                document.getElementById("v10").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v10").innerHTML = '';
            }
            
            if(username == "" || username == 0){
                pe1[0].classList.add("error"); //tambah class error pada form
                document.getElementById("username2").focus(); //set fokus pada textfield
                document.getElementById("v14").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v14").innerHTML = '';
            }
            
            if(ceklisP == "1" && password1 == ""){
                pe1[1].classList.add("error"); //tambah class error pada form
                document.getElementById("passwordA").focus(); //set fokus pada textfield
                document.getElementById("v15").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v15").innerHTML = '';
            }
            
            if(ceklisP == "1" && $('#passwordA').val().length < 6){
                pe1[1].classList.add("error"); //tambah class error pada form
                document.getElementById("passwordA").focus(); //set fokus pada textfield
                document.getElementById("v15").innerHTML = 'Password minimal 6 karakter'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v15").innerHTML = '';
            }
            
            if(ceklisP == "1" && $('#passwordB').val() == ""){
                pe1[2].classList.add("error"); //tambah class error pada form
                document.getElementById("passwordB").focus(); //set fokus pada textfield
                document.getElementById("v16").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v16").innerHTML = '';
            }
            
            if(ceklisP == "1" && password2 != password1){
                pe1[2].classList.add("error");
                document.getElementById("passwordB").focus(); //set fokus pada textfield
                document.getElementById("v16").innerHTML = 'Konfirmasi Password tidak sama'; //tampilkan persan error ke id v1
                //return false;
            }else{ //jika lolos validasi lanjut ke proses simpan data

            
            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
/**/
            data.append('id_user', $("#id_user").val()); // Ambil data keterangan
            data.append('nama', $("#nama2").val()); // Ambil data keterangan
            data.append('email', $("#email2").val()); // Ambil data keterangan
            data.append('username', $("#username2").val()); // Ambil data keterangan
            data.append('password', $("#passwordA").val()); // Ambil data keterangan
            data.append('level', $("#level2").val()); // Ambil data keterangan
            data.append('aktivasi', $("#cek-aktivasi").val()); // Ambil data keterangan
            data.append('fl', $("#data-fl").val()); // Ambil data keterangan
            data.append('foto', $("#foto")[0].files[0]); // Ambil data keterangan
            data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi

            
            $("#loading-ubah").show(); // Munculkan loading simpan
            
            $.ajax({
                url: 'user-aksi.php', // File tujuan
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

                    $("#loading-ubah").hide(); // Sembunyikan loading ubah
                    
                    if(response.status == "sukses"){ // Jika Statusnya = sukses

                        // Ganti isi dari div view dengan view yang diambil dari proses_ubah.php
                        $("#view").load('user-data.php');
                        
                        //munculkan pesan berhasil dengan sweetalert
                        swal({
                            title: 'Berhasil!',
                            text:  'Data berhasil diubah!',
                            type: 'success',
                            timer: 1800,
                            showConfirmButton: false
                        });     
                        
                        $("#form-modal1").modal('hide'); // Close / Tutup Modal Dialog

                    }else{ // Jika statusnya = gagal

                        //tampilkan pesan error

                        $("#pesan-error").show();
                        document.getElementById('pesan-error').innerHTML = response.pesan;
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

                }
            });

          }  

        });
    



        $('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset").click(); // Klik tombol reset agar form kembali bersih
            $("#id_user").removeAttr('readonly'); // Enable textbox id_unduhan
            $("#loading-ubah, #loading-simpan, #datamhs, #datamhs1, #pesan-validasi, #btn-reset, #btn-reset1").hide();
            $("#foto").show(); // tampilkan cek ubah file  
            $("#btn-simpan").show();
            
            var pe = document.querySelectorAll(".form-line");
            pe[0].classList.remove("error"); //hapus class error pada form
            pe[1].classList.remove("error"); //hapus class error pada form
            pe[2].classList.remove("error"); //hapus class error pada form
            pe[3].classList.remove("error"); //hapus class error pada form
            pe[4].classList.remove("error"); //hapus class error pada form
            pe[5].classList.remove("error"); //hapus class error pada form
            pe[6].classList.remove("error"); //hapus class error pada form
            document.getElementById("v1").innerHTML = ''; //hilangkan teks error pada id v1
            document.getElementById("v2").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v3").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v4").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v5").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v6").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v7").innerHTML = ''; //hilangkan teks error pada id v2
        });
        $('#form-modal1').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

            $("#btn-reset1").click(); // Klik tombol reset agar form kembali bersih
            $('#ultabs a:first').tab('show');
            $("#loading-ubah, #loading-simpan, #datamhs, #datamhs1, #pesan-validasi, #btn-reset, #btn-reset1").hide();
            $("#btn-simpan").show();
            
            var pe = document.querySelectorAll(".fr");
            var pe1 = document.querySelectorAll(".fr1");
            pe[0].classList.remove("error"); //hapus class error pada form
            pe[1].classList.remove("error"); //hapus class error pada form
            pe[2].classList.remove("error"); //hapus class error pada form
            pe1[0].classList.remove("error"); //hapus class error pada form
            pe1[1].classList.remove("error"); //hapus class error pada form
            pe1[2].classList.remove("error"); //hapus class error pada form
            document.getElementById("v1").innerHTML = ''; //hilangkan teks error pada id v1
            document.getElementById("v2").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v3").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v4").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v5").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v6").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v7").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v8").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v9").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v10").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v14").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v15").innerHTML = ''; //hilangkan teks error pada id v2
            document.getElementById("v16").innerHTML = ''; //hilangkan teks error pada id v2
        });


    });


/*
            if(level == "Mahasiswa" && ktm == ""){
                pe[3].classList.add("error"); //tambah class error pada form
                document.getElementById("ktm2").focus(); //set fokus pada textfield
                document.getElementById("v12").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v12").innerHTML = '';
            }
            
            if(level == "Mahasiswa" && !ktm.match(re1)){
                pe[3].classList.add("error"); //tambah class error pada form
                document.getElementById("ktm2").focus(); //set fokus pada textfield
                document.getElementById("v12").innerHTML = 'Inputan harus angka'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v12").innerHTML = '';
            }

            if(level == "Mahasiswa" && ktp == ""){
                pe[4].classList.add("error"); //tambah class error pada form
                document.getElementById("ktp2").focus(); //set fokus pada textfield
                document.getElementById("v13").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v13").innerHTML = '';
            }
            
            if(level == "Mahasiswa" && !ktp.match(re1)){
                pe[4].classList.add("error"); //tambah class error pada form
                document.getElementById("ktp2").focus(); //set fokus pada textfield
                document.getElementById("v13").innerHTML = 'Inputan harus angka'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v13").innerHTML = '';
            }
            
            if(level == "Mahasiswa" && ktp.length < 16){
                pe[4].classList.add("error"); //tambah class error pada form
                document.getElementById("ktp2").focus(); //set fokus pada textfield
                document.getElementById("v13").innerHTML = 'No. KTP minimal 16 angka'; //tampilkan persan error ke id v1
                return false;
            }else{
                document.getElementById("v13").innerHTML = '';
            }
            */