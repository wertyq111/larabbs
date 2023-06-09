<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
		$topics = $topic->withOrder($request->order)
            ->with('user', 'category')
            ->paginate(20);
		return view('topics.index', compact('topics'));
	}

    public function show(Request$request, Topic $topic)
    {
        // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

		return redirect()->to($topic->link())->with('success', __('topics.Created successfully'));
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();

		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', __('topics.Updated successfully'));
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', __('topics.Deleted successfully'));
	}

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据,默认是失败的
        $data = [
            'success' => false,
            'msg' => __('Upload Failed'),
            'file_path' => ''
        ];

        // 判断是否有上传文件, 并赋值给$file
        if($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);
            if($result) {
                $data['success'] = true;
                $data['msg'] = __('Upload Successful');
                $data['file_path'] = $result;
            }
        }

        return $data;
    }
}
