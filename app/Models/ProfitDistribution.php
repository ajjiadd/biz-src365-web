<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfitDistribution extends Model
{
    protected $fillable = ['batch_id', 'total_profit', 'amount_per_user', 'distribution_date'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}