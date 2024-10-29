<?php
use models\BaseModel;

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
                        <h6 class="m-0 font-weight-bold text-white">Add Page Title</h6>
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
<!--                        officeaddress table data update-->
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $address = $_POST["address"];
                            $email = $_POST["email"];
                            $phone = $_POST["phone"];
                            $details = $_POST["details"];

                            if($address == "" || $email == "" || $phone == "" || $details == ""){
                                echo '<h5 class="alert alert-danger">Please fill out all fields!</h5>';
                            }else{
                                $model = new BaseModel('officeaddress');
                                $data = $model->radyForUpdate([
                                'address' => $address,
                                'phone' => $phone,
                                'email' => $email,
                                'other' => $details
                                ])->update('id',1) ;
                                if($data){
                                    echo '<h5 class="alert alert-success">Data Updated!</h5>';
                                }else{
                                    echo '<h5 class="alert alert-danger">Something went wrong!</h5>';
                                }
                            }
                        }
                        ?>
<!--                        officeaddress table data update from-->
                        <form action="" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" class="form-control" id="Address" aria-describedby="emailHelp" name="address" placeholder="Address">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="text" class="form-control" id="Phone" aria-describedby="emailHelp" name="phone" placeholder="Phone">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="Information">Other Information</label>
                                <input type="text" class="form-control" id="Information" aria-describedby="emailHelp" name="details" placeholder="Other Information">
                            </div>
                            <br>
                            <div class="d-flex justify-content-center ">
                                <input class="btn btn-outline-primary p-2 w-25  " type="submit" value="Upadte" >
                            </div>
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