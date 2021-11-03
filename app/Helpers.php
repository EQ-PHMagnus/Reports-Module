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

function exportFiles($exportQuery,$exportFileName){

    $header_style = (new Box\Spout\Writer\Common\Creator\Style\StyleBuilder())
                    ->setFontBold()
                    ->build();
    $rows_style = (new Box\Spout\Writer\Common\Creator\Style\StyleBuilder())
                ->setShouldWrapText(false)
                ->build();      

    // Export consumes only a few MB, even with 10M+ rows.
    return (new Rap2hpoutre\FastExcel\FastExcel($exportQuery))
        ->headerStyle($header_style)
        ->rowsStyle($rows_style)
        ->download(Carbon\Carbon::now()->toDateString() . $exportFileName);
    
}

function can($permissions = [], $all = false) {
	$function_name = $all ? 'hasAllPermissions' : 'hasAnyPermission';
	return auth()->user()->{$function_name}($permissions);
}