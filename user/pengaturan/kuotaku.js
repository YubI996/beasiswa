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

    		var main = "kuotaku-data.php"; 
			$("#view").load(main); //tampilkan data periode saat halaman dibuka

		// Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
		$("#id_periode, #loading-ubah, #loading-simpan,  #pesan-validasi, #btn-reset").hide();
		
		$("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
			$("#btn-ubah").hide(); // Sembunyikan tombol ubah 
			$("#btn-simpan").show(); // Munculkan tombol simpan
			
			// Set judul modal dialog menjadi Form Tambah Data
			$("#modal-title").html('Form Tambah data');
		});

 
		
		$("#btn-simpan").click(function(){ // Ketika tombol simpan di klik 

			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('kategori', document.getElementById('kategori').value); // Ambil data periode
			data.append('jenjang', document.getElementById('jenjang').value); // Ambil data periode
			data.append('daerah', document.getElementById('daerah').value); // Ambil data periode
			data.append('kuota_ipa', $("#kuota_ipa").val()); // Ambil data periode
			data.append('kuota_ips', $("#kuota_ips").val()); // Ambil data periode
			data.append('kuota_default', $("#kuota_default").val()); // Ambil data periode
			data.append('ipk_ipa', $("#ipk_ipa").val()); // Ambil data periode
			data.append('ipk_ips', $("#ipk_ips").val()); // Ambil data periode
			data.append('ipk_default', $("#ipk_default").val()); // Ambil data periode s
			data.append('aksi', 'add'); // set data aksi = add untuk pembanding aksi

			
			$("#loading-simpan").show(); // Munculkan loading simpan
			
			$.ajax({
				url: 'kuotaku-aksi.php', // File tujuan
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
						
						// Ganti isi dari div view dengan view yang diambil dari proses_simpan.php
						$("#view").load('kuotaku-data.php');
						
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
		
		$("#btn-ubah").click(function(){ // Ketika tombol ubah di klik 

			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			
			data.append('id_kuota', $("#id_kuota").val()); // Ambil data id_periode
			data.append('kategori', document.getElementById('kategori').value); // Ambil data periode
			data.append('jenjang', document.getElementById('jenjang').value); // Ambil data periode
			data.append('daerah', document.getElementById('daerah').value); // Ambil data periode
			data.append('kuota_ipa', $("#kuota_ipa").val()); // Ambil data periode
			data.append('kuota_ips', $("#kuota_ips").val()); // Ambil data periode
			data.append('kuota_default', $("#kuota_default").val()); // Ambil data periode
			data.append('ipk_ipa', $("#ipk_ipa").val()); // Ambil data periode
			data.append('ipk_ips', $("#ipk_ips").val()); // Ambil data periode
			data.append('ipk_default', $("#ipk_default").val()); // Ambil data periode s 
			data.append('aksi', 'edt'); // set data aksi = edt untuk pembanding aksi
			
			$("#loading-ubah").show(); // Munculkan loading ubah
			
			$.ajax({
				url: 'kuotaku-aksi.php', // File tujuan
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
						$("#view").load('kuotaku-data.php');
						
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
 
		});
		

		$('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup

			$("#btn-reset").click(); // Klik tombol reset agar form kembali bersih
			$("#id_periode").removeAttr('readonly'); // Enable textbox id_periode
			$('select').val('')
			//$("#pesan-validasi").hide(); // Enable textbox id_periode 
		});


	});


