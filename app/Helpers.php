<?php

function flashMessage($message, $success = true){
    session()->flash('msg', $message);
    if($success === true){
        session()->flash('msgClass', 'success');
    }else{
        session()->flash('msgClass', 'danger');
    }
}

function moneyFormat($str,$places = 2){
    return '₱' . number_format($str,$places,".",",");
}

function getUploadedFile($file){
    $filePath       =   $file->path();
    $newFilePath    =   $filePath . '.' . $file->getClientOriginalExtension();
    move_uploaded_file($filePath, $newFilePath); // uploaded file will not move to any folder, it will only get the file
    return $newFilePath;
}