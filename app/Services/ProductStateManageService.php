<?php

namespace App\Services;

use App\Models\Product;

class ProductStateManageService
{
    public function check(): void
    {
        $ongoing_products = Product::where('status', 'ongoing')
            ->get();

        foreach ($ongoing_products as $product) {
            if ($product->isExpired()) {
                $product->update([
                    'status' => "done",
                ]);
            }
        }
    }
}
