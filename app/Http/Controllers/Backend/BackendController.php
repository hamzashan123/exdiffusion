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

    public function showPublishedReviewedImages()
    {
        return view('backend.publishedcreation.rev');
    }

    public function showPublishedUnReviewedImages()
    {
        return view('backend.publishedcreation.unrev');
    }
}
