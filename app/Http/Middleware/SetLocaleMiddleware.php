<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $languageCode = $this->detectLanguage();
        
        // Specify the path to the language JSON files
        $localesPath = base_path('app/locales');
        $languageFilePath = "{$localesPath}/{$languageCode}.json";
        // dd($languageCode);
        if (file_exists($languageFilePath)) {
            $data = json_decode(file_get_contents($languageFilePath), true);
        } else {
            // Fallback to English if the language file does not exist
            $englishFilePath = "{$localesPath}/en.json";
            $data = json_decode(file_get_contents($englishFilePath), true);
            $languageCode = 'en';
            
        }

        // Inject data into Inertia
        inertia()->share('localeData', [
            'data' => $data,
            'languageCode' => $languageCode,
        ]);

        return $next($request);
    }


    private function detectLanguage(){
        // app()->setLocale('fr');
        
        return Session::get('locale');
    }
}
