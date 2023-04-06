<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        // 删除用户帖子下对应的回复
        foreach($user->topics as $topic) {
            DB::table('replies')->where('topic_id', $topic->id)->delete();
        }

        // 删除用户对应的话题
        DB::table('topics')->where('user_id', $user->id)->delete();

        // 删除用户发布的回复
        DB::table('replies')->where('user_id', $user->id)->delete();
    }
}
