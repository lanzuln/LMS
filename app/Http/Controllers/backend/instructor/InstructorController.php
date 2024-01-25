<?php

namespace App\Http\Controllers\backend\instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        return view('backend.instructor.dashboard');
    }
}
