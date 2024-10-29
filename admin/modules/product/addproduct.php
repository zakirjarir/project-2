<?php
$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';

?>


<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("$root/admin/link/headerLink.php") ?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
 <?php include("$root/admin/layouts/saidbar.php");?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include("$root/admin/layouts/topbar.php") ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger ">
                        <h6 class="m-0 font-weight-bold text-white">Add Product </h6>
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

                        <form class="bg-light" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product main image</label>
                                <input type="file" multiple class="form-control" id="exampleInputEmail1" name="image[]" aria-describedby="emailHelp" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp" placeholder="Enter Post Title">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Model</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="model" aria-describedby="emailHelp" placeholder="Enter Post Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="price" aria-describedby="emailHelp" placeholder="Enter Product Price">
                            </div>
                            <div class="form-floating">
                                <div>
                                    <label for="floatingTextarea2">Product Details</label>
                                </div>
                                <textarea class="form-control" placeholder="Enter Details" name="details" id="floatingTextarea2" style="height: 100px"></textarea>
                            </div>
                            <label>Product Catagory</label>
                            <select class="form-control" aria-label="Default select example" name="catagory" >
                                <option selected>Select Catagory</option>
                                <?php
                                $model =new BaseModel('catagory');
                                $postData = $model->select('name')->get();
                                if ($postData) {
                                    foreach ($postData as $key => $post) {?>
                                <option value="<?php echo $post->name ;?>"><?php echo $post->name ;?></option>
                                <?php }}?>
                            </select>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Stoke status</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" name="Stokestatus" aria-describedby="emailHelp" >
                            </div>
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
                <a class="btn btn-primary" href="../../login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php include('link/footerLink.php'); ?>
</body>

</html>