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
                        <h1 class="page-header">LLIF Neural Network</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="col-lg-8">
                    <div class="jumbotron">
                        <h1>Why LLIF?</h1>
                        <h3>We are using a custom made Linear leaky integrate and fire (LLIF) spiking neural network. This type of neural network much more closely simulates the human brain compared to more typical nueral networks. It has advantages in that this nueral network is far more efficient and is easier to parallelize. Theoretically this parrallelization can lead to speeds 100x faster than traditional neural networks.</h3><br>
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