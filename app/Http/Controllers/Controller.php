<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function uploadMaxFilesize()
    {
        $uploadMaxFilesize = ini_get('upload_max_filesize');
        $size = (int) $uploadMaxFilesize;
        if (strripos($uploadMaxFilesize, 'K')) {
            $uploadMaxFilesize = str_replace('K', 'Kb', $uploadMaxFilesize);
            $size = (int) str_replace('K', '', $uploadMaxFilesize) * 1024;
        } elseif (strripos($uploadMaxFilesize, 'M')) {
            $uploadMaxFilesize = str_replace('M', 'Mb', $uploadMaxFilesize);
            $size = (int) str_replace('M', '', $uploadMaxFilesize) * 1048576;
        } elseif (strripos($uploadMaxFilesize, 'G')) {
            $uploadMaxFilesize = str_replace('G', 'Gb', $uploadMaxFilesize);
            $size = (int) str_replace('G','',$upload_max_filesize) * (int) '1073741824‬';
        }
        return [
            'sizeText' => $uploadMaxFilesize,
            'sizeInt' => $size
        ];
    }
}
