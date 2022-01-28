<?php

//$error = [];

$mimeTypes = ['image/jpg', 'image/jpeg', 'image/png'];

// check if uploads exist or create it
if (!is_dir('uploads')) {
    mkdir('uploads', '0755');
}

if(isset($_FILES['userFile'])){
    if($_FILES['userFile']['error'] === 0){
        $fileFrom = $_FILES['userFile']['tmp_name'];
        $fileTo = $_FILES['userFile']['name'];
        if(in_array($_FILES['userFile']['type'], $mimeTypes)){
            if($_FILES['userFile']['size'] <= 3 * 1024 * 1024){
                // place in uploads directory
                $newName = randomRename($fileTo);
                move_uploaded_file($fileFrom, 'uploads/' . $newName);
                addFileName('file.json', $newName);
                //  redirect
                header('Location: /index?error=4');
                exit();
            }
            else{
                // file size > 3Mo
                header('Location: /index?error=3');
                exit();
            }
        }
        else {
            // file type is not allowed
            header('Location: /index?error=2');
            exit();
        }
    }
    else {  // load error
        header('Location: /index?error=1');
        exit();
    }
}
else {      // file exist ?
    header('Location: /index?error=0');
    exit();
}

/**
 * @param $file
 * @param $nextName
 */
function addFileName ($file, $nextName){
    if(file_exists($file)){
        $data = json_decode(file_get_contents($file));
        $data[] = $nextName;
    }
    else {
        $data = [$nextName];
    }
    file_put_contents('file.json', json_encode($data));
}

/**
 * create new name with random string
 * @param $fileName
 * @return string
 */
function randomRename (string $fileName) : string {
    // get extension
    $ext = pathinfo($fileName);
    // create random string
    try {
        $value = random_bytes(15);
    } catch (Exception $e) {
        $value = openssl_random_pseudo_bytes(15);
    }
    // convert to hexadecimal
    return bin2hex($value) . '.' . $ext['extension'];
}

