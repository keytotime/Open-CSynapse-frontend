<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

echo $head . $style . '

<body>

    <div id="wrapper">
        ' . $nav . '
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create New CSynapse</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 col-xsm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Choose Algorithms and Upload Dataset 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="create.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                            <p class="help-block">Give your CSynapse a descriptive name.</p>
                                            <br>
                                            <label>Choose Your Algorithms</label>
                                            <div id="algorithms"></div>
                                            '.$dropdown.'<a href="#" id="addRow"><i class="icon-plus-sign icon-white"></i> Add this algorithm</p></a>

                                        </div>
                                        <br>
                                        <label class="control-label">Select File <div class="tip"><i class="fa fa-info-circle"></i><span class="tooltiptext">CSV files should be of type .csv with format "label,x,y,z\n". <br><hr>
                                        Image data should be in folders named with the images\' tag, zipped.<br> </</p>
                                        </span></div></label>
                                        <input type="file" id="upload" name="upload[]" class="file" data-show-upload="false" multiple required>
                                        
                                        <br><br>
                                        <input type="hidden" name="redirect" value="index.php" />

                                        <button type="submit" value="submit" class="btn btn-primary">Create CSynapse</button>

                                        
                                          
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
    <script>
    $("type = file").fileinput();

    </script>

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
         
        });
    })
    
    $(\'form\').submit(function(e){
      if($(\'form\').find(\':checked\').length<1){
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

