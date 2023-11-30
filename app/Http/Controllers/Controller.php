<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getErrorRedirect(string $route, string $message = "", array $route_params = []): View
    {
        $message = $message ? $message : "Sorry, something went wrong. Please contact support or try again!";

        return redirect()->route($route, $route_params)
            ->with('error', $message);
    }
}
