<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characterlevel extends Model
{
    use HasFactory;

    protected $fillable = ['points_upgrade', 'video_state', 'video_upgrade'];
}
