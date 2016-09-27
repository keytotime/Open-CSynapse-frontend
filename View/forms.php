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
                                            <p class="help-block">Give your CSynapse a descrptive name.</p>
                                            <br>
                                            <label>Choose Your Algorithms</label>
                                            <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="adaBoost" > Adaboost with Decision Trees
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="decisionTree" > Decision Tree
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="guassNB" > Gaussian NaiveBayes
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="knearest" > Nearest Neighbors
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="nearestCentroid" > Nearest Centroid
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="passiveAggressive" > Passive Aggressive Classifier
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="perceptron" > Perceptron
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="randomForest" > Random Forest
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="sgd" > Vanilla Stochastic Gradient Descent
                                            </label>
                                            <label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
                                                <input type="checkbox" name="algorithm" value="svm" > Support Vector Machine
                                            </label>
                                        </div>

                                        </div>
                                        <br>
                                        <label class="control-label">Select File</label>
                                        <input type="file" id="upload" name="upload" class="file" data-show-upload="false" required>
                                        <p class="help-block">Files should be of type .csv with format "label,x,y,z\n". </p>
                                        
                                        <br><br>
                                        <input type="hidden" name="redirect" value="index.php" />
                                        <button type="submit" value="submit" class="btn btn-primary">Create CSynapse</button>

                                        
                                          
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
