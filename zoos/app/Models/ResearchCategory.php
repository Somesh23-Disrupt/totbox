<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchCategory extends BaseModel
{
    protected $table = 'research_categories';
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'status'];
}
