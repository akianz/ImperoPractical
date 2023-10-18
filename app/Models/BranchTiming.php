<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTiming extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'week_day',
        'start_time',
        'end_time',
        'opening_status'
    ];

    public function getBranch(){
        return $this->hasOne(BusinessBranch::class,'id','branch_id');
    }
}
