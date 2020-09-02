<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function comment_categories()
    {
        return $this->hasMany(CommentCategory::class);
    }
}
