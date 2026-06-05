<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftLogController extends Controller
{
    public function index()
    {
        return view('livewire.shift-logs.index');
    }
}
