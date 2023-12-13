<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "COUNTRY";
    protected $primaryKey = "COUNTRYID";
    static $rules = [
        'COUNTRYNAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'countryid', 'countryid');
    }

}
