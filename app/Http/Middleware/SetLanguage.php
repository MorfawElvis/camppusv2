<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\Exceptions\TranslationRequestException;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    public function handle($request, Closure $next)
    {
        if (session()->has('language')) {
            app()->setLocale(session('language'));
        }

        return $next($request);
    }
}

