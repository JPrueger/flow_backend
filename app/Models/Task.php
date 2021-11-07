<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'description', 'assigne_id', 'storypoints', 'status', 'sort_index'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
