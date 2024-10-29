<?php
use models\BaseModel;

include('../lib/DBConnection.php');
include('../models/BaseModel.php');
include('../helper/help.php');

$db = new DBConection();
$condb = $db->conaction();
$model = new BaseModel('catagory');
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Catagory Table</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!--    Bootstrap link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include('layouts/saidbar.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include('layouts/topbar.php') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php
                if (isset($_GET['delvdio'])) {
                    $vdiodel = $_GET['delvdio'];
                    $model = new BaseModel('vdio');
                    $postData = $model->select('id, url, title, tumbail, description, catagory, tags, date, quality')
                        ->where('id', $vdiodel)
                        ->first();

                    if ($postData) {
                        $imagePath = '../' . $postData->tumbail;
                        $videoPath = '../' . $postData->url;

                        if (file_exists($imagePath)) {
                            if (unlink($imagePath)) {
                                echo "Image deleted successfully.<br>";
                            } else {
                                echo "Sorry, could not delete the image.<br>";
                            }

                            if (file_exists($videoPath)) {
                                if (unlink($videoPath)) {
                                    echo "Video deleted successfully.<br>";
                                } else {
                                    echo "Sorry, could not delete the video.<br>";
                                }

                                if ($model->delete($vdiodel)) {
                                    echo "<h3>Category Deleted</h3>";
                                    echo "<script>setTimeout(function() {
                                        window.location.href = 'vdiolist.php';
                                    }, 1000);</script>";
                                } else {
                                    echo "<h3>Category Not Deleted</h3>";
                                }
                            } else {
                                echo "<h3>No category found with this ID!</h3>";
                            }
                        }
                    }
                }
                ?>


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Catagory Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Si No</th>
                                    <th>Vdio</th>
                                    <th>Title</th>
                                    <th>Dicribtion</th>
                                    <th>Cat</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Si No</th>
                                    <th>Vdio</th>
                                    <th>Title</th>
                                    <th>Dicribtion</th>
                                    <th>Cat</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                $model = new BaseModel('vdio');
                                $postData = $model->select('id , url, title, tumbail, description, catagory, tags, date')
                                    ->get();
                                if ($postData) {
                                    $i = 1;
                                    foreach ($postData as $key => $post) { ?>
                                        <tr>
                                            <th><?php echo $i ;?></th>
                                            <th><video width="150" height="100" controls poster="../<?php echo $post->tumbail ;?>">
                                                    <source src="../<?php echo $post->url ;?>" type="video/mp4">
                                                    <source src="../<?php echo $post->url ;?>" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </th>
                                            <th><?php echo $post->title ;?></th>
                                            <th><?php echo $post->description ;?></th>
                                            <th><?php echo $post->catagory ;?></th>
                                            <th><?php echo $post->tumbail ;?></th>
                                            <th><?php echo $post->date ;?></th>
                                            <td> <a href="" class="btn btn-outline-info"> Edit</a> ||<a class="btn btn-outline-danger" onclick="return confirm('Are You Sure To Delete This Data?')" href="vdiolist.php?delvdio=<?php echo $post->id; ?>"> Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php }
                                } else {
                                    echo "<h3> No data found!</h3>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include('layouts/footer.php') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>