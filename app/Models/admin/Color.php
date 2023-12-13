<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = "COLOR";
    protected $primaryKey = "COLORID";
    static $rules = [
        'COLORNAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'colorid', 'colorid');
    }

}
