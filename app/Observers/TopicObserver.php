<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');

        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        // 如slug字段无内容, 即使用翻译器对title进行翻译
        if(!$topic->slug) {

            dispatch(new TranslateSlug($topic));
            //$topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}
