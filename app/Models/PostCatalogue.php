<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
class PostCatalogue extends Model
{
    use HasFactory,  Notifiable, SoftDeletes;
    protected $fillable = [
        'parentId',
        'lft',
        'rgt',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'order',
        'user_id'
    ];
    protected $table = 'post_catalogues';
    public function languages(){
        return $this->belongsToMany(Language::class,'post_catalogue_languages','post_Catalogue_id','language_id')
        ->withPivot('name','canonical', 'meta_title', 'meta_keyword','meta_description', 'description', 'content')
        ->withTimestamps();
    }

    public function post_catalogue_language(){
        return $this->hasMany(PostCatalogueLanguage::class,'post_catalogue_id', 'id');
    }

    // public function isChildrenNode($id = 0){
    //     $postCatalogue = $this->find($id);
    //     if($postCatalogue){
    //         return  false;
    //     }

    //     if($postCatalogue->rgt - $postCatalogue->lft !== 1){
    //         return false;
    //     }

    //     return true;
    // }

    public static function isNodeCheck($id = 0){
        $postCatalogue = PostCatalogue::find($id);
        if($postCatalogue->rgt - $postCatalogue->lft !== 1){
            return false;
        }

        return true;
    }
}
