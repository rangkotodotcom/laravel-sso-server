<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCatchOAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();
        $method = $request->getMethod();

        $response = $next($request);

        if ($path == 'oauth/authorize' && $method == 'GET' && $response->getStatusCode() >= 400) {

            if ($response->getStatusCode() === 403) {
                return $response;
            }

            try {
                $error = json_decode($response->getContent(), true);

                return response()->view('errors.oauth3', compact('error'));
            } catch (\Throwable $th) {
                $error = [
                    'error' => 'unsupported_grant_type',
                    'error_description' => 'The authorization grant type is not supported by the authorization server.',
                    'hint' => 'Check that all required parameters have been provided'
                ];

                return response()->view('errors.oauth3', compact('error'));
            }
            // if ($response instanceof \Illuminate\Http\RedirectResponse) {
            //     return $response;
            // }

            // if ($response instanceof \Illuminate\Http\Response) {
            //     return $response;
            // }


            // if ($response instanceof \Symfony\Component\HttpFoundation\Response) {
            //     $statusCode = $response->getStatusCode();

            //     if ($statusCode >= 400) {

            //     }
            // }
        }

        return $response;
    }
}
