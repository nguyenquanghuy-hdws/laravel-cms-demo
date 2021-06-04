<?php

namespace App\Traits;

use App\Models\Post;

trait UpdateViewedPost
{
    private function updateViewedPost(Post $post)
    {
        $post->latest_viewed_at = now();
        $post->total_viewed = $post->totalViewed() ?? 0 ;
        $post->save();
    }
}
