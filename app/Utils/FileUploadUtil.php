<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;

class FileUploadUtil{

    public static function uploadUserPhoto($request, $user, &$data){
        if ($request->hasFile('file')) {
            if (isset($user->image)) {
                $existingFilePath = Storage::disk('public')->exists($user->image);
                if ($existingFilePath)
                    Storage::disk('public')->delete($user->image);
            }
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $fileExtension;
            $filePath = $file->storeAs('photo', $fileName, 'public');
            $data['image'] = $filePath;
        }
    }

    public static function uploadClienteCompra($request, $compra, &$data){
        if ($request->hasFile('file_compra')) {
            if (isset($compra->file)) {
                $existingFilePath = Storage::disk('public')->exists($compra->file);
                if ($existingFilePath)
                    Storage::disk('public')->delete($compra->file);
            }
            $file = $request->file('file_compra');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $fileExtension;
            $filePath = $file->storeAs('comprovativo', $fileName, 'public');
            $data['file'] = $filePath;     
        }
    }

}
