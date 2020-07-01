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
        'loc_district',
        'loc_city',
        'title',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function images()
    {
        return $this->hasMany('App\Models\OfferImage');
    }

    public function getCategory()
    {
        return \App\Models\Category::where('id', $this->category_id)->first();
    }

    public function getFirstImageName() {
        if(count($this->images) == 0)
            return null;

        return $this->images->first()->name;
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

    public function getTextLocation()
    {
        $districts = [
            '1'  => "Dolnośląskie",
            '2'  => "Kujawsko-Pomorskie",
            '3'  => "Lubelskie",
            '4'  => "Lubuskie",
            '5'  => "Łódzkie",
            '6'  => "Małopolskie",
            '7'  => "Mazowieckie",
            '8'  => "Opolskie",
            '9'  => "Podkarpackie",
            '10' => "Podlaskie",
            '11' => "Pomorskie",
            '12' => "Śląskie",
            '13' => "Świętokrzyskie",
            '14' => "Warmińsko-Mazurskie",
            '15' => "Wielkopolskie",
            '16' => "Zachodniopomorskie"
        ];

        $loc_district = ( isset($districts[$this->loc_district]) ? $districts[$this->loc_district] : "?" );

        return $loc_district . ", " . $this->loc_city;
    }


    public function generateURLName()
    {
        $t = preg_replace('/[^A-Za-z0-9 ]/', '', $this->title);

        $title = implode("-", array_slice(explode(' ', $t), 0, 5));

        return $title;;
    }
}
