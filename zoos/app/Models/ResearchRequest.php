<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchRequest extends Model
{
    protected $fillable = ['created_by', 'last_updated_by', 'research_masters_id', 'member_id', 'status'];

    public function bookMaster()
    {
        return $this->belongsTo(ResearchMaster::class, 'id','research_masters_id');
    }
}
