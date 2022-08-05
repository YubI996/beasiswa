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
		$('#uk, #layout2').hide();
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
	
		$("#btn-cetak").click(function(){ // Ketika tombol simpan di klik
			var re1 = /^[0-9]+$/;
			var d_periode = $("#periode").val();
			var d_kategori = $("#kategori").val();
			var d_layout = $("#layout").val();
			var d_kertas = $("#kertas").val();
			var d_lebar = $("#lebar").val();
			var d_tinggi = $("#tinggi").val();

			if (d_periode === "") {
				$("#v1").html('Silakan Pilih Periode');
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
				$("#v4").html('Silakan Pilih Ukuran Kertas');
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

			var url = 'lap-pemohon-data.php?kategori='+d_kategori+'&periode='+d_periode+'&layout='+d_layout+'&kertas='+d_kertas+'&lebar='+d_lebar+'&tinggi='+d_tinggi;
			$("#report").html('<iframe src="'+url+'" scrolling="auto" frameborder="0" style="width:100%;height:600px;"></iframe>');
		});
		
		$("#btn-cetak1").click(function(){ // Ketika tombol simpan di klik

			var re1 = /^[0-9]+$/;
			var d_periode = $("#periode").val();
			var d_kategori = $("#kategori").val();
			var d_layout = $("#layout").val();
			var d_kertas = $("#kertas").val();
			var d_lebar = $("#lebar").val();
			var d_tinggi = $("#tinggi").val();

			if (d_periode === "") {
				$("#v1").html('Silakan Pilih Periode');
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
				$("#v4").html('Silakan Pilih Ukuran Kertas');
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
			
			window.open('lap-pemohon-data1.php?kategori='+d_kategori+'&periode='+d_periode+'&layout='+d_layout+'&kertas='+d_kertas+'&lebar='+d_lebar+'&tinggi='+d_tinggi);
		});


		$('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup
			$("#periode").val('').change();
			$("#kategori").val('').change();
			$("#kertas").val('A4').change();
			$("#layout").val('L').change();
			$("#uk").hide();
			$(".vdt").html('');
			//$("#layout").val('').change();
			//$("#kertas").val('').change();
			$("#btn-reset").click(); // Klik tombol reset agar form kembali bersih
		});


	});


