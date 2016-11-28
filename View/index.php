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
                    <h1 class="page-header">Dashboard, Welcome '.$username.'</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-sitemap fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">' . $position . '</div>
                                        <div>CSynapses</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">' . $num_classified . '</div>
                                        <div>Classified</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cog fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">0</div>
                                        <div>Training</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->                
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart fa-fw"></i> My CSynapses
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <!--<th>#</th>-->
                                            <th>Name</th>
                                            <th>Status</th>
                                            <!--<th>Data Type</th>-->
                                            <!--<th>Algorithms</th>-->
                                            <!--Amount of data -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ' . $table . '
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
            </div>
            <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Classifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">'. $notification . 
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-ok"></i> Classification of name has completed. 
                        //             <span class="pull-right text-muted small"><em>4 minutes ago</em></span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-cog"></i> Traffic Congestion Training Started
                        //             <span class="pull-right text-muted small"><em>4 Hours ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-ok"></i> Traffic Congestion CSynapse Created
                        //             <span class="pull-right text-muted small"><em>4 Hours ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-cog"></i> Weather Patterns: Texas Training Started
                        //             <span class="pull-right text-muted small"><em>6 Hours ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-ok"></i> Weather Patterns: Texas CSynapse Created
                        //             <span class="pull-right text-muted small"><em>7 Hours Ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-trash"></i> Poker Hand Analysis CSynapse Deleted
                        //             <span class="pull-right text-muted small"><em>10 Hours Ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-ok"></i> Poker Hand Analysis Training Completed
                        //             <span class="pull-right text-muted small"><em>1 Day Ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="glyphicon glyphicon-cog"></i> Poker Hand Analysis Training Started
                        //             <span class="pull-right text-muted small"><em>2 Days Ago</em>
                        //             </span>
                        //         </a>
                        //         <a href="#" class="list-group-item">
                        //             <i class="fa fa-money fa-fw"></i> Poker Hand Analysis CSynapse Created
                        //             <span class="pull-right text-muted small"><em>2 Days Ago</em>
                        //             </span>
                        //         </a>
                            '</div>
                            <!-- /.list-group -->
                            <a href="classifications.php" class="btn btn-default btn-block">View All</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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

</html>';

?>
