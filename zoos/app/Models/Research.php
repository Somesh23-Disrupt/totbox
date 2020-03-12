<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'research_masters_id', 'book_code', 'research_status'];

    public function ResearchMaster()
    {
        return $this->belongsTo(ResearchMaster::class, 'id');
    }

    public function ResearchStatus()
    {
        return $this->belongsTo(ResearchStatus::class, 'id');
    }

    public function libBookIssue()
    {
        return $this->hasMany(ResearchIssue::class, 'book_id');
    }
}
