<?php

namespace App\Http\Controllers\submission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    public function index()
    {
        return view('submissions.index');
    }
}
