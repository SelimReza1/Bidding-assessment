<?php

namespace App\Services;

use App\Models\MagicCode;

class MagicLinkGeneratorService
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function generate(): string
    {
        $magic_code = new MagicCode;

        $magic_code->email = $this->email;
        $magic_code->code = $this->generate_code();

        $magic_code->save();

        return $this->generate_link($magic_code->code);
    }

    private function generate_code(): string
    {
        return str()->random(16);
    }

    private function generate_link($code): string
    {
        return env('APP_URL') . "/verify_code/" . $code;
    }
}
