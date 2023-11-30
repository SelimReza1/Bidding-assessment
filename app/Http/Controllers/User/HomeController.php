<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\BidderSessionService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->get();
        $user_code = BidderSessionService::getBidder()->user_code;

        return view('pages.user.index', compact('products', 'user_code'));
    }
}
