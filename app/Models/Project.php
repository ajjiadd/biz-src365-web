<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['batch_id', 'name', 'description', 'total_fund', 'status'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function finances()
    {
        return $this->hasMany(ProjectFinance::class);
    }

    // লাভ/লসের রিয়েল-টাইম হিসাবের জন্য একটি মেথড
    public function getNetProfitAttribute()
    {
        $income = $this->finances()->where('type', 'income')->sum('amount');
        $expense = $this->finances()->where('type', 'expense')->sum('amount');
        return $income - $expense;
    }
}