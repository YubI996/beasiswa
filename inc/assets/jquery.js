 $(document).ready(function() {
    $('#menu1, #menu2').hide();

    var bgn = $("#bg").val();
    $(".user-info").css({"background": "url(https://e-beasiswa.bontangkota.go.id/inc/assets/images/"+bgn+".jpg)"});
});

         $('input.bg').on('change', function(){ // on change of state
           $('input.bg').not(this).prop('checked', false);
           var bg = $(this).attr('id');
           $("#bg").val(bg);
            $(".user-info").css({"background": ""});
            $(".user-info").css({"background": "url(https://e-beasiswa.bontangkota.go.id/inc/assets/images/"+bg+".jpg)"});

            var effect = 'timer';
            var color = $.AdminBSB.options.colors['blue'];

            var $loading = $('#mdb').waitMe({
                effect: effect,
                text: 'Loading...',
                bg: 'rgba(255,255,255,0.90)',
                color: color
            });

           $.ajax({
                   type: "POST",
                   url: "https://e-beasiswa.bontangkota.go.id/user/pengaturan/set-background.php",
                   data: "bg="  + bg
                 }).done(function(data){ 
                    $('#mdb').waitMe('hide');
            })
        });


        $("#btn-wall").click(function(){
        var id =  $("#bg").val();
           $('#'+id).prop('checked', true);            
        });

    var sbw1 = $('#sbw1').val();
    var sbw11 = $('#sbw11').val();
    var sbw2 = $('#sbw2').val();
    var sbw22 = $('#sbw22').val();
    var sbw3 = $('#sbw3').val();
    var sbw33 = $('#sbw33').val();
    var ses = $('#ses').val();

if (ses != 'berkasku') {
    if ((sbw1 == 1 && sbw11 == 1) || (sbw2 == 1 && sbw22 == 1) || (sbw3 == 1 && sbw33 == 1)) {
        $('#modalNotif1').fadeIn(900);
        $('#ber').addClass('dsb');
        $('#bea').addClass('dsb');
        $('#faq').addClass('dsb');
        $('#modalNotif1').modal({backdrop: 'static', keyboard: false}); 
    }else{       
        $('#ber').removeClass('dsb');
        $('#bea').removeClass('dsb');        
        $('#faq').removeClass('dsb');        
        $('#modalNotif1').hide();
        $('#modalNotif2').modal({backdrop: 'static', keyboard: false}); 
    } 
}



if ($('#lvlu').val() == 'Admin') {

        var nks = getCookie('nkritik');
        if(typeof(EventSource) !== "undefined") {
          var source = new EventSource("https://e-beasiswa.bontangkota.go.id/user/cek-notif.php?cek=kritikSaran");
          source.onmessage = function(e) {
            var dres = JSON.parse(e.data);



            if (dres.sck == 0) {
                    if (dres.jks > nks && dres.jks > 0) {
                        notif('KRITIK & SARAN PENGUNJUNG', 'Ada '+dres.jks+' kritik & saran dari pengunjung', 'info', 3500);
                        nks = dres.jks;
                    }
            }else{
                    if (dres.jks != nks && dres.jks > nks && dres.jks > 0) {
                        notif('KRITIK & SARAN BARU', ''+ (dres.jks - nks) +' kritik & saran baru dari pengunjung baru saja masuk', 'info', 3500);
                        nks = dres.jks;
                    }else{
                        nks = dres.jks;
                    }
            }

          };
      }
      else {
          notif('NOT SUPPORTED!', 'Web Browser tidak mendukung SSE.', 'danger', 4000);
      }//==================================
}







if ($('#lvlu').val() == 'Verifikator') {

        var auto_refreshx = setInterval(
    function () {
                    var data = new FormData();
                    data.append('cek1', 'cekJn');

                    $.ajax({
                        url: 'https://e-beasiswa.bontangkota.go.id/verifikator/cek-notif.php', 
                        type: 'POST', 
                        data: data,  
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        global: false, //parameter agar tidak terdeteksi sebagai global variable ajax sehingga animasi loading tidak muncul
                        beforeSend: function(e) {
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        },
                        success: function(response){  

                            if (response.jn > 0) { 
                                $('#jn').html(response.jn);

                                  var ntV = $('#nt').val();
                                  if (ntV != response.jn && ntV != '') {

                                      if (response.jn / ntV > 1) {
                                          $.playSound('https://e-beasiswa.bontangkota.go.id/inc/assets/sound/notif3.mp3');
                                          $('#nt').val(response.jn);
                                      }else{
                                          $('#nt').val(response.jn);
                                      }
                                  }
                                  $('#nt').val(response.jn);
                            }else{
                                $('#jn').html('');
                                $('#nt').val(0)
                                $('#menu1').hide();
                                $('#menu2').hide();
                                $('#menu21').hide();
                                $('#menu3').show();                              
                            }
                            if (response.n1 != 0 || response.n1 != '') { 
                                $('#menu1').show();
                                $('#menu21').hide(); 
                                $('#menu3').hide(); 
                                $('#jPR').html(response.n1);
                            }else{
                                $('#menu1').hide();
                            }
                            if (response.n2 != 0 || response.n2 != '') { 
                                $('#menu2').show();
                                $('#menu21').hide(); 
                                $('#menu3').hide(); 
                                $('#jTA').html(response.n2);
                            }else{
                                $('#menu2').hide();
                            }
                            if (response.n3 != 0 || response.n3 != '') { 
                                $('#menu21').show();
                                $('#menu3').hide(); 
                                $('#jC').html(response.n3);
                            }else{
                                $('#menu21').hide();
                            }
 
                            
                        }
                
                    });
    }, 2000);

}