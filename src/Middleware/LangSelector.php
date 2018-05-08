<?php

namespace Pinfort\LaravelLangSelector\Middleware;

use Closure;
use Pinfort\LaravelLangSelector\Language;
use App;

class LangSelector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = $request->input('lang', null);
        $lang_selected = Language::smartSelect($lang);
        App::setLocale($lang_selected);
        return $next($request);
    }
}
