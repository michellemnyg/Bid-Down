<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[Fillable([
    'client_id',
    'title',
    'category',
    'description',
    'max_price',
    'bid_deadline',
    'blind_review',
    'auto_stop',
    'status',
    'winner_bid_id',
])]
class Project extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'bid_deadline' => 'datetime',
            'blind_review' => 'boolean',
            'auto_stop' => 'boolean',
            'max_price' => 'integer',
        ];
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function lowestBid()
    {
        return $this->hasOne(Bid::class)->orderBy('amount');
    }

    public function winnerBid()
    {
        return $this->belongsTo(Bid::class, 'winner_bid_id');
    }

    public function isOpen(): bool
    {
        if ($this->status !== 'open') {
            return false;
        }

        return $this->bid_deadline === null || $this->bid_deadline->isFuture();
    }

    protected function budgetMax(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->max_price,
        );
    }

    protected function deadline(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->bid_deadline,
        );
    }
}
