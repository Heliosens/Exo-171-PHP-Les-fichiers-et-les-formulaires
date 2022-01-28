<?php

$error = [];

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
            move_uploaded_file($fileFrom, 'uploads/' . randomRename($fileTo));
        }
        else {
            // file type is not allowed
        }
    }
}


function randomRename ($fileName) {
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

