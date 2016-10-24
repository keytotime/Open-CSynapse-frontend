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
                        <h1 class="page-header">' . $csynapse . '</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            CSynapse Info
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Algorithm</th>
                                            <th>Accuracy</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>' . $datatable . '
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <div class = "row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Classification Accuracy
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="accuracy"></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Plot of Input Data
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        View
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="results.php?id=' . $csynapse . '&plot=2d">2-Dimensional</a>
                                        </li>
                                        <li><a href="results.php?id=' . $csynapse . '&plot=3d">3-Dimensional</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="scatterplot'. $plot .'"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class = "row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Training Time
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="runspeed"></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                    </div>
                </div>       
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
    var accuracydata = ' . $accuracydata . ';
    var speeddata = ' . $speeddata . ';
    var scatterdata = ' . $scatterdata . ';
    </script>
    <script src="../js/accuracy.js"></script>
    <script src="../js/runspeed.js"></script>'
    . $plotdisplay . 
    '


    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $(\'#datatable\').DataTable({
                "searching": false,
                responsive: true,
                paging: false,
                "bInfo": false,
                "order": [[ 2, "asc" ]]
        });
    });
    </script>

</body>

</html>';

?>