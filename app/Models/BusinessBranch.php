<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessBranch extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'name',
    ];
    public function branchImages(){
        return $this->hasMany(BranchImages::class,'branch_id','id');
    }
}
