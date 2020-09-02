<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentCategory extends Model
{
    protected $fillable = ['category_id', 'comment_id'];

    /**
     * Eloquent relationship with the Category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Eloquent relationship with the Comment model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comment()
    {
        return $this->belongsToMany(Comment::class);
    }
}
