<?php
use models\BaseModel;

$root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite';
include("$root/helper/help.php");
include("$root/lib/DBConnection.php");
include("$root/models/BaseModel.php");


$imageError = [];
if (isset($_POST['prdName'])) {
    $name = $_POST["prdName"] ?? null;
    $model_name = $_POST["PrdModel"] ?? null;
    $price = $_POST["PrdPrise"] ?? null;
    $details = $_POST["details"] ?? null;
    $cat = $_POST["cat"] ?? null;
    $stock_status = $_POST["status"] ?? null;
    $tags = $_POST["tags"] ?? null;

    $date = date("Y-m-d H:i:s");


    $target_id = isset($_POST['target_id']) && !empty($_POST['target_id']) ? $_POST['target_id'] : 0;

    if(empty($name)||empty($model_name)||empty($price)||empty($details)||empty($cat)||empty($stock_status)||empty($tags)) {
        echo responseJson('error', 'Pleease fill all input', '');
        return;
    }


    $allowed_extensions = ["jpeg", "jpg", "png", "pdf", "docx"];

    $uploaded_images = [];

        if($images = $_FILES['image'] ?? null) {

            if ($images && is_array($images['name'])) {
                foreach ($images['name'] as $index => $file_name) {
                    $file_size = $images['size'][$index];
                    $file_tmp = $images['tmp_name'][$index];
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                    if (!in_array($file_ext, $allowed_extensions)) {
                        echo responseJson('error', 'File type for image must be JPEG, JPG, PNG, PDF, or DOCX', '');
                        return;
                    }

                    $unique_image_name = "images/products/" . uniqid() . '_' . strtolower(str_replace(' ', '_', $file_name));

                    $model = new BaseModel('product');
                    $postData = $model->select(' id')->first();
                    $get_id = $postData->id ;

                    $productcat = new BaseModel('images');
                    $image = $productcat->readyForInsert([
                        'product_id' => $get_id,
                        'image_name' => $unique_image_name

                    ])->save();

                    if ($image) {
                        echo responseJson('success', 'image uploaded', '');
                    } else {
                        echo responseJson('error', 'image not uploaded', '');
                    }
                }
            } else {
                echo responseJson('error', 'You must upload an image', '');
            }

        }

            $targetData = [
        'title' => $name,
        'dicription' => $details,
        'tags' => $tags,
        'stole_status' => $stock_status,
        'date' => $date,
        'price' => $price,
        'model' => $model_name
    ];
    if ($target_id){
        $model = new BaseModel('product');
        $addcat =  $model->radyForUpdate($targetData);

        $upcate = $addcat->update( 'id',$target_id);

        if ($upcate) {
            echo responseJson('success', 'User Update Sucessful', '');
            return;
        }
        echo responseJson('error', 'User Not found', '');
        return;
    }
    // Insert product data
    $productModel = new BaseModel('product');
    $productModel->readyForInsert($targetData);
    $productInfo = $productModel->save();
    $productcat = new BaseModel('catagory');
    $postData = $productModel->select('id')
        ->first();

    if($postData){
        $insertCat = $productcat->readyForInsert(['name'=>$cat,
            'cat_id'=>$postData->id
        ])
            ->save();
    }else{
        echo responseJson('error', 'Postdata not found', '');
    }

    // Insert images if product data was saved
//    if ($productInfo && !empty($uploaded_images)) {
//        foreach ($uploaded_images as $image) {
//            $imageModel = new BaseModel('images');
//            $imageModel->readyForInsert([
//                'product_id' => $productInfo->id,
//                'image_name' => $image,
//            ]);
//            $imageModel->save();
//        }


if($productInfo) {
        echo responseJson('success', 'Product Inserted Successfully', '');
    } else {
        echo responseJson('error', 'Post Not Inserted', '');
    }

    // Display errors if any
    foreach ($imageError as $error) {
        echo $error;
    }
}


//$productcat = new BaseModel('catagory');
//$catData =  $productcat->select('id`, name ,cat_id')->where('cat_id',$target_id)
//    ->first();

if (isset($_GET['productDel'])) {
    $productDel = $_GET['productDel'];
    $model = new BaseModel('product');
    $postData = $model->select('  `id`, `title`, `dicription`, `tags`, `stole_status`, `date`, `price`, `ratting`, `model`')
        ->where('id', $productDel)
        ->first();
    if ($postData) {
        $productImg = new BaseModel('images');
        $image = $productImg->select('`id`, `product_id`, `image_name`, `type`, `craeted_at`')->where('product_id', $postData->id)->first();

        if ($delete = $model->delete($productDel) && $imageDel = $productImg->delete($image)) {
            echo responseJson('success', 'Product Deleted', '');
        } else {
            echo responseJson('error', 'Product Not Deleted', '');
        }
    } else {
        echo responseJson('error', 'No Product found with this ID!', '');
    }
}



if (isset($_GET['get_edit_data'])) {
    $get_edit_data_id = $_GET['get_edit_data'];
    $model = new BaseModel('product');
    $postData = $model->select(' id as target_id, title as name , dicription as details, tags , stole_status as status, date, price as prise , ratting, model as model')->where('id', $get_edit_data_id)->first();
    if ($postData) {
        echo responseJson('success', 'Product Updated ', json_encode($postData));
    } else {
        echo responseJson('error', 'No Product found with this ID!', '');
    }
}


if (isset($_GET['datalist'])) {
    $keyword = isset($_GET['keyword']) && !empty($_GET['keyword']) ? $_GET['keyword'] : '';
    $model = new BaseModel('product');
    $postData = $model->select('`id`, `title`, `dicription`, `tags`, `stole_status`, `date`, `price`, `ratting`, `model`')
        ->where('title', "%$keyword%", 'like')
        ->orderBy('id', 'DESC')
        ->get();

    $pageData = '';
    if ($postData) {
        $productcat = new BaseModel('images');
        $i = 1;

        foreach ($postData as $post) {
            // পণ্যের জন্য সংশ্লিষ্ট ইমেজ তথ্য সংগ্রহ
            $image = $productcat->select('`id`, `product_id`, `image_name`, `type`, `craeted_at`')
                ->where('product_id', $post->id)
                ->first();

            $imageName = $image ?? '';

            $pageData .= "<tr>
                <td> $i</td>
                <td> $imageName </td>
                <td> $post->title </td>
                <td> $post->model</td>
                <td> $post->stole_status</td>
                <td> $post->price</td>
                <td> $post->date</td>
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




?>
