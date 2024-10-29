<?php
use models\BaseModel ;
include('../lib/DBConnection.php');
include('../models/BaseModel.php');
include('../helper/help.php');
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
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary ">
                        <h6 class="m-0 font-weight-bold text-white">Add Page Logo</h6>
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
<!---->
<!--                        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){-->
<!--                        $file_name = $_FILES['image']['name'];-->
<!--                        $file_size = $_FILES['image']['size'];-->
<!--                        $file_tmp = $_FILES['image']['tmp_name'];-->
<!--                        $div = explode('.',$file_name);-->
<!--                        $file_ext = strtolower(end($div));-->
<!--                        $unik_image = substr(md5(time()), 0, 10).'.'.$file_ext;-->
<!--                        $uplod_image = "../images/".$unik_image;-->
<!--                        $uplod_image_name = "images/".$unik_image;-->
<!---->
<!---->
<!--                        if($file_size >= 4194304) { ?>-->
<!---->
<!--                        <h5 style="color:red;">File size must be under 4 MB </h5>-->
<!---->
<!--                        --><?php //} elseif(!in_array($file_ext, $extensions)){ ?>
<!--                        <h5 style="color:red;">File type must be JPEG, JPG, PNG, PDF, or DOCX </h5>-->
<!--                        --><?php //} else {
//                    move_uploaded_file($file_tmp, $uplod_image); ?>

                        <?php
                        $extensions = ["jpeg", "jpg", "png", "pdf", "docx"];
                        if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){


                            $file_name = $_FILES['logo']['name'];
                            $file_tmp = $_FILES['logo']['tmp_name'];
                            $file_size = $_FILES['logo']['size'];
                            $div = explode('.',$file_name);
                            $file_ext = strtolower(end($div));
                            $name_genaret = substr(md5(time()), 0, 10).'.'.$file_ext;
                            $uplod_image = "../images/".$name_genaret;
                            $uplod_image_name = "images/".$name_genaret;
                            if($file_size >= 4194304) {
                                echo "<div class='alert alert-danger'>File size must be under 4 MB </div> >";
                            }elseif(!in_array($file_ext, $extensions)){
                                    echo"<div class='alert alert-danger' role='alert'> File type must be JPEG, JPG, PNG, PDF, or DOCX </div>" ;
                            }else{
                                move_uploaded_file($file_tmp,$uplod_image);

                                $model = new BaseModel('pagelogo');
                                $data = $model->radyForUpdate([
                                    'url' => $uplod_image_name
                                ])->update('id',1);
                                if($data) {
                                    echo "<div class='alert alert-success' role='alert'> Logo Updated </div>";
                                }else{
                                    echo "<div class='alert alert-danger' role='alert'> Logo Not Updated. </div>" ;
                                }
                            }
                        }
                        ?>

                        <form method="post" action="" enctype="multipart/form-data" >
                            <div class="form-group">
                                <?php
                                $selectmodel = new BaseModel('pagelogo');
                                $selectdata = $selectmodel->select('url')->get();
                                if($selectdata){
                                   foreach ($selectdata as $key => $image){?>
                                <img src="../<?php echo $image->url ;?>" alt="Image not Found" width="100px" height="100px" >
                                <?php } }?>
                                <br>
                                <label for="logo">logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" aria-describedby="emailHelp" >
                            </div>
                            <br>
                            <br>
                            <div class="d-flex justify-content-center ">
                                <input class="btn btn-outline-primary p-2 w-25" type="submit" value="Upadte" >
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

<?php include('link/footerLink.php'); ?>

</body>

</html>