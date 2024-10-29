function openModal(){
    $('#formModal').modal('show');
    $('#target_id').val('');
}

$(document).ready(function() {
    getPageDateList();
});

function getPageDateList(){
    $('#loading').removeClass('d-none'); // Show loading spinner
    var keyword = $('#keyword').val();

    $.ajax({
        url: `product_action.php?datalist=yes&keyword=${keyword}`,
        type: "get",
        success: function (response) {
            $('#loading').addClass('d-none'); // Hide loading spinner
            $('#tableData').html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

$(document).on('submit', '#prdForm', function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    // ইমেজ ফাইলগুলো যোগ করা হচ্ছে
    var image = $("#image")[0].files;
    if (image.length > 0) {
        for (let i = 0; i < image.length; i++) {
            formData.append('image[]', image[i]);
        }
    }

    // অন্যান্য ফর্মের ডেটা যোগ করা হচ্ছে
    formData.append('prdName', $('#name').val());
    formData.append('PrdModel', $('#model').val());
    formData.append('PrdPrise', $('#prise').val());
    formData.append('details', $('#details').val());
    formData.append('cat', $('#cat').val());
    formData.append('status', $('#status').val());
    formData.append('tags', $('#tags').val());

    // AJAX কল পাঠানো হচ্ছে
    $.ajax({
        url: "product_action.php",
        type: "post",
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        data: formData,
        success: function (response) {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                toastr.success(data.message);
                $('#formModal').modal("hide");
                getPageDateList();
            } else {
                toastr.error(data.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});



function getPageDateList(){
    var keyword = $('#keyword').val();
    $('#loading').show();
    $.ajax({
        url: `product_action.php?datalist=yes&keyword=${keyword}`, // url for search and get list
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
function getPageDateList(){
    var keyword = $('#keyword').val();
    $('#loading').show();
    $.ajax({
        url: `product_action.php?datalist=yes&keyword=${keyword}`, // url for search and get list
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


$(document).on('click', '.delButton', function (e) {
    var id = $(this).attr('id');
    var conf = confirm('Are You Sure To Delete This Data?');
    if (conf){
        $.ajax({
            url: "product_action.php",
            type: "get",
            data: {
                productDel : id,
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
        url: `product_action.php?get_edit_data=${id}`,
        type: "get",
        success: function (response) {
            openModal();
            var returlData = JSON.parse(response);
            var userData = JSON.parse(returlData.data);
            $.each(userData, function (index, value){
                $(`#${index}`).val(value);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
});
