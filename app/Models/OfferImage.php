<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    protected $table = 'offers_images';

	public $timestamps = false;

	protected $fillable = [
        'user_id', 'offer_id', 'name'
    ];

	public function offer()
    {
        return $this->belongsTo('App\Models\Offer');
    }
}
