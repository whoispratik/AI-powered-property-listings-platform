<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    //
   use HasFactory;
   use SoftDeletes;
   protected $fillable = ['beds','baths','area','city','price','unit','parking','facing','road_access'];
   protected $sortable=['price','created_at'];
   public function user()
   {
       return $this->belongsTo(User::class);
   }
   public function images()
   {
       return $this->hasMany(ListingImage::class);
   }
   public function offers(){
     return $this->hasMany(Offer::class);
   }
   public function scopeMostRecent(Builder $query):Builder{
         return $query->orderByDesc('created_at');
   }
   public function scopeNotSold(Builder $query): Builder{
    return $query->whereNull('sold_at'); 
   }
   public function scopeFilter(Builder $query, array $filters):Builder{
         return $query
         ->when(isset($filters['priceFrom']),fn ($query)=>$query->where('price','>=',$filters['priceFrom']))
         ->when(isset($filters['priceTo']),fn ($query)=>$query->where('price','<=',$filters['priceTo']))
         ->when(isset($filters['beds']),fn ($query)=>$query->where('beds',(int)$filters['beds'] < 6 ? '=' : '>=',$filters['beds']))
         ->when(isset($filters['baths']),fn ($query)=>$query->where('baths',(int)$filters['baths'] < 6 ? '=' : '>=',$filters['baths']))
         ->when(isset($filters['areaFrom']),fn ($query)=>$query->where('area','>=',$filters['areaFrom']))
         ->when(isset($filters['areaTo']),fn ($query)=>$query->where('area','<=',$filters['areaTo']))
         ->when(isset($filters['deleted']),fn($query)=>$query->onlyTrashed())
         ->when(isset($filters['by']),fn($query)=>in_array($filters['by'],$this->sortable)?$query->orderBy($filters['by'],$filters['order']??'desc'):$query,fn($query)=>$query->orderBy('created_at','desc') );
   }
}
