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
    $("#btn-next").show();  
    $("#tabs1").val('1');
   
    // Set judul modal dialog menjadi Form Ubah Data
    $("#btn-prev").removeAttr('class');
    $("#btn-prev").attr('disabled', '');
    $("#btn-prev").attr('class', 'btn bg-grey waves-effect');
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

                            $("#btn-simpan").html("TUTUP");
                            $("#msgS").html("Sedang Menutup...");
                            $("#ftu").html('<img src="../../user/master/foto_user/'+response.foto+'" style="width:100px; height:auto;">');
                            
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
        

        $("#btn-next").click(function(){ 
            var aktif = $('#tabs1').val();
            var angka1 = parseInt(aktif);
            var angka2 = 1;
            var next = (angka1+angka2);
            $('#'+next).click();
            $('#tabs1').val(next);

            if ($('#tabs1').val() == 3) {
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


        $("#3").click(function(){ 
                $("#btn-simpan").show(); 
                $("#btn-next").hide(); 
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
        
  
        

        $('#form-modal').on('hidden.bs.modal', function (e){ // Ketika Modal Dialog di Close / tertutup
            $(".form-control").attr('disabled', false);

            $("#btn-reset").click(); 
            $('#ultabs1 a:first').tab('show');
            $("#loading-ubah, #loading-simpan,  #pesan-validasi, #btn-cls, #btn-reset").hide();

            $(".vdt").html('');
            $("#ultabs1").removeAttr('class');
            $("#ultabs1").attr('class', 'nav nav-tabs tab-nav-right');
            $("#id_user").val('').change();
        });


    });


