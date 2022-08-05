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


$(document).ready(function(){

$('input.vr').on('change', function(){ // on change of state
   $('input.vr').not(this).prop('checked', false);
   $('.vdt').html('');
   var vR = $(this).attr('value');
   $("#vR").val(vR);
});





            var main = "berkasP-K-data.php"; 
            $("#view").load(main); //tampilkan data unduhan saat halaman dibuka

        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan,  #pesan-validasi, .ck, #btn-reset, #btn-tutup").hide();
        
        $("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
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

            if ($('#tabs1').val() == 4) {
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
                $("#btn-simpan").hide(); 
                $("#btn-next").show(); 
                $("#btn-prev").show(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").removeAttr('disabled');
                $("#btn-prev").attr('class', 'btn bg-teal waves-effect');
        });
        $("#2").click(function(){ 
                $("#btn-simpan").hide(); 
                $("#btn-next").show(); 
                $("#btn-prev").show(); 
                $("#btn-prev").removeAttr('class');
                $("#btn-prev").removeAttr('disabled');
                $("#btn-prev").attr('class', 'btn bg-teal waves-effect');
        });

        $("#1").click(function(){ 
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



        $("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

            var id_bp = document.getElementById("id_bp").value;
            var ver = document.getElementById("vR").value;
            var ket = document.getElementById("keterangan").value;


            // Buat variabel data untuk menampung data hasil input dari form
                   var data = new FormData();
                    data.append('id_bp', id_bp); 
                    data.append('verifikasi', ver); 
                    data.append('keterangan', ket); 
                    data.append('aksi', 'verifying'); 

            //document.write(suratP);
            $("#loading-simpan").show(); // Munculkan loading simpan
            
            $.ajax({
                url: 'berkasP-K-aksi.php', // File tujuan
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
                        
                        $("#view").load('berkasP-K-data.php');
                        
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
                    }else{ // Jika statusnya = gagal
                        
                        //tampilkan pesan error
                        $("#pesan-error").show();
                        document.getElementById('pesan-error').innerHTML = response.pesan;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                        //$("#1").click();
                        $("#btn-reset").click();  
                        $("#form-modal").modal('hide'); // Close / Tutup Modal Dialog
                        $("#view").load('berkasP-K-data.php');

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
            $('#ultabs a:first').tab('show');

            $("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-reset").hide();

            $(".vdt").html('');
            $("#ultabs").removeAttr('class');
            $("#ultabs").attr('class', 'nav nav-tabs tab-nav-right');
            $("#id_mahasiswa").val('').change();
            $("#periode").val('').change();
        });
        $('#form-file1').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup
            $("#5").click(); // Klik tombol reset agar form kembali bersih
            $('#ultabs a:first').tab('show');
        });



        $(".viewfile1").click(function(){  
            var data1 = $(this).attr('data-file');  
            $("#md").html('Lihat File - '+data1);  

            var filedata = data1.substr(-3); //cek ekstensi file

            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a><hr><img src="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a>';
                var vf = 'https://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1;
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
                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a><hr><img src="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
                document.getElementById('view-file').innerHTML = vf;
            }
            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
                document.getElementById('view-file').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1+'" download>'+data1+'</a>';
                var vf = 'https://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=https://e-beasiswa.bontangkota.go.id/user/beasiswa/file_berkas_pr/'+ data1;
                window.open(vf);
            }else{
                var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">File tidak ada! User tidak mengupload berkas ini.</span></div>'; //jika berekstensi lain                
                document.getElementById('view-file').innerHTML = vf;
            }
        });

    });


