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
}

function viewfile(id){
    $("#btn-simpan").hide();  
    $("#btn-close").hide();  
    $("#btn-next").show();  
    $("#tabs1").val('1');
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#btn-prev").removeAttr('class');
    $("#btn-prev").attr('disabled', '');
    $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
    $("#btn-next").removeAttr('class');
    $("#btn-next").removeAttr('disabled');
    $("#btn-next").attr('class', 'btn bg-teal waves-effect');
    $("#aks").val('detail');

                    var data = new FormData();
                    data.append('id_mahasiswa', id);  
                    data.append('aksi', 'fdata'); 
                                        
                    $.ajax({
                        url: 'mahasiswa-aksi.php', 
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
                            
                            $("#modal-title").html('Lihat Data Mahasiswa - '+response.nama);
                            $(".form-control").attr('disabled', true);


                            if (response.tgl == '0000-00-00') {
                                document.getElementById("tgl").value = '';
                            }else{
                                document.getElementById("tgl").value = response.tgl;
                            }


                            $("#msgS").html("Sedang Menutup...");
                            $("#ftu").html('<img src="foto_user/'+response.foto+'" style="width:100px; height:auto;">');
                            
                            document.getElementById("id_mahasiswa").value = id;
                            $("#id_user").val(response.idusr).change();
                            $("#kota").val(response.kota+'~'+response.daerah).change();
                            $("#jenjang").val(response.jenjang).change();
                            $("#ilmu").val(response.ilmu).change();
                            document.getElementById("nama").value = response.nama;
                            document.getElementById("ktm").value = response.ktm;
                            document.getElementById("ktp").value = response.ktp;
                            document.getElementById("tpl").value = response.tpl;
                            document.getElementById("alamatS").value = response.alamatS;
                            document.getElementById("alamatKtp").value = response.alamatKtp;
                            document.getElementById("telp1").value = response.telp1;
                            document.getElementById("ayah").value = response.ayah;
                            document.getElementById("ibu").value = response.ibu;
                            document.getElementById("alamatO").value = response.alamatO;
                            document.getElementById("telp2").value = response.telp2;
                            document.getElementById("pt").value = response.pt;
                            document.getElementById("alamatP").value = response.alamatP;
                            document.getElementById("telp3").value = response.telp3;
                            document.getElementById("angkatan").value = response.angkatan;
                            document.getElementById("fakultas").value = response.fakultas;
                            document.getElementById("ps").value = response.ps;
                            document.getElementById("jurusan").value = response.jurusan;
                            document.getElementById("nmbank").value = response.nmbank;
                            document.getElementById("alamatB").value = response.alamatB;
                            document.getElementById("telp4").value = response.telp4;
                            document.getElementById("norek").value = response.norek;
                            document.getElementById("pemilik").value = response.pemilik;
                            
                        }
                
                    });

}

$(document).ready(function(){

        
    		var main = "mahasiswa-data.php"; 
			$("#view").load(main); //tampilkan data unduhan saat halaman dibuka

		// Sembunyikan loading simpan, loading ubah, pesan validasi dan tombol reset
		$("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-cls, #btn-reset").hide();
		
		$("#btn-tambah").click(function(){ // Ketika tombol tambah diklik
            $("#btn-simpan").html('SIMPAN'); 
            $("#aks").val('add');
            $("#tabs1").val('1');
			$("#btn-simpan").show(); 
			$("#btn-close").hide(); 
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

			if ($('#tabs1').val() == 3) {
                $("#btn-next").removeAttr('class');
                $("#btn-next").attr('disabled', '');
                $("#btn-next").attr('class', 'btn bg-grey waves-effect');
    			$("#btn-next").show(); 
			}else{
                $("#btn-next").removeAttr('class');
                $("#btn-next").removeAttr('disabled');
                $("#btn-next").attr('class', 'btn bg-teal waves-effect');
                $("#btn-next").show(); 
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
			$("#btn-close").hide(); 
            
            if($('#tabs1').val() == 1){
				$("#btn-close").hide(); 
				$("#btn-next").show(); 
				$("#btn-prev").removeAttr('class');
				$("#btn-prev").attr('disabled', '');
				$("#btn-prev").attr('class', 'btn bg-grey waves-effect');
            }
        });


        $("#3").click(function(){ 
				$("#btn-close").show(); 
				$("#btn-next").show(); 
 				$("#btn-prev").removeAttr('class');
				$("#btn-prev").removeAttr('disabled');
				$("#btn-prev").attr('class', 'btn bg-teal waves-effect');
                $("#btn-next").removeAttr('class');
                $("#btn-next").attr('disabled', '');
                $("#btn-next").attr('class', 'btn bg-grey waves-effect');
        });
        $("#2").click(function(){ 
				$("#btn-close").hide(); 
				$("#btn-next").show(); 
				$("#btn-prev").show(); 
 				$("#btn-prev").removeAttr('class');
				$("#btn-prev").removeAttr('disabled');
				$("#btn-prev").attr('class', 'btn bg-teal waves-effect');
                $("#btn-next").removeAttr('class');
                $("#btn-next").removeAttr('disabled');
                $("#btn-next").attr('class', 'btn bg-teal waves-effect');
        });

        $("#1").click(function(){ 
				$("#btn-close").hide(); 
				$("#btn-next").show(); 
				$("#btn-prev").removeAttr('class');
				$("#btn-prev").attr('disabled', '');
				$("#btn-prev").attr('class', 'btn bg-grey waves-effect');
                $("#btn-next").removeAttr('class');
                $("#btn-next").removeAttr('disabled');
                $("#btn-next").attr('class', 'btn bg-teal waves-effect');
        });


function errorFocus(idFL, idtab, classFl, idpesan, pesan){
			var pe = document.querySelectorAll(classFl);
				$("#ultabs1").removeAttr('class');
				$("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right tab-col-red');
				$("#"+idtab).click();
                pe[idFL].classList.add("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = pesan; //tampilkan persan error ke id v1
}
function errorClear(idFL, classFl, idpesan){
				var pe = document.querySelectorAll(classFl);
                pe[idFL].classList.remove("error"); //tambah class error pada form
                document.getElementById(idpesan).innerHTML = ''; //tampilkan persan error ke id v1
				$("#ultabs1").removeAttr('class');
				$("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right');
}
		
		$("#btn-simpan").click(function(){ // Ketika tombol simpan di klik

            var re1 = /^[0-9]+$/;
			var id_mahasiswa = document.getElementById("id_mahasiswa").value;
			var id_user = document.getElementById("id_user").value;
			var nama = document.getElementById("nama").value;
			var ktm = document.getElementById("ktm").value;
			var ktp = document.getElementById("ktp").value;
			var tpl = document.getElementById("tpl").value;
			var tgl = document.getElementById("tgl").value;
			var kota = document.getElementById("kota").value;
			var alamatS = document.getElementById("alamatS").value;
			var alamatKtp = document.getElementById("alamatKtp").value;
			var telp1 = document.getElementById("telp1").value;
			var ayah = document.getElementById("ayah").value;
			var ibu = document.getElementById("ibu").value;
			var alamatO = document.getElementById("alamatO").value;
			var telp2 = document.getElementById("telp2").value;
			var pt = document.getElementById("pt").value;
			var alamatP = document.getElementById("alamatP").value;
			var telp3 = document.getElementById("telp3").value;
			var jenjang = document.getElementById("jenjang").value;
			var angkatan = document.getElementById("angkatan").value;
			var fakultas = document.getElementById("fakultas").value;
			var ps = document.getElementById("ps").value;
            var jurusan = document.getElementById("jurusan").value;
            var ilmu = document.getElementById("ilmu").value;
			var nmbank = document.getElementById("nmbank").value;
			var alamatB = document.getElementById("alamatB").value;
			var telp4 = document.getElementById("telp4").value;
			var norek = document.getElementById("norek").value;
			var pemilik = document.getElementById("pemilik").value;
			var aks = document.getElementById("aks").value;
			
            if (id_user == "") {
				errorFocus(0, 1, '.fr', 'v0', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr', 'v0');
            }
            if (nama == "" || nama == 0) {
				errorFocus(0, 1, '.fr', 'v1', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr', 'v1');
            }
            if (ktm == "" || ktm.length < 3) {
				errorFocus(1, 1, '.fr', 'v2', 'Field tidak boleh kosong. Minimal 3 Digit');
                return false;
            }else{
                errorClear(1, '.fr', 'v2');
            }
            if (!ktm.match(re1)) {
				errorFocus(1, 1, '.fr', 'v2', 'Inputan Harus Angka');
                return false;
            }else{
                errorClear(1, '.fr', 'v2');
            }
            if (ktp == "") {
				errorFocus(2, 1, '.fr', 'v3', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr', 'v3');
            }
            if (!ktp.match(re1)) {
				errorFocus(2, 1, '.fr', 'v3', 'Inputan Harus Angka');
                return false;
            }else{
                errorClear(2, '.fr', 'v3');
            }
            if (ktp.length < 16) {
				errorFocus(2, 1, '.fr', 'v3', 'Inputan Minimal 16 Digit (Inputan : '+ktp.length+' dari 16)');
                return false;
            }else{
                errorClear(2, '.fr', 'v3');
            }
            
            if (tpl == "" || tpl == 0) {
				errorFocus(3, 1, '.fr', 'v4', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.fr', 'v4');
            }
            if (tgl == "" || tgl == 0) {
				errorFocus(4, 1, '.fr', 'v5', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.fr', 'v5');
            }
            if (kota == "" || kota == 0) {
				errorFocus(5, 1, '.fr', 'v6', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(5, '.fr', 'v6');
            }
            if (alamatS == "" || alamatS == 0) {
				errorFocus(6, 1, '.fr', 'v7', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.fr', 'v7');
            }
            if (alamatKtp == "" || alamatKtp == 0) {
				errorFocus(7, 1, '.fr', 'v8', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(7, '.fr', 'v8');
            }
            if (telp1 == "" || telp1 == 0) {
				errorFocus(8, 1, '.fr', 'v9', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(8, '.fr', 'v9');
            }
            if (!telp1.match(re1)) {
				errorFocus(8, 1, '.fr', 'v9', 'Inputan harus Angka');
                return false;
            }else{
                errorClear(8, '.fr', 'v9');
            }
            if (telp1.length < 6) {
				errorFocus(8, 1, '.fr', 'v9', 'Inputan Minimal 6 digit');
                return false;
            }else{
                errorClear(8, '.fr', 'v9');
            }
            if (ayah == "" || ayah == 0) {
				errorFocus(9, 1, '.fr', 'v10', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(9, '.fr', 'v10');
            }
            if (ibu == "" || ibu == 0) {
				errorFocus(10, 1, '.fr', 'v11', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(10, '.fr', 'v11');
            }
            if (alamatO == "" || alamatO == 0) {
				errorFocus(11, 1, '.fr', 'v12', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(11, '.fr', 'v12');
            }
            if (telp2 == "" || telp2 == 0) {
				errorFocus(12, 1, '.fr', 'v13', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(12, '.fr', 'v13');
            }
            if (!telp2.match(re1)) {
				errorFocus(12, 1, '.fr', 'v13', 'Inputan harus Angka');
                return false;
            }else{
                errorClear(12, '.fr', 'v13');
            }
            if (telp2.length < 6) {
				errorFocus(12, 1, '.fr', 'v13', 'Inputan Minimal 6 digit');
                return false;
            }else{
                errorClear(12, '.fr', 'v13'); 
            }
            if (pt == "" || pt == 0) {
				errorFocus(0, 2, '.fr1', 'v14', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr1', 'v14');
            }
            if (alamatP == "" || alamatP == 0) {
				errorFocus(1, 2, '.fr1', 'v15', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr1', 'v15');
            }
            if (telp3 == "" || telp3 == 0) {
				errorFocus(2, 2, '.fr1', 'v16', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr1', 'v16');
            }
            if (!telp3.match(re1)) {
				errorFocus(2, 2, '.fr1', 'v16', 'Inputan harus Angka');
                return false;
            }else{
                errorClear(2, '.fr1', 'v16');
            }
            if (telp3.length < 6) {
				errorFocus(2, 2, '.fr1', 'v16', 'Inputan Minimal 6 digit');
                return false;
            }else{
                errorClear(2, '.fr1', 'v16'); 
            }
            if (jenjang == "" || jenjang == 0) {
				errorFocus(3, 2, '.fr1', 'v17', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.fr1', 'v17');
            }
            if (angkatan == "" || angkatan == 0) {
				errorFocus(4, 2, '.fr1', 'v18', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.fr1', 'v18');
            }
            if (fakultas == "" || fakultas == 0) {
				errorFocus(5, 2, '.fr1', 'v19', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(5, '.fr1', 'v19');
            }
            if (ps == "" || ps == 0) {
				errorFocus(6, 2, '.fr1', 'v20', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(6, '.fr1', 'v20');
            }
            if (jurusan == "" || jurusan == 0) {
                errorFocus(7, 2, '.fr1', 'v21', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(7, '.fr1', 'v21');
            }
            if (ilmu == "" || ilmu == 0) {
                errorFocus(8, 2, '.fr1', 'v211', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(8, '.fr1', 'v211');
            }
            if (nmbank == "" || nmbank == 0) {
				errorFocus(0, 3, '.fr2', 'v22', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(0, '.fr2', 'v22');
            }
            if (alamatB == "" || alamatB == 0) {
				errorFocus(1, 3, '.fr2', 'v23', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(1, '.fr2', 'v23');
            }
            if (telp4 == "" || telp4 == 0) {
				errorFocus(2, 3, '.fr2', 'v24', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(2, '.fr2', 'v24');
            }
            if (!telp4.match(re1)) {
				errorFocus(2, 3, '.fr2', 'v24', 'Inputan harus Angka');
                return false;
            }else{
                errorClear(2, '.fr2', 'v24');
            }
            if (telp4.length < 6) {
				errorFocus(2, 3, '.fr2', 'v24', 'Inputan Minimal 6 digit');
                return false;
            }else{
                errorClear(2, '.fr2', 'v16'); 
            }
            if (norek == "" || norek == 0) {
				errorFocus(3, 3, '.fr2', 'v25', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(3, '.fr2', 'v25');
            }
            if (!norek.match(re1)) {
				errorFocus(3, 3, '.fr2', 'v25', 'Inputan harus Angka');
                return false;
            }else{
                errorClear(3, '.fr2', 'v25');
            }
            if (norek.length < 10) {
				errorFocus(3, 3, '.fr2', 'v25', 'Inputan Minimal 10 digit');
                return false;
            }else{
                errorClear(2, '.fr2', 'v25'); 
            }
            if (pemilik == "" || pemilik == 0) {
				errorFocus(4, 3, '.fr2', 'v26', 'Field tidak boleh kosong');
                return false;
            }else{
                errorClear(4, '.fr2', 'v26');
            
            //jika lolos validasi lanjut ke proses simpan data

			
			// Buat variabel data untuk menampung data hasil input dari form
			var data = new FormData();
			data.append('id_mahasiswa', id_mahasiswa); 
			data.append('id_user', id_user); 
			data.append('nama', nama); 
			data.append('ktm', ktm); 
			data.append('ktp', ktp); 
			data.append('tpl', tpl); 
			data.append('tgl', tgl); 
			data.append('kota', kota); 
			data.append('alamatS', alamatS); 
			data.append('alamatKtp', alamatKtp); 
			data.append('telp1', telp1); 
			data.append('ayah', ayah); 
			data.append('ibu', ibu); 
			data.append('alamatO', alamatO); 
			data.append('telp2', telp2); 
			data.append('pt', pt); 
			data.append('alamatP', alamatP); 
			data.append('telp3', telp3); 
			data.append('jenjang', jenjang); 
			data.append('angkatan', angkatan); 
			data.append('fakultas', fakultas); 
			data.append('ps', ps); 
            data.append('jurusan', jurusan); 
            data.append('ilmu', ilmu); 
			data.append('nmbank', nmbank); 
			data.append('alamatB', alamatB); 
			data.append('telp4', telp4); 
			data.append('norek', norek); 
			data.append('pemilik', pemilik); 
			data.append('aksi', aks); // set data aksi = add untuk pembanding aksi

			
			$("#loading-simpan").show(); // Munculkan loading simpan
			
			$.ajax({
				url: 'mahasiswa-aksi.php', // File tujuan
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
						
						$("#view").load('mahasiswa-data.php');
						
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
			                text:  'Data gagal disimpan! \nError : ' +ajaxOptions+ '-' +thrownError,
			                type: 'error',
			                html: true,
			                showConfirmButton: true
			            });     
				}
			});

			}

		});
	


		

		$('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup
            $(".form-control").attr('disabled', false);

			$("#btn-reset").click(); 
            $('#ultabs1 a:first').tab('show');
            $("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-cls, #btn-reset").hide();

			$(".vdt").html('');
			$("#ultabs1").removeAttr('class');
			$("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right');
            $("#id_user").val('').change();
            $("#tabs1").val(1);
            $("#btn-simpan").show();
            stopWait('.card');
            stopWait('.modal-body');
		});


	});


