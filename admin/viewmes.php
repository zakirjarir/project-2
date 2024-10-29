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
            <div class="container">
                <div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="shadow-lg bg-light w-100 h-100 ">
                            <form class="p-4" action="" method="post" enctype="multipart/form-data" >
                                <div>
                                    <?php
                                    if (isset($_GET['opensms'])) {
                                        $opensmsid = $_GET['opensms'];
                                        $model = new BaseModel('contact');

                                        $postData = $model->select()->where('id', $opensmsid)->first();

                                        if ($postData) { ?>
                                            <h5> Name : <?php echo htmlspecialchars($postData->name); ?> </h5>
                                            <br>
                                            <h5> Email : <?php echo htmlspecialchars($postData->email); ?> </h5>
                                            <br>
                                            <h5> Subject : <?php echo htmlspecialchars($postData->subject); ?> </h5>
                                            <br>
                                            <h5>Message :</h5>
                                            <br>
                                            <h5><?php echo nl2br(htmlspecialchars($postData->message)); ?></h5>
                                        <?php } else { ?>
                                            <h5>No message found</h5>
                                        <?php }
                                    }
                                    ?>

                                </div>
                                <br>
                                <br>
                                <br>
                                <a class="btn btn-outline-primary" > Ok </a>
                                <a class="btn btn-outline-primary" > Delet </a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>




        <!-- Footer -->

        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php include('link/footerLink.php'); ?>

</body>

</html>