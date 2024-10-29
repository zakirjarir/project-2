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

<!-- Page Wrapper -->
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
                                <h6 class="m-0 font-weight-bold text-primary">Catagory Table</h6>
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
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tableData"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" id="categoryForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="target_id" name="target_id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Catagory Name</label>
                                    <input type="text" class="form-control" id="catname" aria-describedby="emailHelp" placeholder="Enter Catagory Name" name="catname" >
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
<?php include("$root/admin/link/footerLink.php") ?>

<script>
    function openModal(){
        $('#formModal').modal('show');
        $('#target_id').val('');
    }
    $(document).ready(function() {
        getPageDateList();
    });
    function getPageDateList(){
        var keyword = $('#keyword').val();
        $('#loading').show();
        $.ajax({
            url: `cat_action2.php?datalist=yes&keyword=${keyword}`,
            type: "get",
            success: function (response) {
                $('#loading').hide();
                $('#tableData').html(response)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    $(document).on('submit', '#formModal #categoryForm', function (e) {
        e.preventDefault();
        $.ajax({
            url: "cat_action2.php",
            type: "post",
            data: {
                catname : $('#catname').val(),
                target_id : $('#target_id').val(),
            } ,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.status == 'success'){
                    toastr.success(data.message);
                    $('#catname').val('');
                    $('#formModal').modal("hide");
                    getPageDateList();
                }else{
                    toastr.error(data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });


    $(document).on('click', '.delButton', function (e) {
        var id = $(this).attr('id');
        var conf = confirm('Are You Sure To Delete This Data?');
        if (conf){
            $.ajax({
                url: "cat_action2.php",
                type: "get",
                data: {
                    delcat : id,
                } ,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.status == 'success'){
                        toastr.success(data.message);
                        getPageDateList();
                    }else{
                        toastr.error(data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });

    $(document).on('click', '.editButton', function (e) {
        var id = $(this).attr('id');
        $.ajax({
            url: `cat_action2.php?get_edit_data=${id}`,
            type: "get",
            success: function (response) {
                openModal();
                var returlData = JSON.parse(response);
                var cateData = JSON.parse(returlData.data);
                $.each(cateData, function (index, value){
                    $(`#${index}`).val(value);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

</script>

</body>

</html>