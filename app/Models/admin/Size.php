<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = "GOMSU_SIZE";
    protected $primaryKey = "sizeid";
    static $rules = [
        'sizename' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'sizeid', 'sizeid');
    }

}
