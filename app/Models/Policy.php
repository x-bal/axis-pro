<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id');
    }
}
