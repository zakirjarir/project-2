<?php

use models\BaseModel;

$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';
include("$root/helper/help.php");
include("$root/lib/DBConnection.php");
include("$root/models/BaseModel.php");


if (isset($_POST['brandName'])) {
    $brandName = $_POST['brandName'];
    $url = $_POST['url'];

    $uploadedImageName = '';
    if (isset($_FILES['image'])) {
        $uplodImage = uploadFile($root, $_FILES['image'], 'images');
        $uploadedImageName = $uplodImage ??  '';
    }

    $target_id = isset($_POST['target_id']) && !empty($_POST['target_id']) ? $_POST['target_id'] : 0;
    if(empty($brandName)){
        echo responseJson('error', 'Pleease fill all input', '');
        return;
    }
    if(empty($uploadedImageName)){
        echo responseJson('error', 'You must upload an image', '');
        return;
    }

    $targetData = [
        'name' => $brandName,
        'image' => $uploadedImageName,
        'url' =>$url
    ];

//    if ($target_id){
//        $model = new BaseModel('brand');
//        $addcat =  $model->radyForUpdate($targetData);
//
//        $upcate = $addcat->update( 'id',$target_id);
//
//        if ($upcate) {
//            echo responseJson('success', 'Brand Inserted Sucessful', '');
//            return;
//        }
//        echo responseJson('success', 'Brand Not found', '');
//        return;
//    }

    $model = new BaseModel('brand');
    $model->readyForInsert($targetData);
    $savequry = $model->save();
    if($savequry){
        echo responseJson('success', 'Data Saved', '');
    }else{
        echo responseJson('error', 'Data not Saved');
    }
}


if (isset($_GET['delBrand'])) {
    $delBrand = $_GET['delBrand'];
    $model = new BaseModel('brand');
    $postData = $model->select('id ,name,image,url')
        ->where('id', $delBrand)
        ->first();
    if ($postData) {
        if ($delete = $model->delete($delBrand)) {
            echo responseJson('success', 'Category Deleted', '');
        } else {
            echo responseJson('error', 'Category Not Deleted', '');
        }
    } else {
        echo responseJson('error', 'No category found with this ID!', '');
    }
}
if (isset($_GET['get_edit_data'])) {
    $get_edit_data_id = $_GET['get_edit_data'];
    $model = new BaseModel('brand');
    $postData = $model->select('id as target_id, name as brandName , url')->where('id', $get_edit_data_id)->first();
    if ($postData) {
        echo responseJson('success', 'Category Deleted', json_encode($postData));
    } else {
        echo responseJson('error', 'No category found with this ID!', '');
    }
}

if (isset($_GET['datalist'])) {
    $keyword = isset($_GET['keyword']) && !empty($_GET['keyword']) ? $_GET['keyword'] : '';
    $model = new BaseModel('brand');
    $postData = $model->select('id ,name,image,url')->where('name', "%$keyword%", 'like')->orderBy('id', 'DESC')->get();
    $pageData = '';
    if ($postData) {
        $i = 1;
        foreach ($postData as $key => $post) {
            $image = asset($post->image, true);
            $pageData .= "<tr>
                <td> $i</td>
                <td><img height='50' src='$image'></td>
                <td> $post->name</td>
                <td> $post->url</td>
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

