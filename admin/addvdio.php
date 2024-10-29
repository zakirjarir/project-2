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

    <?php include('link/headerLink.php'); ?>
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
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger ">
                        <h6 class="m-0 font-weight-bold text-white">Add Post</h6>
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
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $title = $_POST["vdiotitle"];
                            $description = $_POST["description"];
                            $tags = $_POST["tags"];
                            $category = $_POST["category"];
                            $quality = $_POST["quality"];
                            $date = date("Y-m-d H:i:s");

                            $allowed_video_types = array("mp4", "avi", "mov", "mpeg", "wmv");
                            $allowed_image_types = array("jpeg", "jpg", "png", "gif");

                            if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
                                $video_name = $_FILES['video']['name'];
                                $video_size = $_FILES['video']['size'];
                                $video_tmp = $_FILES['video']['tmp_name'];

                                $div = explode('.', $video_name);
                                $video_ext = strtolower(end($div));
                                $unique_video = substr(md5(time()), 0, 10) . '.' . $video_ext;
                                $upload_video = "../videos/" . $unique_video;
                                $upload_video_name = "videos/" . $unique_video;

                                if ($video_size > 52428800) {
                                    echo "<h5>Video size must be under 50 MB</h5>";
                                }
                                elseif (!in_array($video_ext, $allowed_video_types)) {
                                    echo "<h5>Video type must be MP4, AVI, MOV, MPEG, or WMV</h5>";
                                }

                                else {
                                    if (move_uploaded_file($video_tmp, $upload_video)) {
//
                                    } else {
                                        echo "Sorry, there was an error uploading the video.<br>";
                                    }
                                }
                            }


                            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                                $image_name = $_FILES['image']['name'];
                                $image_size = $_FILES['image']['size'];
                                $image_tmp = $_FILES['image']['tmp_name'];

                                $div = explode('.', $image_name);
                                $image_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10) . '.' . $image_ext;
                                $upload_image = "../images/" . $unique_image;
                                $upload_image_name = "images/" . $unique_image;


                                if ($image_size > 4194304) { // 4 MB = 4194304 bytes
                                    echo "<h5>Image size must be under 4 MB</h5>";
                                }

                                elseif (!in_array($image_ext, $allowed_image_types)) {
                                    echo "<h5>Image type must be JPEG, JPG, PNG, or GIF</h5>";
                                }

                                else {
                                    if (move_uploaded_file($image_tmp, $upload_image)) {
//
                                    } else {
                                        echo "Sorry, there was an error uploading the image.<br>";
                                    }
                                }
                            }

                            if (!empty($title) && !empty($description) && !empty($tags) && !empty($category)) {

                                $model = new BaseModel('vdio');
                                $model->readyForInsert([
                                    'url' => $upload_video_name,
                                    'title' => $title,
                                    'tumbail' => $upload_image_name,
                                    'description' => $description,
                                    'catagory' => $category,
                                    'tags' => $tags,
                                    'date' => $date,
                                    'quality' => $quality,
                                ]);
                                $savequery = $model->save();

                                if ($savequery) {
                                    echo "<h3>Video and Image uploaded successfully</h3>";
                                } else {
                                    echo "<h3>Data not saved in the database</h3>";
                                }
                            } else {
                                echo "<h5>Please fill all the fields</h5>";
                            }
                        }
                        ?>

                        <form class="bg-light" action="" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Add Vdio</label>
                                <input type="file" class="form-control" name="video" id="exampleInputEmail1" aria-describedby="emailHelp" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Vdio Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="vdiotitle" aria-describedby="emailHelp" placeholder="Enter Post Title">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Add Thumbail Image</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" name="image" aria-describedby="emailHelp" >
                            </div>
                            <label>Select Catagory</label>
                            <select name="category" class="form-control" aria-label="Default select example">
                                <option selected> Catagory</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <br>
                            <br>
                            <div class="form-floating">
                                <div>
                                    <label for="floatingTextarea2">Descibtion</label>
                                </div>
                                <textarea class="form-control" placeholder="Enter Details" name="description"  id="floatingTextarea2" style="height: 100px"></textarea>

                            </div>
                            <br>
                            <label>Select Vdio Quality</label>
                            <select name="quality" class="form-control" aria-label="Default select example">
                                <option selected>Vdio Quality</option>
                                <option value="1">Letest</option>
                                <option value="2">Popular</option>
                                <option value="3">Tanding</option>
                            </select>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tags</label>
                                <input type="text" class="form-control" name="tags" id="exampleInputEmail1" aria-describedby="emailHelp" >
                            </div>

                            <br>
                            <div class="d-flex justify-content-center ">
                                <input class="btn btn-outline-danger p-2 w-25  " type="submit" value="Save" >
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