</div>



<div style="width:35px;padding:5px 8px 5px 8px;background:#cccccc;position:fixed; bottom:20px; right:2%; z-index:9999; font-size:25px;"><a href="#"><i class="fa fa-angle-up"></i><span style="font-size:10px;top:-10px;">TOP</span></a></div>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
<center><hr class="style-six"></center>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="testimonial bottom">
                        <h2>Quote Of The Day</h2>
                        <div class="media">
                            <div class="media-body">
                                <blockquote><?php echo $dk1['quote']; ?></blockquote>
                                <h3><a>~ <?php echo $dk1['author_quote']; ?></a></h3>
                            </div>
                         </div>
                    </div> 
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="contact-info bottom">
                        <h2>Contacts</h2>
                        <address>
                        E-mail: <a href="mailto:<?php echo $dk['email']; ?>"><?php echo $dk['email']; ?></a> <br> 
                        Phone: <?php echo $dk['no_telp']; ?> <br> 
                        <!--Fax: <?php echo $dk['fax']; ?> <br> -->
                        </address>

                        <h2>Address</h2>
                        <address>
                       <?php echo $dk['alamat']; ?> 
                        </address>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="contact-form bottom">
                        <h2>Kirim Pesan</h2>
                            <div id="form_status" class="form_status"><p><i class="fa fa-spinner fa-spin"></i> Sedang mengirim pesan...</p></div>
                        <form id="main-contact-form" name="contact-form" method="post" action="sendmail.php">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" required="required" placeholder="Masukkan Nama Anda">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control" required="required" placeholder="Masukkan Email Anda">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Masukkan Pesan Anda"></textarea>
                            </div>                        
                            <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-submit"  id="btn-simpann"><i class="fa fa-send"></i> Kirim </button>
                            </div>
                            <button type="reset" id="resett" style="display:none;"></button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="copyright-text text-center">
                        <p style="color:#C03035;">&copy; 2017 Diskominfotik Kota Bontang | e-Beasiswa Bontang - Created By Cyber Creative Team</p>
                        <p style="color:#000;">Template by <a target="_blank" href="http://www.themeum.com">Themeum</a> | All images from <a target="_blank" href="http://www.themeum.com">freepik.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="../inc/assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../inc/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../inc/assets/plugins/jquery-datatable/dataTables.fixedHeader.min.js"></script>
    <script src="../inc/assets/plugins/jquery-datatable/responsive/js/dataTables.responsive.min.js"></script>
    <script src="../inc/assets/plugins/jquery-datatable/responsive/js/responsive.bootstrap.min.js"></script>

    <script src="../home/js/jquery.slimscroll.min.js"></script>
    <script src="../home/calendar/js/underscore-min.js"></script>

    <script src= "../home/calendar/js/moment-2.2.1.js"></script>

    <script src="../home/calendar/js/clndr.js"></script>

    <script src="../home/calendar/js/site.js"></script>

    <script src="../home/calendar/js/flipclock.js"></script>  
    <script type="text/javascript">
   /* $(document).ready(function(){
            $('#example').DataTable({
              language: {
                paginate: {
                  next: '     ', // or '→'
                  previous: '     ' // or '←' 
                }
              }
            }); 

            $('#example1').DataTable({
              language: {
                paginate: {
                  next: '     ', // or '→'
                  previous: '     ' // or '←' 
                }
              }
            });        


    });*/
                    var clock;
            
                    $(document).ready(function() {
                        clock = $('.clock').FlipClock({
                            clockFace: 'TwentyFourHourClock'//'TwelveHourClock' //
                        });
                    });
</script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   
    <script type="text/javascript" src="js/main1.js"></script>   
    <!-- Jquery DataTable Plugin Js -->

    <script type="text/javascript">
$(document).ready(function() {
var t = $('.tbl').DataTable( {
        responsive: true,
        "autoWidth": false,
        "language": {
            "search": "Filter data:",
            "emptyTable":     "<center>Belum ada data dalam database!</center>",
            "zeroRecords":    "<center>Tidak ditemukan data yang sesuai dengan kata kunci!</center>",
            "lengthMenu":     "Tampilkan _MENU_ entri",
            "info":           "Menampilkan _START_ - _END_ / _TOTAL_ entri",
            "infoEmpty":      "Menampilkan 0 - 0 dari 0 entri",
            "infoFiltered":   "(difilter dari _MAX_ total entri)",
            "paginate": {
                "next":       "     ",
                "previous":   "     "
            },

        },
        /*"createdRow": function( row, data, dataIndex ) {
            if (dataIndex+1 < 2) {
                $(row).css('background-color', '#c1ffd0');
            }else{
                $(row).css('background-color', '#ffc7c1')
            }     
        }*/

    } );
    /*t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
        
    } ).draw();*/

 } );

 $(function(){ 
    $('.scroll').slimScroll({
        height: '600px'
    });
});    
       
    </script>
<!-- </body></html> -->
</body>
</html>
