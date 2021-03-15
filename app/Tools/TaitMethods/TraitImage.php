<?php

namespace App\Tools\TaitMethods;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait TraitImage
{
    public function SaveProductDocument(Request $request, &$fileName)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = $fileName . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $fileName = 'product/' . $fileName;                
                $img->resize(500, 250);
                $img->stream();
                $this->SaveImages($fileName, $img);
            }
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    private function SaveImages($newfilename, $image)
    {
        Storage::disk('public')->put($newfilename, $image);
    }
}
