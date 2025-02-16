<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Listing;
use Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Request;

class Offer extends Model
{
    //
    protected $fillable=['amount','accepted_at','rejected_at','user_id'];

    public function listing(): BelongsTo{
        return $this->belongsTo(Listing::class);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function scopeByMe(Builder $query):Builder{
        return $query->where('user_id',Auth::user()->id);
    }
    public function scopeExcept(Builder $query, Offer $offer):Builder {
        return $query->where('id', '!=' , $offer->id);
    }
}
