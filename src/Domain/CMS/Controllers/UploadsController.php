<?php

namespace Domain\CMS\Controllers;

use Domain\CMS\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class UploadsController extends Controller
{
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

    public function delete(Request $request): Response
    {
        $request->validate([
            'path' => 'required',
        ]);

        $path = $request->get('path');

        if (File::exists(public_path($path))) {
            [$tmp, $file_folder, $file_info] = explode('/', trim($path, '/'));
            [$file_name, $file_extension] = explode('.', $file_info);

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
