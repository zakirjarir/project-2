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
        url: `cat_action.php?datalist=yes&keyword=${keyword}`,
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
// $('#categoryForm').on('submit', function (e){
//
// });

$(document).on('submit', '#formModal #categoryForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: "cat_action.php",
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
            url: "cat_action.php",
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
        url: `cat_action.php?get_edit_data=${id}`,
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