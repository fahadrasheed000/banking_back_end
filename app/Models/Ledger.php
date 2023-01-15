<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'account_id', 'deponsit_id', 'transfer_id', 'debit', 'credit'];
}
