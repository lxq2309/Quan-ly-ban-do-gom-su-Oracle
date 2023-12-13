<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = "GOMSU_JOB";
    protected $primaryKey = "jobid";
    static $rules = [
        'jobtitle' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['jobtitle', 'salary'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('App\Models\admin\Employee', 'jobid', 'jobid');
    }
}
