<?php

namespace Domain\CMS\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

/**
 * @property string $original_name
 * @property string $file_folder
 * @property string $file_name
 * @property string $file_extension
 * @property string $file_mime
 * @property integer $file_size
 * @property string $file_path
 * @property string $file_url
 */
class Upload extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::deleted(function (Upload $upload) {
            $realpath = public_path($upload->file_path);

            if (File::exists($realpath)) {
                File::delete($realpath);
            }
        });
    }

    /**
     * @return string
     */
    public function getFilePathAttribute(): string
    {
        return "/storage/{$this->file_folder}/{$this->file_name}.{$this->file_extension}";
    }

    /**
     * @return string
     */
    public function getFileUrlAttribute(): string
    {
        return url($this->file_path);
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $uploadPath
     * @return \Domain\CMS\Models\Upload
     */
    public static function fromRequestFile(UploadedFile $file, string $uploadPath): Upload
    {
        $generatedName = date('Ymd-Hi').'_'.uniqid();

        $file->storeAs($uploadPath, "{$generatedName}.{$file->getClientOriginalExtension()}", 'public');

        $upload = new Upload;
        $upload->original_name = $file->getClientOriginalName();
        $upload->file_extension = $file->getClientOriginalExtension();
        $upload->file_size = round($file->getSize() / 1000);
        $upload->file_mime = $file->getClientMimeType();
        $upload->file_folder = $uploadPath;
        $upload->file_name = $generatedName;
        $upload->save();

        return $upload;
    }
}
