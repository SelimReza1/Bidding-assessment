<?php

namespace App\Http\Controllers\User;

use App\Exceptions\BidDeadlineReachedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PlaceBidFormRequest;
use App\Models\Bid;
use App\Models\Product;
use App\Repositories\UserProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function show(Product $product): View
    {
        $bids = Bid::with('bidder')->where('product_id', $product->id)
            ->orderBy('price', 'desc')
            ->get();

        return view("pages.user.products.show", compact('product', 'bids'));
    }

    public function placeBid(
        Product $product,
        PlaceBidFormRequest $request,
        UserProductRepository $repo,
    ): RedirectResponse {
        try {
            $bid_status = $repo->placeBid($product, $request->price);
        } catch (BidDeadlineReachedException $e) {
            return back()->with('error', $e->getMessage());
        }

        if ($bid_status) {
            return back()->with('success', "You have successfully placed a bid with price: $" . $request->price);
        }
        return back()->with('error', "Please place a higher bid than minimum bidding price or last bid!");
    }
}
