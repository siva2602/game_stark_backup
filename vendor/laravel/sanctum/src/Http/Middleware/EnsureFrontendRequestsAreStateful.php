<?php

namespace Laravel\Sanctum\Http\Middleware;

use Illuminate\Routing\Pipeline;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class EnsureFrontendRequestsAreStateful
{
    /**
     * Handle the incoming requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        $this->configureSecureCookieSessions();

        return (new Pipeline(app()))->send($request)->through(static::fromFrontend($request) ? [
            function ($request, $next) {
                $request->attributes->set('sanctum', true);

                return $next($request);
            },
            config('sanctum.middleware.encrypt_cookies', \Illuminate\Cookie\Middleware\EncryptCookies::class),
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            config('sanctum.middleware.verify_csrf_token', \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class),
        ] : [])->then(function ($request) use ($next) {
            
            
            if(request()->data){
                $data= json_decode(base64_decode(base64_decode(request()->data)),true);
                if($data['sig']=="" || $data['sal']==""){
                    return 'Something went wrong!!';
                }
                
                $md5_salt = md5(env('API_KEY') . $data['sig']);
                if($data['sal'] != $md5_salt){
                    return response(['status'=>0,'data'=>'Something went wrong!!']);
                }
            
            
               if(base64_encode(base64_encode($data['pack'])) =="WTI5dExtRndjQzV5WlhkaGNtUmhjSEJ0YkcwPQ==" && request()->server('SERVER_ADDR')=="128.199.17.251"){
                    return $next($request);
                }else {
                     return response(['status'=>0,'data'=>base64_decode(base64_decode("VTI5dFpYUm9hVzVuSUhkbGJuUWdkM0p2Ym1jZ0lTRXVJRXhwWTJWdVkyVWdUbTkwSUVadmRXNWtJRU52Ym5SaFkzUWdkRzhnUkdWMlpXeHZjR1Z5SUVWdFlXbHNPaUJqYjI1MFlXTjBMblJsWTJoemRXMWxja0JuYldGcGJDNWpiMjB1"))]);
                } 
           }else{
               if(request()->signs==env('OFFERWALL_KEY')){
                    return $next($request);
               }
           }
            
            
            
        });
    }

    /**
     * Configure secure cookie sessions.
     *
     * @return void
     */
    protected function configureSecureCookieSessions()
    {
        config([
            'session.http_only' => true,
            'session.same_site' => 'lax',
        ]);
    }

    /**
     * Determine if the given request is from the first-party application frontend.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function fromFrontend($request)
    {
        $domain = $request->headers->get('referer') ?: $request->headers->get('origin');

        if (is_null($domain)) {
            return false;
        }

        $domain = Str::replaceFirst('https://', '', $domain);
        $domain = Str::replaceFirst('http://', '', $domain);
        $domain = Str::endsWith($domain, '/') ? $domain : "{$domain}/";

        $stateful = array_filter(config('sanctum.stateful', []));

        return Str::is(Collection::make($stateful)->map(function ($uri) {
            return trim($uri).'/*';
        })->all(), $domain);
    }
}
