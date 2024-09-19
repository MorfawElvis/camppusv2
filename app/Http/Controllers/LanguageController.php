<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        $request->session()->put('language', $request->input('language'));
        return redirect()->back();
    }
}
