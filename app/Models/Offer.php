<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Listing;

class Offer extends Model
{
    //
    protected $fillable=['amount','accepted_at','rejected_at'];

    public function listing(): BelongsTo{
        return $this->belongsTo(Listing::class);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
