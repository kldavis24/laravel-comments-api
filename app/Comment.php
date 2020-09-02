<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'email',
        'state',
        'zip',
        'image_id',
    ];

    /**
     * Eloquent relationship with the CommentCategory model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment_categories()
    {
        return $this->hasMany(CommentCategory::class);
    }

    /**
     * Eloquent relationshp with the Category model, through
     * the CommentCategory model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categories()
    {
        return $this->hasManyThrough(
            Category::class,
            CommentCategory::class,
            'comment_id',   // FK from CommentCategory
            'id',           // FK from Category
            'id',           // LK from Comment
            'category_id'   // LK from Category
        );
    }

    /**
     * Eloquent relationship with the Image model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
