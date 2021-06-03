<?php

namespace App\Traits;

use App\Models\Post;

trait UpdateViewedPost
{
    private function updateViewedPost(Post $post)
    {
        $post->latest_viewed_at = $post->latestViewed() ?? now();
        $post->total_viewed = $post->totalViewed() ?? 0 ;
        $post->save();
    }
}
