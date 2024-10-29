<?php

use models\BaseModel;

$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';
include("$root/helper/help.php");
include("$root/lib/DBConnection.php");
include("$root/models/BaseModel.php");

if (isset($_POST['catname'])) {
    $catname = $_POST['catname'];
    $target_id = isset($_POST['target_id']) && !empty($_POST['target_id']) ? $_POST['target_id'] : 0;
    if(empty($catname)){
        echo responseJson('error', 'Pleease fill all input', '');
        return;
    }

    if ($target_id){
        $model = new BaseModel('catagory');
        $addcat =  $model->radyForUpdate([
            'name' => $catname
        ]) ;
        $upcate = $addcat->update( 'id',$target_id);

        if ($upcate) {
            echo responseJson('success', 'Catagory Inserted Sucessful', '');
            return;
        }
        echo responseJson('success', 'Catagory Not found', '');
        return;
    }

    $model = new BaseModel('catagory');
    $model->readyForInsert([
        'name'=>$catname ,
    ]);
    $savequry = $model->save();
    if($savequry){
        echo responseJson('success', 'Data Saved', '');
    }else{
        echo responseJson('error', 'Data not Saved');
    }
}
if (isset($_GET['delcat'])) {
    $catdel = $_GET['delcat'];
    $model = new BaseModel('catagory');
    $postData = $model->select('id, name')
        ->where('id', $catdel)
        ->first();
    if ($postData) {
        if ($delete = $model->delete($catdel)) {
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
    $model = new BaseModel('catagory');
    $postData = $model->select('id as target_id, name as catname')->where('id', $get_edit_data_id)->first();
    if ($postData) {
        echo responseJson('success', 'Category Deleted', json_encode($postData));
    } else {
        echo responseJson('error', 'No category found with this ID!', '');
    }
}
if (isset($_GET['datalist'])) {
    $keyword = isset($_GET['keyword']) && !empty($_GET['keyword']) ? $_GET['keyword'] : '';
    $model = new BaseModel('catagory');
    $postData = $model->select('id ,name')->where('name', "%$keyword%", 'like')->orderBy('id', 'DESC')->get();
    $pageData = '';
    if ($postData) {
        $i = 1;
        foreach ($postData as $key => $post) {
            $pageData .= "<tr>
                <td> $i</td>
                <td> $post->name</td>
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