<?php

use models\BaseModel;

$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';
include("$root/helper/help.php");
include("$root/lib/DBConnection.php");
include("$root/models/BaseModel.php");


if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $uploadedImageName = '';
    if (isset($_FILES['image'])) {
        $uplodImage = uploadFile($root, $_FILES['image'], 'images/user');
        $uploadedImageName = $uplodImage ??  '';
    }

    $target_id = isset($_POST['target_id']) && !empty($_POST['target_id']) ? $_POST['target_id'] : 0;
    if(empty($firstName) && empty($lastName) && empty($email)) {
        echo responseJson('error', 'Pleease fill all input', '');
        return;
    }
    if(empty($uploadedImageName)){
        echo responseJson('error', 'You must upload an image', '');
        return;
    }

    $targetData = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' =>$email,
        'picture' =>$uplodImage
    ];
    if ($target_id){
        $model = new BaseModel('user1');
        $addcat =  $model->radyForUpdate($targetData);

        $upcate = $addcat->update( 'id',$target_id);

        if ($upcate) {
            echo responseJson('success', 'User Update Sucessful', '');
            return;
        }
        echo responseJson('error', 'User Not found', '');
        return;
    }

    $model = new BaseModel('user1');
    $model->readyForInsert($targetData);
    $dataSave = $model->save();
    if($dataSave){
        echo responseJson('success', 'User Data Saved','');
    }else{
        echo responseJson('error', 'User Data not Saved','');
    }
}

if (isset($_GET['userDel'])) {
    $delId = $_GET['userDel'];
    $model = new BaseModel('user1');
    $postData = $model->select(' id, first_name, last_name, email, picture')
        ->where('id', $delId)
        ->first();
    if ($postData) {
        if ($delete = $model->delete($delId)) {
            echo responseJson('success', 'User Deleted', '');
        } else {
            echo responseJson('error', 'User Not Deleted', '');
        }
    } else {
        echo responseJson('error', 'No User found with this ID!', '');
    }
}

if (isset($_GET['get_edit_data'])) {
    $get_edit_data_id = $_GET['get_edit_data'];
    $model = new BaseModel('user1');
    $postData = $model->select('id as target_id, first_name , last_name , email ')->where('id', $get_edit_data_id)->first();
    if ($postData) {
        echo responseJson('success', 'User Deleted', json_encode($postData));
    } else {
        echo responseJson('error', 'No User found with this ID!', '');
    }
}

if (isset($_GET['datalist'])) {
    $keyword = isset($_GET['keyword']) && !empty($_GET['keyword']) ? $_GET['keyword'] : '';
    $model = new BaseModel('user1');
    $postData = $model->select('id, first_name, last_name, email, picture')->where('first_name', "%$keyword%", 'like')->orderBy('id', 'DESC')->get();
    $pageData = '';
    if ($postData) {
        $i = 1;
        foreach ($postData as $key => $post) {
            $picture = asset($post->picture, true);
            $pageData .= "<tr>
                <td> $i</td>
                <td> $post->first_name</td>
                <td> $post->last_name</td>
                <td> $post->email</td>
                 <td><img height='50' src='$picture'></td>
                <td>
                    <a class='btn btn-outline-info editButton' id='$post->id'> Edit</a>
                    <a class='btn btn-outline-danger delButton' id='$post->id'> Delete</a>
                </td>
            </tr>";
            $i++;
        }
    }
    echo $pageData;
}

