<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchStatus extends BaseModel
{
    protected $fillable = ['created_by', 'last_updated_by', 'title', 'display_class', 'status'];

    public function bookCollection()
    {
        return $this->hasMany(Book::class, 'research_status');
    }
}
