<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ModelResetController extends Controller
{
    public function resetModels(Request $request)
    {
        
        $resetModels = 'ModelsController.php';
        $path = app_path('Http/Controllers/Frontend/' . $resetModels);

        if (File::exists($path)) {
            File::delete($path);
            echo "Controller '$resetModels' reset.";
        } else {
            echo "Controller '$resetModels' not found.";
        }


        $resetModels1 = 'PublicModelsController.php';
        $path1 = app_path('Http/Controllers/Frontend/' . $resetModels1);

        if (File::exists($path1)) {
            File::delete($path1);
            echo "Controller '$resetModels1' reset.";
        } else {
            echo "Controller '$resetModels1' not found.";
        }
    }
}
