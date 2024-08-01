<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class Language extends Model
{
    use HasFactory,  Notifiable, SoftDeletes;
    protected $fillable = [
        'name',
        'canonical',
        'description',
        'user_id',
        'image',
    ];

    public function postCatalogues(){
        return $this->belongsToMany(PostCatalogue::class,'post_catalogue_languages','post_Catalogue_id','language_id')
        ->withPivot('name','canonical', 'meta_title', 'meta_keyword','meta_description', 'description', 'content')
        ->withTimestamps();
    }
   
}
