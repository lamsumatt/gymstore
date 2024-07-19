<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserCatalogue extends Model
{
    use HasFactory,  Notifiable, SoftDeletes;
    protected $fillable = [
        'name',
        'publish',
        'description'
    ];
    protected $table = 'user_catalogues';
}
