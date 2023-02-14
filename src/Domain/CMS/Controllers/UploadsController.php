<?php

namespace Domain\CMS\Controllers;

use Domain\CMS\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class UploadsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => 'required|file',
            'path' => 'nullable',
        ]);

        $upload = Upload::fromRequestFile($request->file('upload'), $request->get('path', 'attachments'));

        return response()->json([
            'url' => optional($upload)->file_path,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request): Response
    {
        $request->validate([
            'path' => 'required',
        ]);

        $path = $request->get('path');

        if (File::exists(public_path($path))) {
            list($tmp, $file_folder, $file_info) = explode('/', trim($path, '/'));
            list($file_name, $file_extension) = explode('.', $file_info);

            $upload = Upload::query()
                ->where('file_folder', $file_folder)
                ->where('file_name', $file_name)
                ->where('file_extension', $file_extension)
                ->first();

            optional($upload)->delete();
        }

        return response()->noContent();
    }
}
