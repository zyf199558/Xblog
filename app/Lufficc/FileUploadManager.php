<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/9/17
 * Time: 17:10
 */

namespace Lufficc;

use Storage;

class FileUploadManager
{
    private $disk;

    /**
     * FileUploadManager constructor.
     * @param $disk
     */
    public function __construct($disk)
    {
        $this->disk = Storage::disk('qiniu');
    }

    public function uploadFile($key, $filePath)
    {
        if ($this->disk->put($key, file_get_contents($filePath))) {
            return true;
        } else {
            return false;
        }
    }

    public function url($key)
    {
        return $this->disk->url($key);
    }

    public function deleteFile($key)
    {
        if ($this->disk->delete($key)) {
            return true;
        } else {
            return false;
        }
    }
}