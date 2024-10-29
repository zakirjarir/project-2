<?php
$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';
include("$root/helper/help.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("$root/admin/link/headerLink.php"); ?>
</head>
<body id="page-top">

<div id="wrapper">
    <?php include("$root/admin/layouts/saidbar.php"); ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include("$root/admin/layouts/topbar.php"); ?>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="m-0 font-weight-bold text-primary">Category Table</h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <button onclick="openModal()" class="btn btn-primary">Add New</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="keyword" placeholder="Search...">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-info" onclick="getPageDateList()">Search</button>
                                    <button id="loading" class="btn btn-success d-none">Loading</button>
                                </div>
                            </div>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Si No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Model</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" id="prdForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="p-4">
                                <!-- Product image, name, model, price, and other inputs -->
                                <div class="form-group">
                                    <label>Product main image</label>
                                    <input type="file" multiple class="form-control" id="image" name="image[]" >
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" id="name" name="prdName" placeholder="Enter Product Name" >
                                </div>
                                <div class="form-group">
                                    <label>Product Model</label>
                                    <input type="text" class="form-control" id="model" name="PrdModel" placeholder="Enter Product Model" >
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input type="text" class="form-control" id="price" name="PrdPrise" placeholder="Enter Product Price" >
                                </div>
                                <div class="form-group">
                                    <label>Product Details</label>
                                    <textarea class="form-control" name="details" id="details" style="height: 100px" placeholder="Enter Details"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select id="cat" name="cat" class="form-control" >
                                        <option value="">Select one</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Stock Status</label>
                                    <input type="number" class="form-control" id="status" name="status" >
                                </div>
                                <div class="form-group">
                                    <label>Tags</label>
                                    <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter Tags">
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
        <?php include("$root/admin/layouts/footer.php"); ?>
    </div>
</div>

<?php include("$root/admin/link/footerLink.php"); ?>

<script src="<?php asset('admin/modules_js/product_action.js')?>" ></script>

</body>
</html>

