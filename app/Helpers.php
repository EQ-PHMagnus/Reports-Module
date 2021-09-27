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