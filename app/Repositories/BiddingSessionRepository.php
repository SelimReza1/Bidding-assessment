<?php

namespace App\Repositories;

use App\Events\NewUserRequestedVerificationEvent;
use App\Models\Bidder;
use App\Models\MagicCode;
use App\Models\MagicLinkGenerator;
use App\Services\MagicLinkGeneratorService;
use App\Services\UserCodeService;

class BiddingSessionRepository
{
    private string $success_message = "Please check your email to start your bidding session!";

    /**
     * This function generates a magic link and sends email
     * to the user with the link
     * @param $email string
     * @return array
     * */
    public function sendMagicLink(string $email): array
    {
        $magic_link_generator = new MagicLinkGeneratorService($email);
        $link = $magic_link_generator->generate();

        try {
            NewUserRequestedVerificationEvent::dispatch($email, $link);
        } catch (\Throwable $th) {
            return [
                false,
                $th->getMessage(),
            ];
        }

        return [
            true,
            $this->success_message,
        ];
    }

    /**
     * This function verifies a code and returns information about verified user
     * @param $code string
     * @return $info array information about the verified user
     * */
    public function verifyCode(string $code): array
    {
        $is_new = false;
        $magic_code = MagicCode::where('code', $code)->firstOrFail();

        $bidder = Bidder::where('email', $magic_code->email)->first();

        if (!$bidder) {
            $is_new = true;
            $bidder = new Bidder;

            $bidder->email = $magic_code->email;
            $bidder->user_code = UserCodeService::getNewCode();

            $bidder->save();
        }

        $magic_code->delete();

        return [
            $is_new,
            $bidder,
        ];
    }
}
