<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Glaze extends Model
{
    protected $table = "GLAZE";
    protected $primaryKey = "GLAZEID";
    static $rules = [
        'GLAZENAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'GLAZEID', 'GLAZEID');
    }

}
