<?php
use models\BaseModel;

$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';
include("$root/helper/help.php");
include("$root/lib/DBConnection.php");
include("$root/models/BaseModel.php");

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
    <?php include("$root/admin/layouts/saidbar.php") ?>
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


                <!-- DataTales Example -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Brand</h6>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button onclick="openModal()" class="btn btn-primary"> + Add New</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="keyword">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-info" onclick="getPageDateList()">Search</button>
                                        <button id="loading" class="btn btn-success">Loading</button>
                                    </div>
                                </div>
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Si No</th>
                                        <th>Image </th>
                                        <th>Name</th>
                                        <th>Url</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableData"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="modal" id="formModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form  method="post" id="brandFrom" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="target_id" ">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="brandName" class="text-dark" >Brand name</label>
                                    <input type="text" class="form-control border-2 border-dark"  id="brandName" aria-describedby="emailHelp" placeholder="Enter Catagory Name" name="brname" >

                                    <label for="brandImage" class="text-dark" > Brand Image</label>
                                    <input type="file" class="form-control border-2 border-dark" id="brandImage" aria-describedby="emailHelp" placeholder="Enter Catagory Name" name="img" >

                                    <label class="text-dark">Brand Url</label>
                                    <input id="url" type="text" class="form-control border-2 border-dark " >
                                </div>
                        </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <?php include("$root/admin/layouts/footer.php") ?>

    </div>
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
<?php include("$root/admin/link/footerLink.php"); ?>



<script src="<?php asset('admin/modules_js/brand_action.js')?>" ></script>
</body>

</html>