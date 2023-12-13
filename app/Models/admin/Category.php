<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "GomSu.Category";
    protected $primaryKey = "CATEGORYID";
    static $rules = [
        'CATEGORYNAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['CATEGORYNAME', 'PARENTID'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childcategories()
    {
        return $this->hasMany('App\Models\admin\Category', 'CATEGORYID', 'CATEGORYID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentcategory()
    {
        return $this->hasOne('App\Models\admin\Category', 'CATEGORYID', 'CATEGORYID');
    }
}
