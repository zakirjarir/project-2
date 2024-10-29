<?php
use models\BaseModel;

include('../lib/DBConnection.php');
include('../models/BaseModel.php');
include('../helper/help.php');
$fm =new format();
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

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Post list</h1>
                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                    For more information about DataTables, please visit the <a target="_blank"
                                                                               href="https://datatables.net">official DataTables documentation</a>.</p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%" >Si No</th>
                                    <th width="12%">Image</th>
                                    <th width="5%">Product No</th>
                                    <th width="10%">Name</th>
                                    <th width="8%">Phone</th>
                                    <th width="20%">Place</th>
                                    <th width="20%">Message</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $model = new BaseModel('orders');
                                $postData = $model->select('id, name, phone, country, city, distic, thana, place, message, date, product_id')
                                    ->get();

                                if($postData){
                                    $i= 1 ;
                                    foreach($postData as $key =>$Value){ ?>
                                        <?php
                                        $model = new BaseModel('images');
                                        $image = $model->select('`image_name`')->where('product_id', $Value->product_id)->orderBy('id', 'DESC')->first();
                                        ?>
                                        <tr>
                                            <td><?php echo $i ; ?></td>
                                            <td> <img src="../<?php echo $image ? $image->image_name : '' ;?>"height="120px " width="150px" > </td>
                                            <td><?php echo $Value->product_id ; ?></td>
                                            <td><?php echo $Value->name ; ?></td>
                                            <td><?php echo $Value->phone ; ?></td>
                                            <td><?php echo $Value->country . ", ". $Value->city .", " . $Value->city .", ".$Value->distic.", ".$Value->thana.", ".$Value->place ; ?></td>
                                            <td><?php echo $Value->message ; ?></td>
                                            <td><?php echo $Value->date ; ?></td>
                                            <td> <a href="#" >Edit</a> || <a href="" >Delet </a> </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }} ?>
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

<?php include('link/headerLink.php'); ?>

</body>

</html>