<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormatResponseJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if request is API or expects JSON, excluding search
        if (should_format_response_json($request)) {
            return $this->createJsonResponse($response);
        }

        return $response;
    }

    private function createJsonResponse($response)
    {
        $data = $this->getData($response);

        $etag = $response->headers->get('ETag'); // Ambil ETag jika ada

        $resData = [
            'req_id'    => Str::ulid(),
            'srv_id'    => env('APP_SRV',),
            'status'    => $response->isSuccessful(),
            'code'      => $response->status(),
            'content'   => $data['content'] ?? null,
            'errors'    => $data['errors'] ?? null,
            'from'      => $data['from'] ?? 'db',
            'message'   => $data['message'] ?? $response->statusText(),
        ];

        // Buat response JSON baru dan set ulang header ETag jika perlu
        $jsonResponse = response()->json($resData, $response->status());

        // Teruskan kembali header ETag
        if ($etag) {
            $jsonResponse->headers->set('ETag', $etag);
        }

        return $jsonResponse;
    }

    private function getData($response): mixed
    {
        $original = $response->original;
        return is_array($original) || is_object($original) ? $original : null;
    }
}
