<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublishCreationController extends Controller
{
    public function publishCreation(){
        return view('frontend.exdiffusion.publishedCreation');
    }
}
