<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = "SIZE";
    protected $primaryKey = "SIZEID";
    static $rules = [
        'SIZENAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'SIZEID', 'SIZEID');
    }

}
