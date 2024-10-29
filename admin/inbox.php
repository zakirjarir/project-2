<?php
use models\BaseModel;

include('../lib/DBConnection.php');
include('../models/BaseModel.php');
include('../helper/help.php');

$db = new DBConection();
$condb = $db->conaction();

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
<!--                <h1 class="h3 mb-2 text-gray-800">Inbox</h1>-->
<!--                <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.-->
<!--                    For more information about DataTables, please visit the <a target="_blank"-->
<!--                                                                               href="https://datatables.net">official DataTables documentation</a>.</p>-->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Inbox</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                           if(isset($_GET['delmes'])) {
                               $delid = $_GET['delmes'];

                                $model  = new BaseModel('contact');
                                $delete = $model->delete($_GET['delmes']);

                                if($delete) {
                                    echo "<h3>Post has been deleted</h3>";
                                    echo '<script> setTimeout(function(){ window.location.href="inbox.php"}, 1000); </script>';
                                }else{
                               echo "<h3>Post not deleted</h3>";
                            }
                           }
                           ?>


                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Si No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Si No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </tfoot>
                                <tbody>

                                <?php
                                 $model = new BaseModel('contact');
                                 $getdata =  $model->select( 'id ,name,email,subject,message,date' )
                                    ->get();
                                    if($getdata){
                                        $i =1;
                                        foreach($getdata as $kye => $post){   ?>
                                <tr>
                                    <td><?php echo $i ; ?> </td>
                                    <td><?php echo $post->name ; ?> </td>
                                    <td><?php echo $post->email ; ?></td>
                                    <td><?php echo $post->subject ; ?></td>
                                    <td><?php echo $fm->textshort($post->message,50 ); ?></td>
                                    <td><?php echo $post->date ; ?></td>
                                    <th> <a class="btn btn-outline-primary" href="viewmes.php?opensms=<?php echo $post->id ; ?>" >View</a> || <a class="btn btn-outline-danger" href="inbox.php?delmes=<?php echo $post->id; ?>" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                                    </th>
                                </tr>

                                <?php $i++ ;
                                        }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


<!--                <div class="card shadow mb-4">-->
<!--                    <div class="card-header py-3">-->
<!--                        <h6 class="m-0 font-weight-bold text-primary">Inbox</h6>-->
<!--                    </div>-->
<!--                    <div class="card-body">-->
<!--                        <div class="table-responsive">-->
<!--                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">-->
<!--                                <thead>-->
<!--                                <tr>-->
<!--                                    <th>Name</th>-->
<!--                                    <th>Email</th>-->
<!--                                    <th>Subject</th>-->
<!--                                    <th>Message</th>-->
<!--                                    <th>Date</th>-->
<!--                                    <th>Action</th>-->
<!--                                </tr>-->
<!--                                </thead>-->
<!--                                <tfoot>-->
<!--                                <tr>-->
<!--                                    <th>Name</th>-->
<!--                                    <th>Email</th>-->
<!--                                    <th>Subject</th>-->
<!--                                    <th>Message</th>-->
<!--                                    <th>Date</th>-->
<!--                                    <th>Action</th>-->
<!---->
<!--                                </tr>-->
<!--                                </tfoot>-->
<!--                                <tbody>-->
<!---->
<!--                                --><?php
//                                $model = new BaseModel('contact');
//                                $getdata =  $model->select( 'id ,name,email,subject,message,date' )
//                                    ->get();
//                                if($getdata){
//                                    foreach($getdata as $kye => $post){   ?>
<!--                                        <tr>-->
<!--                                            <td>--><?php //echo $post->name ; ?><!-- </td>-->
<!--                                            <td>--><?php //echo $post->email ; ?><!--</td>-->
<!--                                            <td>--><?php //echo $post->subject ; ?><!--</td>-->
<!--                                            <td>--><?php //echo $post->message; ?><!--</td>-->
<!--                                            <td>--><?php //echo $post->date ; ?><!--</td>-->
<!--                                            <th> <a class="btn btn-outline-primary" href="?vewsms=--><?php //echo $post->name ; ?><!--" >View</a> || <a class="btn btn-outline-danger" href="inbox.php?delmessage=--><?php //echo $post->name ;?><!--" >Delet </a> </th>-->
<!--                                        </tr>-->
<!---->
<!--                                    --><?php //}}?>
<!---->
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

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