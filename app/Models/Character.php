<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'current_storypoints', 'charactertype_id',];

    public function charactertype() {
        return $this->belongsTo(Charactertype::class);
    }
}
