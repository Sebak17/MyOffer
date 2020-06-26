<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'status',
        'category_id',
        'price',
        'location',
        'title',
        'description',
    ];

    public function images()
    {
        return $this->hasMany('App\Models\OfferImage');
    }

    public function getCategory()
    {
        return \App\Models\Category::where('id', $this->category_id)->first();
    }

    public function getTextStatus()
    {
        switch ($this->status) {
            case 'INVISIBLE':
                return "Niewidoczna";
            case 'VISIBLE':
                return "Aktywna";
            case 'TO_DELETE':
                return "Usuwana";
            case 'BANNED':
                return "Zablokowana";
            case 'VERIFICATION':
                return "Weryfikowana";
            default:
                return "???";
        }

    }

    public function getTextPrice()
    {
        if($this->price > 0) {
            return number_format($this->price, 2, '.', ' ') . " zł";
        } else {
            return "Za darmo";
        }

    }


    public function generateURLName()
    {
        $t = preg_replace('/[^A-Za-z0-9 ]/', '', $this->title);

        $title = implode("-", array_slice(explode(' ', $t), 0, 5));

        return $title;;
    }
}
