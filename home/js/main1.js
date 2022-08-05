$(document).ready(function(){
            $("#list").load('unduhan-data.php');
                $('#cari').on('keyup', function(){ // fungsi ketika dicentang ceklis ubah foto
                    var key = $('#cari').val();
                    $("#list").load('unduhan-data.php?key='+key);
                });




    $("#persyaratan li").prepend('<i class="fa fa-angle-right"></i>');

});