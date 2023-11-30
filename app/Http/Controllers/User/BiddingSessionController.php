<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BiddingSessionFormRequest;
use App\Repositories\BiddingSessionRepository;
use App\Services\BidderSessionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BiddingSessionController extends Controller
{
    public function index(): View
    {
        return view('pages.user.bidding_session.index');
    }

    public function sendMagicLink(
        BiddingSessionFormRequest $request,
        BiddingSessionRepository $repo,
    ): RedirectResponse {
        list($status, $message) = $repo->sendMagicLink($request->email);

        $key = $status ? "success" : "error";

        return redirect()->back()
            ->with($key, $message);
    }

    public function verifyCode(BiddingSessionRepository $repo, BidderSessionService $sessionService, string $code): RedirectResponse
    {
        try {
            list($is_new, $bidder) = $repo->verifyCode($code);
        } catch (\Throwable $_) {
            return redirect()->route('user.bidding_session.index')
                ->with('error', "Verification failed! Please try again.");
        }

        $sessionService->createSession($bidder);

        return redirect()->route('user.home')
            ->with('bidder_is_new', $is_new);
    }
}
