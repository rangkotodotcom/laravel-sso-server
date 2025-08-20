<?php

namespace App\Http\Controllers;

use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Laravel\Passport\Contracts\AuthorizationViewResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use League\OAuth2\Server\AuthorizationServer;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\Factory as AuthManager;
use Laravel\Passport\ClientRepository;

class CustomPassportAuthorizationController extends PassportAuthorizationController
{
    protected AuthorizationServer $server;
    protected StatefulGuard $guard;
    protected ClientRepository $clients;

    public function __construct(
        AuthorizationServer $server,
        AuthManager $auth,
        ClientRepository $clients
    ) {
        $this->server = $server;
        $this->guard = $auth->guard();
        $this->clients = $clients;
    }


    public function authorize(
        ServerRequestInterface $psrRequest,
        Request $request,
        ResponseInterface $psrResponse,
        AuthorizationViewResponse $viewResponse
    ): Response|AuthorizationViewResponse {
        $user = $request->user();
        $clientId = $request->input('client_id');

        if (!$this->userAllowedForClient($user, $clientId)) {
            abort(403, 'Anda tidak diizinkan login ke aplikasi ini.');
        }

        // lanjutkan proses authorize bawaan
        return parent::authorize($psrRequest, $request, $psrResponse, $viewResponse);
    }

    protected function userAllowedForClient($user, $clientId)
    {
        return true;
        // return \DB::table('client_user_allowed')
        //     ->where('user_id', $user->id)
        //     ->where('client_id', $clientId)
        //     ->exists();
    }
}
