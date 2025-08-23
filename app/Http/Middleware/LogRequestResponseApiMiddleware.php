<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestResponseApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->start = microtime(true);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $request->end = microtime(true);

        $this->log($request, $response);
    }

    protected function log($request, $response)
    {
        if (should_format_response_json($request)) {
            return $this->storeLog($request, $response);
        }
    }

    private function storeLog($request, $response)
    {
        try {
            $duration = $request->end - $request->start;
            $url = $request->fullUrl();
            $method = $request->getMethod();
            $ip = $request->getClientIp();
            $created_by = Auth::user()->email ?? 'system';
            $dataRequest = $request->all();

            // Mask sensitive information like password and pin
            $this->maskSensitiveData($dataRequest);

            $dataResponse = json_decode($response->getContent(), true);
            $reqId = $dataResponse['req_id'];

            if ($request->is('api/public*')) {
                $channel = 'client';
            } elseif ($request->is('api/*')) {
                $channel = 'api';
            } else {
                $channel = 'web';
            }


            $log = "{$reqId}|{$ip}|{$method}|{$url}|{$duration}|{$response->status()}|{$created_by}|";

            $logChannel = Log::channel($channel);
            $logChannel->info($log, [
                'request'   => $dataRequest,
                'response'  => $dataResponse,
            ]);
        } catch (\Throwable $th) {
            $logChannel = Log::channel('error');
            $logChannel->error('[Middleware]LogRequestResponseApi', ['error' => $th->getMessage()]);
        }
    }

    private function maskSensitiveData(&$dataRequest)
    {
        $sensitiveFields = [
            'password',
            'current_password',
            'new_password',
            'new_password_confirmation',
            'pin',
            'current_pin',
            'new_pin',
            'new_pin_confirmation'
        ];

        foreach ($sensitiveFields as $field) {
            if (isset($dataRequest[$field])) {
                $dataRequest[$field] = '********';  // Mask the sensitive data
            }
        }
    }
}
