$(document).ready(function() {
    // call for get brand list at the opening page
    getPageDateList();
});
function openModal(){
    $('#formModal').modal('show');
    $('#target_id').val('');
}

// brand List get function
function getPageDateList(){
    var keyword = $('#keyword').val();
    $('#loading').show();
    $.ajax({
        url: `user_action.php?datalist=yes&keyword=${keyword}`, // url for search and get list
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
$(document).on('submit', '#formModal #userFrom', function (e) {
    e.preventDefault();

    var fileUpload = $("#image").get(0);
    var profileImage = fileUpload.files[0];

    var form = new FormData();
    form.append('firstName', $('#first_name').val());
    form.append('lastName', $('#last_name').val());
    form.append('email', $('#email').val());
    form.append('image', profileImage);
    $.ajax({
        url: "user_action.php",
        type: "post",
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        data: form ,
        success: function (response) {
            var data = JSON.parse(response);
            if (data.status == 'success'){
                toastr.success(data.message);
                $('#first_name').val('') ;
                $('#last_name').val('');
                $('#email').val('');
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
            url: "user_action.php",
            type: "get",
            data: {
                userDel : id,
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
        url: `user_action.php?get_edit_data=${id}`,
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

