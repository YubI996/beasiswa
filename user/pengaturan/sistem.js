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
$("#publish").click(function(){        

        swal({
        title: "Publikasikan hasil seleksi?",
        text: "Sistem penerimaan akan otomatis ditutup, pastikan Anda telah selesai memverifikasi data. Data akan ditampilkan di halaman pengumuan penerima beasiswa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#03A9F4',
        confirmButtonText: 'Ya, Publikasikan!',
        cancelButtonText: 'Tidak',
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        //closeOnCancel: false
    },
    function(){ //jika di konfirmasi = Ya

            var data = new FormData();
            data.append('periode', $("#periodee1").val()); 
            data.append('publish', '1'); 
            data.append('sett', 'publish'); 

            $.ajax({
                url: 'set-beasiswa.php', // File tujuan
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
                    if (response.status == 'sukses') {
                    swal({
                                title: 'Berhasil!',
                                text:  'Berhasil mempublikasikan dan mengirim notifikasi!',
                                type: 'success',
                                timer: 1800,
                                showConfirmButton: true
                            });

                    location.reload();

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
                    location.reload();     
                }
            });

        });
                                       
    });





    var auto_refreshv = setInterval(
    function () {
            $.ajax({
                url: 'sistem-aksi.php?cek=cek', // File tujuan
                type: 'POST', // Tentukan type nya POST atau GET
                data: {aksi: '1'}, // Set data yang akan dikirim
                processData: false,
                contentType: false,
                dataType: "json",
                global: false,
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil
                    $('#sw').html(response.batas)
                },
            });
    }, 1000);

        $(document).ready(function(){
        // Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
        $("#loading-ubah, #loading-simpan, #pesan-validasi, #btn-reset").hide();
        

        $("#btn-ubah").click(function(){ // Ketika tombol simpan di klik

            // Buat variabel data untuk menampung data hasil input dari form
            var data = new FormData();
/**/
            data.append('periode', $("#periodee1").val()); 
            data.append('pp', $("#pp").val()); 
            data.append('pta', $("#pta").val()); 
            data.append('tglB', $("#tglB").val()); 
            data.append('tglT', $("#tglT").val()); 
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
                url: 'sistem-aksi.php', // File tujuan
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
                        $("#view").load('sistem-data.php');
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

        });
    



    });

