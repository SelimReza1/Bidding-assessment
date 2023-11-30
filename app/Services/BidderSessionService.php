<?php

namespace App\Services;

use App\Models\Bidder;

class BidderSessionService
{
    public function createSession(Bidder $bidder): void
    {
        $new_auth_token = $this->getNewAuthToken();

        $bidder->update([
            'auth_token' => $new_auth_token,
        ]);

        session()->forget('bidder');

        session()->put('bidder', [
            'token' => $new_auth_token,
        ]);
    }

    public static function getBidder(): ?Bidder
    {
        if (
            session()->has('bidder') &&
            isset(session()->get('bidder')['token']) &&
            Bidder::where('auth_token', session()->get('bidder')['token'])
            ->count() === 1
        ) {
            return Bidder::where('auth_token', session()->get('bidder')['token'])->first();
        }
        return false;
    }

    private function getNewAuthToken(): string
    {
        return str()->random(32);
    }
}
