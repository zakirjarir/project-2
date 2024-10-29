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

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!--    bootstrap link-->
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

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary ">
                        <h6 class="m-0 font-weight-bold text-white">Update Catagpry</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                 aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">


                        <?php
                        $imageError = [];
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $updateSlaider = $_POST["updateSlaider"] ?? null;

                            $extensions = array("jpeg", "jpg", "png", "pdf", "docx");


                            if (empty($updateSlaider)) {
                                echo "<h5 style='color:red;'>Please fill all the fields</h5>";
                            } else {
                                $uploaded_images = [];
                                $images = isset($_FILES['image']) && is_array($_FILES['image']) ? $_FILES['image'] : [];

                                $imageNo = 0;
                                foreach ($images as $key => $image){
                                    $file_name = $images['name'][$imageNo];
                                    $file_size = $images['size'][$imageNo];
                                    $file_tmp = $images['tmp_name'][$imageNo];

                                    $div = explode('.', $file_name);
                                    $file_ext = strtolower(end($div));
                                    $unik_image = strtolower(str_replace(' ', '_', $file_name));
                                    $uplod_image = "../images/" . $unik_image;
                                    $uplod_image_name = "images/" . $unik_image;
                                    if ($file_size >= 8388608) {
                                        $imageError[] = "File size must be under 8 MB for image ";
                                    } elseif (!in_array($file_ext, $extensions)) {
                                        $imageError[] = "File type for image $key must be JPEG, JPG, PNG, PDF, or DOCX";
                                    } else {
                                        if (move_uploaded_file($file_tmp, $uplod_image)) {
                                            $uploaded_images[] = $uplod_image_name;
                                        } else {
                                            $imageError[] = "File upload failed for image $key Check permissions or file path";
                                        }
                                    }

                                    $imageNo++;
                                }

                                $model = new BaseModel('slaider');
                                $model->radyForUpdate([
                                    'image_name' => $updateSlaider,
                                ]);
                                $update = $model->update('id',1);
                                $update = $update->id ;
                                foreach ($uploaded_images as $image){
                                    $model = new BaseModel('slaider_image');
                                    $model->radyForUpdate([
                                        'image_id' => $update,
                                        'image_name' => $image,
                                    ]);
                                    $savequry = $model->update('image_id',$update);
                                }

                                if ($savequry) {
                                    echo "<h3>Post Update Successfully</h3>";
                                } else {
                                    echo "<h3>Post Not updated</h3>";
                                }
                            }
                        }
                        ?>

                        <?php
                        foreach ($imageError as $error){
                            echo $error;
                        }
                        ?>
                        <form action="" method="Post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slaider Image</label>
                                <input type="file" multiple class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="image[]" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slaider Name</label>
                                <input type="text" multiple class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="updateSlaider" >
                            </div>
                            <div class="d-flex justify-content-center ">
                                <input class="btn btn-outline-primary p-2 w-25  " type="submit" value="Save" >
                            </div>
                            <br>
                        </form>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>