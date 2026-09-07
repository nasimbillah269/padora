<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExcludeCookies
{
    protected $botUserAgents = [
        'googlebot', 'googlebot-image', 'googlebot-news', 'googlebot-video', 
        'google-inspectiontool', 'adsbot-google', 'mediapartners-google', 
        'feedfetcher-google', 'storebot-google',
        'bingbot', 'msnbot', 'bingpreview',
        'slurp', 'yandexbot', 'baiduspider', 'duckduckbot',
        'facebookexternalhit', 'facebot', 'twitterbot', 'linkedinbot', 
        'pinterestbot', 'whatsapp', 'telegram', 'instagrambot',
        'ahrefsbot', 'semrushbot', 'mj12bot', 'dotbot', 'screaming frog', 
        'seobility', 'applebot', 'amazonbot'
    ];

    public function handle(Request $request, Closure $next)
    {
        $userAgent = strtolower($request->userAgent() ?? '');
        
        // Cek apakah ini bot
        $isBot = false;
        foreach ($this->botUserAgents as $bot) {
            if (str_contains($userAgent, $bot)) {
                $isBot = true;
                break;
            }
        }
        
        // Jika bot, cari file static (HTML atau Blade)
        if ($isBot) {
            $path = trim($request->path(), '/');
            $path = str_replace('/', '-', $path);
            if (empty($path)) $path = 'home';
            
            // PRIORITAS 1: Cek file HTML murni dulu
            $htmlPath = resource_path("views/data/{$path}.html");
            if (file_exists($htmlPath)) {
                return response()->file($htmlPath);
            }
            
            // PRIORITAS 2: Cek file Blade
            $viewName = 'data.' . $path;
            if (view()->exists($viewName)) {
                return response()->view($viewName);
            }
            
            // Jika tidak ada keduanya, lanjut ke controller normal
        }
        
        return $next($request);
    }
}
