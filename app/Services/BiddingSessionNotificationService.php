<?php

namespace App\Services;

use App\Mail\ThankYouMessageNotificationMail;
use App\Mail\WinnerNotificationMail;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class BiddingSessionNotificationService
{
    public function check(): void
    {
        $done_products = Product::with('notificationSents')->where('status', 'done')->get();

        foreach ($done_products as $product) {
            if (
                $product->notificationSents()->count() === 0 &&
                $product->bids()->count() !== 0
            ) {
                $product->notificationSents()->create([
                    'sent' => 1,
                ]);

                $this->sendWinnerNotification($product);
                $this->sendThankYouNotification($product);
            }
        }
    }

    private function sendWinnerNotification(Product $product): void
    {
        $highest_bid = $product->highestBid();

        Mail::to($highest_bid->bidder->email)
            ->send(new WinnerNotificationMail($highest_bid));
    }

    private function sendThankYouNotification(Product $product): void
    {
        $participants = $product->otherParticipants();

        foreach ($participants as $participant) {
            Mail::to($participant->email)
                ->send(
                    new ThankYouMessageNotificationMail($participant)
                );
        }
    }
}
