<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'url',
        'image',
        'image_alt',
        'meta',
        'short_description',
        'descriprtion',
        'active'
    ];
    //many blogs belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //one blog belong to only only one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //blgs has many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
