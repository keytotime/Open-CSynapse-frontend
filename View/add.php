<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

echo $head . '

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
                                            <div class="btn-group" data-toggle="buttons">
                                            ' . $buttons . '
                                        </div>

                                        </div>
                                        
                                        <br><br>
                                        <input type="hidden" name="redirect" value="index.php" />
                                        <button type="submit" value="submit" class="btn btn-primary">Add Algorithms</button>

                                        
                                          
                                        </form>

  
  
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
    
    $(\'form\').submit(function(e){
      if($(\'form\').find(\':checked\').length<1){
        alert(\'Please select at least one Algorithm.\')
        e.preventDefault()
      }
    })
  </script>

</html>';

?>
