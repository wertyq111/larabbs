<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root(Request $request, Topic $topic)
    {
        $topics = $topic->withOrder($request->order)
            ->with('user', 'category')
            ->paginate(20);
        return view('topics.index', compact('topics'));
    }
}
