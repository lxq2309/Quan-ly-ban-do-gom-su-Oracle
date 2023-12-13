<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  protected $table = "GomSu.Job";
  protected $primaryKey = "JOBID";
  static $rules = [
    'JOBTITLE' => 'required',
  ];

  protected $perPage = 20;

  public $timestamps = false;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['JOBTITLE', 'SALARY'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function employees()
  {
    return $this->hasMany('App\Models\admin\Employee', 'JOBID', 'JOBID');
  }
}
