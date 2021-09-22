<?php

function flashMessage($message, $success = true){
    session()->flash('msg', $message);
    if($success === true){
        session()->flash('msgClass', 'success');
    }else{
        session()->flash('msgClass', 'danger');
    }
}

function moneyFormat($str){
    return '₱' . number_format($str,2,".",",");
}