<?php

use Illuminate\Support\Str;
use Illuminate\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Middleware\HandleCatchOAuthMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\FormatResponseJsonMiddleware;
use App\Http\Middleware\LogRequestResponseApiMiddleware;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        if (env('APP_ENV') == 'production' || env('APP_ENV') == 'staging') {
            $middleware->throttleWithRedis();
            $middleware->throttleApi('api', true);
        } else {
            $middleware->throttleApi('api');
        }

        $middleware->appendToGroup('api', [
            FormatResponseJsonMiddleware::class,
            LogRequestResponseApiMiddleware::class,
        ]);

        $middleware->appendToGroup('web', [
            HandleCatchOAuthMiddleware::class,
        ]);

        $middleware->alias([
            'format.api'    => FormatResponseJsonMiddleware::class,
            'log.api'       => LogRequestResponseApiMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (\Exception $e, $request) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                if (should_return_json($request)) {
                    return response()->json([
                        'req_id'    => Str::ulid(),
                        'srv_id'    => env('APP_SRV'),
                        'code'      => 401,
                        'status'    => false,
                        'content'   => null,
                        'errors'    => null,
                        'message'   => 'Unauthorized',
                    ], 401);
                } else {
                    return redirect()->route('login');
                }
            }

            if ($e->getPrevious() instanceof PDOException) {
                if (should_return_json($request)) {
                    return response()->json([
                        'req_id'    => Str::ulid(),
                        'srv_id'    => env('APP_SRV'),
                        'code'      => 500,
                        'status'    => false,
                        'content'   => null,
                        'errors'    => null,
                        'message'   => !env('APP_DEBUG') ? 'Internal Server Error' : $e->getMessage(),
                    ], 500);
                }
            }

            if ($e->getPrevious() instanceof QueryException) {
                if (should_return_json($request)) {
                    return response()->json([
                        'req_id'    => Str::ulid(),
                        'srv_id'    => env('APP_SRV'),
                        'code'      => 500,
                        'status'    => false,
                        'content'   => null,
                        'errors'    => null,
                        'message'   => !env('APP_DEBUG') ? 'Internal Server Error' : $e->getMessage(),
                    ], 500);
                }
            }
        });

        $exceptions->reportable(function (OAuthServerException $e) {
            if ($e->getCode() == 9) {
                return false;
            }
        });

        $exceptions->renderable(function (HttpException $e, $request) {
            if (should_return_json($request)) {
                if ($e->getStatusCode() == 503) {
                    return response()->json([
                        'req_id'    => Str::ulid(),
                        'srv_id'    => env('APP_SRV'),
                        'code'      => 503,
                        'status'    => false,
                        'content'   => null,
                        'errors'    => null,
                        'message'   => 'Under Maintenance',
                    ], 503);
                }
            }
        });

        $exceptions->renderable(function (TooManyRequestsHttpException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 429,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => 'Too Many Requests',
                ], 429);
            }
        });

        $exceptions->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 405,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => 'Method Not Allowed',
                ], 405);
            }
        });

        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 404,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => 'Endpoint Not Found.',
                ], 404);
            }
        });

        $exceptions->renderable(function (RouteNotFoundException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 404,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => 'Route Not Found.',
                ], 404);
            }
        });

        $exceptions->renderable(function (AuthenticationException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 401,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => 'Unauthentication',
                ], 401);
            }
        });

        $exceptions->renderable(function (AuthorizationException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 403,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => 'Unauthorized',
                ], 403);
            }
        });

        $exceptions->renderable(function (UnprocessableEntityHttpException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 422,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => $e->getMessage() ?? 'The given data was invalid.',
                ], 422);
            }
        });

        $exceptions->renderable(function (ValidationException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'errors'    => collect($e->errors())->map(fn($messages) => $messages[0]),
                    'message'   => $e->validator->errors()->first() ?? 'The given data was invalid.',
                ], 422);
            }
        });

        $exceptions->renderable(function (\PDOException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 500,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => !env('APP_DEBUG') ? 'Internal Server Error' : $e->getMessage(),
                ], 500);
            }
        });

        $exceptions->renderable(function (QueryException $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 500,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => null,
                    'message'   => !env('APP_DEBUG') ? 'Internal Server Error' : $e->getMessage(),
                ], 500);
            }
        });

        $exceptions->renderable(function (\Throwable $e, $request) {
            if (should_return_json($request)) {
                return response()->json([
                    'req_id'    => Str::ulid(),
                    'srv_id'    => env('APP_SRV'),
                    'code'      => 500,
                    'status'    => false,
                    'content'   => null,
                    'errors'    => $e->getMessage(),
                    'message'   => !env('APP_DEBUG') ? 'Internal Server Error' : $e->getMessage(),
                ], 500);
            }
        });
    })->create();
