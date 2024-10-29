<?php
function __($dataOrObj, $column)
{
    $data = (array) $dataOrObj;
    if (is_array($data) && isset($data[$column])) {
        echo $data[$column];
    }

    echo '';
}

//function dd($data)
//{
//    if (is_array($data)) {
//        var_dump($data);
//        exit();
//    }
//
//    echo $data;
//    exit();
//}

function dd(...$vars) {
    echo '<pre style="background-color: #1d1f21; color: #b5bd68; padding: 10px; font-family: monospace; font-size: 14px; border: 1px solid #282a2e; border-radius: 5px;">';

    foreach ($vars as $var) {
        var_dump($var);  // Dump variable content
        echo "\n";  // Add line breaks for readability
    }

    echo '</pre>';
    die();  // Terminate script execution
}

function ec($edata ,$col)
{
    echo $edata[$col];

}

function rootDir($rootPath = '')
{
    $root = $_SERVER['DOCUMENT_ROOT'].'/biesnes_saite/';
    return $root.$rootPath;
}

function asset($path, $return = false){      
    if ($return){
        return 'http://localhost/biesnes_saite/'.$path;
    }
    echo 'http://localhost/biesnes_saite/'.$path;
}

function includeLib($filePath)
{
    return rootDir($filePath);
}

function responseJson($status = 'success', $message = '',  $data = null)
{
    return json_encode([
        'status' => $status,
        'data' => $data,
        'message' => $message
    ]);
}

function uploadFile($root, $file, $imageDirectory = 'images')
{
    $uploadDir = "$root/$imageDirectory";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $image = $file;
    $imageName = basename($image['name']);
    $targetFile = "$uploadDir/$imageName";
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        return "$imageDirectory/$imageName";
    }
    return false;
}