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
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">About</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="col-lg-8">
                    <div class="jumbotron">
                        <h1>What is CSynapse?</h1>
                        <h3>CSynapse is a service designed to help you answer common questions associated with Machine Learning such as:</h3><br>
                        <h2>Is my data learnable?</h2>
                        <p>CSynapse allows you to quickly see how well your data can be learned by popular machine learning algorithms. Create a CSynapse, upload your data, pick your algorithms and we’ll take care of the rest.</p>
                        <h2>Which algorithm fits my data?</h2>
                        <p>CSynapse allows you to compare how well different algorithms can learn your data. A mean cross validation score and time to run for each algorithm gives you the information you need to find the best algorithm for you.</p>
                        <h2>Prediction?</h2>
                        <p>After you’ve found and trained the right algorithm for the job, upload your untagged data and we’ll provide predictions for you.</p>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.container-fluid -->
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

</html>'

?>