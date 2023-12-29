<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class BackendController extends Controller
{
    public function index(): View
    {
        return view('backend.index');
    }

    public function showPublishedReviewedImages(){
        return view('Backend.publishedcreation.reviewed');
    }

    public function showPublishedUnReviewedImages(){
        return view('Backend.publishedcreation.unreviewed');
    }
}
