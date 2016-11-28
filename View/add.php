<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

echo $head . $style .'

<body>

    <div id="wrapper">
        ' . $nav . '
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">'.$csynapse.'</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 col-xsm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add algorithms to this CSynapse
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="add.php?csynapse='.$csynapse.'" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" disabled="disabled" value='.$csynapse.' class="form-control" required>
                                            <br>
                                            <label>Choose Your Algorithms</label>
                                            <div id="algorithms"></div>
                                            '.$dropdown.'<a href="#" id="addRow"><i class="icon-plus-sign icon-white"></i> Add this algorithm</p></a>
                                        </div>

                                        </div>
                                        
                                        <br><br>
                                        <input type="hidden" name="redirect" value="index.php" />
                                        <button type="submit" value="submit" class="btn btn-primary disabled">Add Algorithms</button>

                                        
                                          
                                        </form>'. $params . '

  
  
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

  <script>

    $(document).ready(function () {

     $(\'#addRow\').click(function () {
        $(\'<div/>\', {\'class\' : \'extraPerson\', html: GetHtml()}).hide().appendTo(\'#algorithms\').slideDown(\'fast\');
        $(\'.disabled\').removeClass(\'disabled\');
         
        });
    })
    
    $(\'form\').submit(function(e){
      if(($(\'.disabled\').length > 0) || $(\'form\').find(\':checked\').length<1){
        alert(\'Please select at least one Algorithm.\')
        e.preventDefault()
      }
    })

     $(document).on(\'click\', \'.panel-heading span.clickable\', function(e){
    var $this = $(this);
    if(!$this.hasClass(\'panel-collapsed\')) {
        $this.closest(\'.panel\').find(\'.panel-body\').slideUp();
        $this.addClass(\'panel-collapsed\');
    $this.find(\'i\').removeClass(\'glyphicon-chevron-down\').addClass(\'glyphicon-chevron-up\');

    } else {
        $this.closest(\'.panel\').find(\'.panel-body\').slideDown();
        $this.removeClass(\'panel-collapsed\');
        $this.find(\'i\').removeClass(\'glyphicon-chevron-up\').addClass(\'glyphicon-chevron-down\');
    }
    })

    function GetHtml()
    {
        var $algorithm = \'.\' + $(\'#algorithm option:selected\').val();
        var $html = $($algorithm).clone();

        return $html.html();    
    }
 
  </script>

</html>';

?>
