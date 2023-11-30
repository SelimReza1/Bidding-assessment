<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'minimum_bidding_price',
        'deadline',
        'status',
    ];

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function notificationSents(): HasOne
    {
        return $this->hasOne(BiddingNotificationSent::class, 'product_id', 'id');
    }

    public function isExpired(): bool
    {
        $now = Carbon::now();
        $deadline = Carbon::parse($this->deadline);

        if ($deadline->lessThan($now)) {
            return true;
        }
        return false;
    }

    public function highestBid(): ?Bid
    {
        return $this->bids()->orderBy('price', 'desc')
            ->first();
    }

    public function otherParticipants(): Collection
    {
        if ($this->highestBid()) {
            $bidder_ids = $this->bids()->whereNot('bidder_id', $this->highestBid()->bidder_id)
                ->get()
                ->pluck('bidder_id')
                ->unique();

            return Bidder::whereIn("id", $bidder_ids)->get();
        }
        return [];
    }
}
