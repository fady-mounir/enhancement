<?php

namespace App\Http\Middleware;

use App\Helpers\MessageHandleHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    private $messageHandler;

    public function __construct()
    {
        $this->messageHandler = new MessageHandleHelper();
    }

    public function handle(Request $request, Closure $next): Response
    {

        $apiKey = $request->header('api-key');

        if ($apiKey !== env('API_KEY')) {
            return $this->messageHandler->getJsonBadRequestErrorResponse('Api Key Is Missed Or In Correct');
        }

        return $next($request);
    }
}
