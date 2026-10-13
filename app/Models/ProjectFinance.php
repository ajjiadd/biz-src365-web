<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFinance extends Model
{
    protected $fillable = ['project_id', 'type', 'amount', 'description', 'entry_date'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}