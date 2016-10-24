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
                    <h1 class="page-header">Classify Data</h1>
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
                                    <form action="classify.php' . $gets .  '" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                            <p class="help-block">Give your Dataset a descriptive name.</p>
                                            <br>

                                        </div>
                                        <label class="control-label">Select File</label>
                                        <input type="file" id="upload" name="upload[]" class="file" data-show-upload="false" multiple required>
                                        <p class="help-block">Files should be of type .csv with format "label,x,y,z\n". </p>
                                        
                                        <br><br>
                                        <button type="submit" value="submit" class="btn btn-primary">Classify</button>

                                        
                                          
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

</html>';

?>

