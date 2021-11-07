<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charactertype extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'video_start'];

    public function character() {
        return $this->hasMany(Character::class);
    }
}
