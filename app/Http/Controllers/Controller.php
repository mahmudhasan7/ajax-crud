<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function file_upload ($file,$folder){
       $product_file = $file;
       $file_extension = $product_file->getClientOriginalExtension();
       $product_image_name = time().rand().'.'.$file_extension;
       $product_file->move($folder,$product_image_name);

       return $product_image_name;
    }
}
