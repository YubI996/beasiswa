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
$(document).ajaxSuccess(function(){
    stopWait('.card');
    stopWait('.modal-body');
});
function viewfile(fl){

                                var data1 = fl;
                                $("#md").html('Lihat Data - '+data1); //ubah title modal view file
                                var filedata = data1.substr(-3); //cek ekstensi file

						            if(filedata === 'jpg' || filedata === 'jpeg' || filedata === 'png' || filedata === 'gif'){
						                var vf = '<i class="material-icons md-18">cloud_download</i> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/master/file_unduhan/'+ data1+'" download>'+data1+'</a><hr><img src="file_unduhan/'+ data1 +'" style="height:auto; width:100%; ">'; //jika berekstensi gambar tampilkan sebagai gambar
						                document.getElementById('view-file').innerHTML = vf;
						            }
						            else if(filedata === 'pdf'){ //jika berekstensi pdf tampilkan sebagai file pdf
						                document.getElementById('view-file').innerHTML = '<i class="material-icons md-48">cloud_download</i><br> Download File : <a href="https://e-beasiswa.bontangkota.go.id/user/master/file_unduhan/'+ data1+'" download>'+data1+'</a>';
						                var vf = 'https://e-beasiswa.bontangkota.go.id/inc/assets/plugins/pdfjs/web/viewer.html?file=https://e-beasiswa.bontangkota.go.id/user/master/file_unduhan/'+ data1;
						                window.open(vf);
						            }else{
                                        var vf = '<div style="background:#eee;color:#000; text-align:center;padding:50px 0px 50px 0px;"><i class="material-icons" style="color:#ff9800;font-size:130px;">error_outline</i><br><br><span style="font-size:24px;"><b>Upss!</b></span> <br> <span style="font-size:18px;">Maaf Tidak Ada Plugin untuk menampilkan file ini.</span></div>'; //jika berekstensi lain                
		                                document.getElementById('view-file').innerHTML = vf; //tampilkan kedalam modal
                                    }

}

	$(document).ready(function(){

    		var main = "unduhan-data.php"; 
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

			var dp = document.getElementById("unduhan").value;  
			var ket = document.getElementById("keterangan").value;  
			var pe = document.querySelectorAll(".form-line");
			if (dp == "" || dp == 0) {
 				pe[1].classList.add("error");  
				document.getElementById("unduhan").focus(); //set fokus pada textfield
				document.getElementById("v1").innerHTML = 'Field tidak boleh kosong';  

			}
			else if(ket == "" || ket == 0){
 				pe[2].classList.add("error");  
				document.getElementById("keterangan").focus(); //set fokus pada textfield
				document.getElementById("v2").innerHTML = 'Field tidak boleh kosong';  

			}else{ //jika lolos validasi lanjut ke proses simpan data

			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('unduhan', $("#unduhan")[0].files[0]);
			data.append('keterangan', $("#keterangan").val()); // Ambil data keterangan
			data.append('aksi', 'add'); // set data aksi = add untuk pembanding aksi

			
			$("#loading-simpan").show(); // Munculkan loading simpan
			
			$.ajax({
				url: 'unduhan-aksi.php', // File tujuan
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
						$("#view").load('unduhan-data.php');
						
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

			}

		});
	


		
		$("#btn-ubah").click(function(){ // Ketika tombol ubah di klik
			var validasi = 0;//nilai awal validasi = belum tervalidasi
			if ($("#ceklis").val() == '1'){ //jika ceklist tercentang lakukan validasi

				var dp = document.getElementById("unduhan").value;  
				var ket = document.getElementById("keterangan").value;  
				var pe = document.querySelectorAll(".form-line");
				if (dp == "" || dp == 0) {
 
 					pe[1].classList.add("error");  
					document.getElementById("unduhan").focus(); //set fokus pada textfield
					document.getElementById("v1").innerHTML = 'Field tidak boleh kosong';  

				}
				else if(ket == "" || ket == 0){

					pe[2].classList.add("error");  
					document.getElementById("keterangan").focus(); //set fokus pada textfield
					document.getElementById("v2").innerHTML = 'Field tidak boleh kosong';  

				}
				else if(dp == "" && ket == ""){
					pe[1].classList.add("error");  
					pe[2].classList.add("error");  
					document.getElementById("unduhan").focus(); //set fokus pada textfield
					document.getElementById("v1").innerHTML = 'Field tidak boleh kosong';  
					document.getElementById("v2").innerHTML = 'Field tidak boleh kosong';  

				}else{
					validasi = 1;	//berikan nilai validasi 1 = tervalidasi
					var ubah = '1'; //jika dicentang berarti ubah semua 			
				}


			}
			 else if(document.getElementById("ceklis").value == '0'){ //jika tidak tercentang validasi hanya untuk field keterangan
				var ket = document.getElementById("keterangan").value;  
				var pe = document.querySelectorAll(".form-line");
				if(ket == "" || ket == 0){

					pe[2].classList.add("error");  
					document.getElementById("keterangan").focus(); //set fokus pada textfield
					document.getElementById("v2").innerHTML = 'Field tidak boleh kosong';  

				}else{
					validasi = 1;	//berikan nilai validasi 1 = tervalidasi	
					var ubah = '0'; //jika tidak dicentang berarti ubah sebagian			
				}

			}
			if (validasi === 1) { //jika semua field sudah tervalidasi 
			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			
			data.append('id_unduhan', $("#id_unduhan").val()); // Ambil data id_unduhan
			data.append('unduhan', $("#unduhan")[0].files[0]);
			data.append('keterangan', $("#keterangan").val()); // Ambil data keterangan
			data.append('ubah', ubah); // Ambil data keterangan
			data.append('fl', $("#data-fl").val()); // Ambil data file lama
			data.append('aksi', 'edt'); // set data aksi = edt untuk pembanding aksi
			
			$("#loading-ubah").show(); // Munculkan loading ubah
			
			$.ajax({
				url: 'unduhan-aksi.php', // File tujuan
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
						$("#view").load('unduhan-data.php');
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
			$("#id_unduhan").removeAttr('readonly'); // Enable textbox id_unduhan
			//$("#pesan-validasi").hide(); // Enable textbox id_unduhan
		$("#loading-ubah, #loading-simpan, #cek-file,  #pesan-validasi, #btn-reset").hide();
		$("#unduhan").show();

			
			var pe = document.querySelectorAll(".form-line");
			pe[1].classList.remove("error"); //hapus class error pada form
			pe[2].classList.remove("error"); //hapus class error pada form
			document.getElementById("v1").innerHTML = ''; //hilangkan teks error pada id v1
			document.getElementById("v2").innerHTML = ''; //hilangkan teks error pada id v1
			document.getElementById("ceklis").value = '0'; //hilangkan teks error pada id v1
			document.getElementById("cek-file").value = '0'; //hilangkan teks error pada id v1
		});


	});


