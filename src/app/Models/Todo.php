<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'content',
        'is_done',
        'completed_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword))
        {
            $query->where('content', 'Like', '%'.$keyword.'%');
        }
            return $query;
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id))
        {
            $query->where('category_id', $category_id);
        }
            return $query;
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeIncomplete($query)
    {
        return $query->where('is_done', false);
    }

}
