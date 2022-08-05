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
                    data.append('id_persyaratan', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'persyaratan-aksi.php', 
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
  
				            var data1 = response.keterangan; 
				            var data2 = response.persyaratan;  
				            $("#md").html('Lihat Persyaratan - '+data1);  


				                var vf = '<h3>'+ data1 +'</h3><br>'+ data2;

				            document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
                                                
                        }
                
                    });

}


	$(document).ready(function(){

    		var main = "persyaratan-data.php"; 
			$("#view").load(main); //tampilkan data unduhan saat halaman dibuka

		// Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
		$("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-reset").hide();
		
		$("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
			$("#btn-ubah").hide(); // Sembunyikan tombol ubah 
			$("#btn-simpan").show(); // Munculkan tombol simpan
			
			// Set judul modal dialog menjadi Form Tambah Data
			$("#modal-title").html('Form Tambah data');
		});

		
		$("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

			$('#syarat').val(tinyMCE.get('persyaratan').getContent());
			var keterangan = document.getElementById("keterangan").value; //validasi data kosong
			var persyaratan = document.getElementById("syarat").value; //validasi data kosong
			var pe = document.querySelectorAll(".form-line");
			if (keterangan == "" || keterangan == 0) {
				pe[0].classList.add("error"); //tambah class error pada form
				document.getElementById("keterangan").focus(); //set fokus pada textfield
				document.getElementById("v1").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}
			else if(persyaratan == ""){
				pe[1].classList.add("error"); //tambah class error pada form
				document.getElementById("persyaratan").focus(); //set fokus pada textfield
				document.getElementById("v2").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}else{ //jika lolos validasi lanjut ke proses simpan data

			$('#syarat').val(tinyMCE.get('persyaratan').getContent()); //ambil konten dari textarea tinyMCE dan masukkan ke dalam textbox
			var persyaratan = $('#syarat').val(); // ambil data isi persyaratan dari textbox
			
			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('keterangan', $("#keterangan").val()); // Ambil data keterangan
			data.append('persyaratan', persyaratan); // Ambil data keterangan
			data.append('aksi', 'add'); // set data aksi = add untuk pembanding aksi

			
			$("#loading-simpan").show(); // Munculkan loading simpan
			
			$.ajax({
				url: 'persyaratan-aksi.php', // File tujuan
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
					
						$("#view").load('persyaratan-data.php');
					if(response.status == "sukses"){ // Jika Statusnya = sukses
						
						
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
						$("#view").load('persyaratan-data.php');

						$("#form-persyaratan").fadeOut(); 
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
	


		
		$("#btn-ubah").click(function(){ // Ketika tombol ubah di klik

			$('#syarat').val(tinyMCE.get('persyaratan').getContent());
			var keterangan = document.getElementById("keterangan").value; //validasi data kosong
			var persyaratan = document.getElementById("syarat").value; //validasi data kosong
			var pe = document.querySelectorAll(".form-line");
			if (keterangan == "" || keterangan == 0) {
				pe[0].classList.add("error"); //tambah class error pada form
				document.getElementById("keterangan").focus(); //set fokus pada textfield
				document.getElementById("v1").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}
			else if(persyaratan == ""){
				pe[2].classList.add("error"); //tambah class error pada form
				document.getElementById("persyaratan").focus(); //set fokus pada textfield
				document.getElementById("v2").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}else{ //jika lolos validasi lanjut ke proses simpan data
			
			$('#syarat').val(tinyMCE.get('persyaratan').getContent()); //ambil konten dari textarea tinyMCE dan masukkan ke dalam textbox
			var persyaratan = $('#syarat').val(); // ambil data isi persyaratan dari textbox
			
			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('id_persyaratan', $("#id_persyaratan").val()); // Ambil data id_unduhan
			data.append('keterangan', $("#keterangan").val()); // Ambil data keterangan
			data.append('persyaratan', persyaratan); // Ambil data keterangan
			data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi
			
			$("#loading-ubah").show(); // Munculkan loading ubah
			
			$.ajax({
				url: 'persyaratan-aksi.php', // File tujuan
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
						$("#view").load('persyaratan-data.php');
						//munculkan pesan berhasil dengan sweetalert
			            swal({
			                title: 'Berhasil!',
			                text:  'Data berhasil diubah!',
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
			$("#id_persyaratan").removeAttr('readonly'); // Enable textbox id_unduhan
			//$("#pesan-validasi").hide(); // Enable textbox id_unduhan
			$("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-reset").hide();

			
			var pe = document.querySelectorAll(".form-line");
			pe[0].classList.remove("error"); //hapus class error pada form
			pe[1].classList.remove("error"); //hapus class error pada form
			document.getElementById("v1").innerHTML = ''; //hilangkan teks error pada id v1
			document.getElementById("v2").innerHTML = ''; //hilangkan teks error pada id v2
		});


	});


