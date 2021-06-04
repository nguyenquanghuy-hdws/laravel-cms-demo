<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Filterable;

class Post extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'title',
        'content',
        'creator_id',
        'total_viewed',
        'latest_viewed_at',
        'voucher_enable',
        'voucher_quantity'
    ];

    // public $filterable = [];

    public function filterTitle($query, $value) {
        return $query->where('title', 'LIKE', '%' . $value . '%');
    }

    // Relationships
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function readers()
    {
        return $this->belongsToMany(User::class, 'readers', 'post_id', 'user_id');
    }

    public function totalViewed()
    {
        $readCounts = $this->hasMany(Reader::class, 'post_id')->pluck('read_count')->toArray();
        return array_sum($readCounts);
    }

    public function viewed()
    {
        return $this->hasMany(Reader::class, 'post_id');
    }

    public function latestViewed()
    {
        $viewedTimes = $this->viewed()->pluck('updated_at')->toArray();
        usort($viewedTimes, 'compare_by_timestamp'); // global functions
        return end($viewedTimes);
    }
}

