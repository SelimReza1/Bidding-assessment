<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginFormRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminLoginController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.login');
    }

    public function login(LoginFormRequest $request): RedirectResponse
    {
        if ($request->login()) {
            return redirect()->route('admin.home');
        }
        return redirect()->back()
            ->with('error', "The credentials did not match out records!");
    }
}
