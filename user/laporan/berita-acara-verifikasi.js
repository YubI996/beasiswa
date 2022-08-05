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
		$('#uk, #layout2, #fnama, #loading-simpan').hide();
	$('.form-control').on('change', function(){ // on change of state
            var vn = $(this).attr('data-v');
            var id = $(this).attr('id');

            if (vn === 'v1') {
            	var pesan = 'Periode';
            }
            if (vn === 'v2') {
            	var pesan = 'Kategori Beasiswa';
            }
            if (vn === 'v3') {
            	var pesan = 'Orientasi Halaman';
            }
            if (vn === 'v4') {
            	var pesan = 'Ukuran Kertas';
            }

            if ($(this).val() === "") {
            	$("#"+vn).html('Silakan Pilih '+pesan);
				return false;
            }else{
            	$("#"+vn).html('');
            }
});

	$('#kertas').on('change', function(){ // on change of state
		if ($(this).val() == 'custom') {
			$('#layout1').hide();
			$('#uk').show();
			$('#layout2').show();
		}else{
			$('#layout1').show();
			$('#uk').hide();
			$('#layout2').hide();
		}
	});	
	$('#dataT').on('change', function(){ // on change of state
		if ($(this).val() == '1') {
			$('#fnama').show();
		}else{
			$('#fnama').hide();
		}
	});	


		$("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

			var judul = $('#judul').val();
			var atas = tinyMCE.get('isi').getContent();
			var penutup = tinyMCE.get('penutup').getContent();
			var mengetahui = $('#mengetahui').val();
			var penandatangan = $('#penandatangan').val();
			var nip = $('#nip').val();

			var data = new FormData();
			data.append('judul', judul);  
			data.append('atas', atas);  
			data.append('penutup', penutup);  
			data.append('mengetahui', mengetahui);
			data.append('penandatangan', penandatangan);
			data.append('nip', nip);
			data.append('aksi', 'edt');

			
			$("#loading-simpan").show();  
			
			$.ajax({
				url: 'set-berita-acara.php', 
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
					$("#loading-simpan").hide();  
					
					if(response.status == "sukses"){ 
						
 			            swal({
			                title: 'Berhasil!',
			                text:  'Data berhasil disimpan!',
			                type: 'success',
			                timer: 1800,
			                showConfirmButton: false
			            });     

 			            location.reload();

						$("#form-modal1").modal('hide');  
					}else{  
						
 						$("#pesan-error").show();
 					}
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
						$("#form-modal1").modal('hide'); // Close / Tutup Modal Dialog
  
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

		$("#btn-cetak").click(function(){ // Ketika tombol simpan di klik
			var re1 = /^[0-9]+$/;
			var d_tampil = $("#dataT").val();
			var d_mahasiswa = $("#cnama").val();
			var d_periode = $("#periode").val();
			var d_kategori = $("#kategori").val();
			var d_layout = $("#layout").val();
			var d_kertas = $("#kertas").val();
			var d_lebar = $("#lebar").val();
			var d_tinggi = $("#tinggi").val();

			if (d_mahasiswa === "") {
				$("#v11").html('Silakan Pilih Mahasiswa');
				return false;
			}else{
				$("#v11").html('');

			}
			if (d_periode === "") {
				$("#v1").html('Silakan Pilih periode');
				return false;
			}else{
				$("#v1").html('');

			}
			if (d_kategori === "") {
				$("#v2").html('Silakan Pilih Kategori Beasiswa');
				return false;
			}else{
				$("#v2").html('');

			}
			if (d_layout === "") {
				$("#v3").html('Silakan Pilih Orientasi Halaman');
				return false;
			}else{
				$("#v3").html('');

			}
			if (d_kertas === "") {
				$("#v4").html('Silakan Pilih Ukuran kertas');
				return false;
			}else{
				$("#v4").html('');
						if (d_kertas == "custom" && d_lebar == "") {
							$("#v8").html('Silakan masukkan lebar kertas');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && !d_lebar.match(re1)) {
							$("#v8").html('Inputan lebar harus Angka');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && d_tinggi == "") {
							$("#v8").html('Silakan masukkan tinggi kertas');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && !d_tinggi.match(re1)) {
							$("#v8").html('Inputan tinggi harus Angka');
							return false;
						}else{
							$("#v8").html('');
						}

			}
			var url = 'berita-acara-verifikasi-data.php?kategori='+d_kategori+'&periode='+d_periode+'&layout='+d_layout+'&kertas='+d_kertas+'&lebar='+d_lebar+'&tinggi='+d_tinggi+'&tampil='+d_tampil+'&mhs='+d_mahasiswa;
			$("#report").html('<iframe src="'+url+'" scrolling="auto" frameborder="0" style="width:100%;height:600px;"></iframe>');
		});
		
		$("#btn-cetak1").click(function(){ // Ketika tombol simpan di klik

			var re1 = /^[0-9]+$/;
			var d_tampil = $("#dataT").val();
			var d_mahasiswa = $("#cnama").val();
			var d_periode = $("#periode").val();
			var d_kategori = $("#kategori").val();
			var d_layout = $("#layout").val();
			var d_kertas = $("#kertas").val();
			var d_lebar = $("#lebar").val();
			var d_tinggi = $("#tinggi").val();

			if (d_mahasiswa === "") {
				$("#v11").html('Silakan Pilih Mahasiswa');
				return false;
			}else{
				$("#v11").html('');

			}
			if (d_periode === "") {
				$("#v1").html('Silakan Pilih periode');
				return false;
			}else{
				$("#v1").html('');

			}
			if (d_kategori === "") {
				$("#v2").html('Silakan Pilih Kategori Beasiswa');
				return false;
			}else{
				$("#v2").html('');

			}
			if (d_layout === "") {
				$("#v3").html('Silakan Pilih Orientasi Halaman');
				return false;
			}else{
				$("#v3").html('');

			}
			if (d_kertas === "") {
				$("#v4").html('Silakan Pilih Ukuran kertas');
				return false;
			}else{
				$("#v4").html('');
						if (d_kertas == "custom" && d_lebar == "") {
							$("#v8").html('Silakan masukkan lebar kertas');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && !d_lebar.match(re1)) {
							$("#v8").html('Inputan lebar harus Angka');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && d_tinggi == "") {
							$("#v8").html('Silakan masukkan tinggi kertas');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && !d_tinggi.match(re1)) {
							$("#v8").html('Inputan tinggi harus Angka');
							return false;
						}else{
							$("#v8").html('');
						}

			}
			
			window.open('berita-acara-verifikasi-data1.php?kategori='+d_kategori+'&periode='+d_periode+'&layout='+d_layout+'&kertas='+d_kertas+'&lebar='+d_lebar+'&tinggi='+d_tinggi+'&tampil='+d_tampil+'&mhs='+d_mahasiswa);
		});
		
		$("#btn-cetak2").click(function(){ // Ketika tombol simpan di klik

			var re1 = /^[0-9]+$/;
			var d_tampil = $("#dataT").val();
			var d_mahasiswa = $("#cnama").val();
			var d_periode = $("#periode").val();
			var d_kategori = $("#kategori").val();
			var d_layout = $("#layout").val();
			var d_kertas = $("#kertas").val();
			var d_lebar = $("#lebar").val();
			var d_tinggi = $("#tinggi").val();

			if (d_mahasiswa === "") {
				$("#v11").html('Silakan Pilih Mahasiswa');
				return false;
			}else{
				$("#v11").html('');

			}
			if (d_periode === "") {
				$("#v1").html('Silakan Pilih periode');
				return false;
			}else{
				$("#v1").html('');

			}
			if (d_kategori === "") {
				$("#v2").html('Silakan Pilih Kategori Beasiswa');
				return false;
			}else{
				$("#v2").html('');

			}
			if (d_layout === "") {
				$("#v3").html('Silakan Pilih Orientasi Halaman');
				return false;
			}else{
				$("#v3").html('');

			}
			if (d_kertas === "") {
				$("#v4").html('Silakan Pilih Ukuran kertas');
				return false;
			}else{
				$("#v4").html('');
						if (d_kertas == "custom" && d_lebar == "") {
							$("#v8").html('Silakan masukkan lebar kertas');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && !d_lebar.match(re1)) {
							$("#v8").html('Inputan lebar harus Angka');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && d_tinggi == "") {
							$("#v8").html('Silakan masukkan tinggi kertas');
							return false;
						}else{
							$("#v8").html('');
						}
						if (d_kertas == "custom" && !d_tinggi.match(re1)) {
							$("#v8").html('Inputan tinggi harus Angka');
							return false;
						}else{
							$("#v8").html('');
						}

			}
			
			window.open('berita-acara-verifikasi-data2.php?kategori='+d_kategori+'&periode='+d_periode+'&layout='+d_layout+'&kertas='+d_kertas+'&lebar='+d_lebar+'&tinggi='+d_tinggi+'&tampil='+d_tampil+'&mhs='+d_mahasiswa);
		});
		

		$('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup
			$("#periode").val('').change();
			$("#kategori").val('').change();
			$("#dataT").val('3').change();
			$("#cnama").val('').change();
			$("#fnama").hide();
			$("#kertas").val('A4').change();
			$("#layout").val('P').change();
			$("#uk").hide();
			$(".vdt").html('');
			//$("#layout").val('').change();
			//$("#kertas").val('').change();
			$("#btn-reset").click(); // Klik tombol reset agar form kembali bersih
		});


	});


