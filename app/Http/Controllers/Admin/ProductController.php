<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateFormRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function create(): View
    {
        return view('pages.admin.products.create');
    }

    public function store(ProductCreateFormRequest $request): RedirectResponse
    {
        try {
            $request->save();

            return redirect()->route('admin.home');
        } catch (\Throwable $th) {
            return $this->getErrorRedirect('admin.products.create');
        }
    }
}
