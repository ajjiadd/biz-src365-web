<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = ['name', 'description', 'investment_amount', 'max_members', 'joined_members', 'status', 'image'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('invested_amount', 'status')->withTimestamps();
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function profitDistributions()
    {
        return $this->hasMany(ProfitDistribution::class);
    }
}