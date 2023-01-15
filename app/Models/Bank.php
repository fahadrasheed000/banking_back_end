<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'branch_code'];
    /**
     * @return object
     */
    function getAllBanksData(): object
    {
        return Bank::select("id", "name", "branch_code")->orderBy("id", "DESC")->get();
    }
}
