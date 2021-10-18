<?php
namespace App\Traits;

trait MetaData {
 public function with($request){
     return [
        'metadata' => [
            'version' => env('APP_VERSION','No version available'),
            'author'  => "support@phmagnus.com",
            'links'   => "Not available."
        ],
    ];
 }
}
