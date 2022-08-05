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

    		var main = "berita-data.php"; 
			$("#view").load(main); //tampilkan data unduhan saat halaman dibuka

		// Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
		$("#loading-ubah, #loading-simpan, #cek-file,  #pesan-validasi, #btn-reset").hide();
		
		$("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
			$("#btn-ubah").hide(); // Sembunyikan tombol ubah 
			$("#btn-simpan").show(); // Munculkan tombol simpan
			
			// Set judul modal dialog menjadi Form Tambah Data
			$("#modal-title").html('Form Tambah data');
		});

		
		$("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

			$('#isiberita').val(tinyMCE.get('isi').getContent());
			var judul = document.getElementById("judul").value; //validasi data kosong
			var foto = document.getElementById("foto").value; //validasi data kosong
			var isi = document.getElementById("isiberita").value; //validasi data kosong
			var pe = document.querySelectorAll(".form-line");
			if (judul == "" || judul == 0) {
				pe[0].classList.add("error"); //tambah class error pada form
				document.getElementById("judul").focus(); //set fokus pada textfield
				document.getElementById("v1").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}
			else if(foto == "" || foto == 0){
				pe[1].classList.add("error"); //tambah class error pada form
				document.getElementById("foto").focus(); //set fokus pada textfield
				document.getElementById("v2").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}else if(isi == ""){
				pe[2].classList.add("error"); //tambah class error pada form
				document.getElementById("isi").focus(); //set fokus pada textfield
				document.getElementById("v3").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}else{ //jika lolos validasi lanjut ke proses simpan data

			$('#isiberita').val(tinyMCE.get('isi').getContent()); //ambil konten dari textarea tinyMCE dan masukkan ke dalam textbox
			var isi = $('#isiberita').val(); // ambil data isi berita dari textbox
			
			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('judul', $("#judul").val()); // Ambil data keterangan
			data.append('isi', isi); // Ambil data keterangan
			data.append('aksi', 'add'); // set data aksi = add untuk pembanding aksi
			data.append('foto', $("#foto")[0].files[0]);

			
			
			$.ajax({
				url: 'berita-aksi.php', // File tujuan
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
						
						$("#view").load('berita-data.php');
						
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
						
					}
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
						$("#form-modal").modal('hide'); // Close / Tutup Modal Dialog
						$("#view").load('berita-data.php');

						$("#form-berita").fadeOut(); 
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
			var validasi = 0;//nilai awal validasi = belum tervalidasi
			var ubah;//nilai awal validasi = belum tervalidasi

			$('#isiberita').val(tinyMCE.get('isi').getContent());
			var judul = document.getElementById("judul").value; //validasi data kosong
			var foto = document.getElementById("foto").value; //validasi data kosong
			var isi = document.getElementById("isiberita").value; //validasi data kosong
			var pe = document.querySelectorAll(".form-line");

			if ($("#ceklis").val() == '1'){ //jika ceklist tercentang lakukan validasi

			if (judul == "" || judul == 0) {
				pe[0].classList.add("error"); //tambah class error pada form
				document.getElementById("judul").focus(); //set fokus pada textfield
				document.getElementById("v1").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}
			else if(foto == "" || foto == 0){
				pe[1].classList.add("error"); //tambah class error pada form
				document.getElementById("foto").focus(); //set fokus pada textfield
				document.getElementById("v2").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}else if(isi == ""){
				pe[2].classList.add("error"); //tambah class error pada form
				document.getElementById("isi").focus(); //set fokus pada textfield
				document.getElementById("v3").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
			}else{ //jika lolos validasi lanjut ke proses simpan data
					validasi = 1;	//berikan nilai validasi 1 = tervalidasi
					ubah = '1'; //jika dicentang berarti ubah semua 			
				}


			}
			 else if(document.getElementById("ceklis").value == '0'){ //jika tidak tercentang validasi hanya untuk field keterangan
				
				if (judul == "" || judul == 0) {
				pe[0].classList.add("error"); //tambah class error pada form
				document.getElementById("judul").focus(); //set fokus pada textfield
				document.getElementById("v1").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
				}
				else if(isi == ""){
					pe[2].classList.add("error"); //tambah class error pada form
					document.getElementById("isi").focus(); //set fokus pada textfield
					document.getElementById("v3").innerHTML = 'Field tidak boleh kosong'; //tampilkan persan error ke id v1
				}else{
					validasi = 1;	//berikan nilai validasi 1 = tervalidasi	
					ubah = '0'; //jika tidak dicentang berarti ubah sebagian			
				}

			}
			if (validasi === 1) { //jika semua field sudah tervalidasi 
			
			$('#isiberita').val(tinyMCE.get('isi').getContent()); //ambil konten dari textarea tinyMCE dan masukkan ke dalam textbox
			var isi = $('#isiberita').val(); // ambil data isi berita dari textbox
			
			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('id_berita', $("#id_berita").val()); // Ambil data id_unduhan
			data.append('judul', $("#judul").val()); // Ambil data keterangan
			data.append('isi', isi); // Ambil data keterangan
			data.append('foto', $("#foto")[0].files[0]);
			data.append('ubah', ubah); // Ambil data keterangan
			data.append('fl', $("#data-fl").val()); // Ambil data file lama
			data.append('aksi', 'edt'); // set data aksi = add untuk pembanding aksi
			
			$("#loading-ubah").show(); // Munculkan loading ubah
			
			$.ajax({
				url: 'berita-aksi.php', // File tujuan
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
						$("#view").load('berita-data.php');
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
			$("#id_berita").removeAttr('readonly'); // Enable textbox id_unduhan
			//$("#pesan-validasi").hide(); // Enable textbox id_unduhan
			$("#loading-ubah, #loading-simpan, #cek-file,  #pesan-validasi, #btn-reset").hide();
		    $("#foto").show(); // tampilkan cek ubah file  

			
			var pe = document.querySelectorAll(".form-line");
			pe[0].classList.remove("error"); //hapus class error pada form
			pe[1].classList.remove("error"); //hapus class error pada form
			pe[2].classList.remove("error"); //hapus class error pada form
			document.getElementById("v1").innerHTML = ''; //hilangkan teks error pada id v1
			document.getElementById("v2").innerHTML = ''; //hilangkan teks error pada id v2
			document.getElementById("v3").innerHTML = ''; //hilangkan teks error pada id v2
			document.getElementById("ceklis").value = '0'; //kembalikan nilai ceklis ke 0
		});


	});


