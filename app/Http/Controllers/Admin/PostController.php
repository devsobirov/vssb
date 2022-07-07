<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostRequest as PRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::getPaginatedForAdminList();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function store(PRequest $request)
    {
        $lang = $request->lang;
        $post = new Post();
        $this->handleTranslation($post, $lang, $request->$lang);
        $post->image = $this->handleIfUploadedImage($request->image);
        $post->category_id = $request->category_id;
        $post->author_id = auth()->id();
        $post->published = (bool) $request->published;
        $post->save();

        if ($post->id) {
            return redirect()->route('posts.edit', $post->id)->with(['success' => "Muvaffaqiyatli saqlandi!"]);
        }
        return redirect()->back()->withErrors(['msg' => "No'malum xatolik, qayta urinib ko'ring"]);
    }

    public function update(Request $request, Post $post)
    {
        if ($request->post('generalData')) {
            $post->category_id = $request->category_id;
            $post->author_id = auth()->id();
            $post->published = (bool) $request->published;
        }

        if ($img = $request->image) {
            $post->image = $this->handleIfUploadedImage($img);
        }
        if ($lang = $request->lang) {
            $this->handleTranslation($post, $lang, $request->$lang);
        }

        $result = $post->save();
        if ($result) {
            return redirect()->back()->with(['success' => "Muvaffaqiyatli saqlandi!"]);
        }
        return redirect()->back()->withErrors(['msg' => "No'malum xatolik, qayta urinib ko'ring"]);
    }

    public function destroy(Post $post)
    {
        $img = $post->image;
        $result = $post->delete();
        if ($result && \File::exists(public_path($img))) {
            \File::delete(public_path($img));
        }
        return redirect()->back()->with(['success' => "Muvaffaqiyatli o'chirildi!"]);
    }

    private function handleIfUploadedImage($img) : ?string
    {
        $imagePath = null;
        if (!empty($img)) {
            $filename = time().'_'.$img->getClientOriginalName();
            $base_path = Post::IMAGE_BASE_DIR .'/'. date('Y-m-d');

            $img->move(public_path($base_path), $filename);
            $imagePath = $base_path. '/'.$filename;
        }
        return $imagePath;
    }

    private function handleTranslation($post,string $lang, array $data) : void
    {
        foreach ($data as $property => $value) {
            if ($property == 'body') {
                $post->setTranslation('excerpt', $lang, $this->handleExcerpt($value));
            }
            $post->setTranslation($property, $lang, $value);
        }
    }

    private function handleExcerpt($postBody)
    {
        if (!empty($postBody) && !empty($cleaned = strip_tags($postBody))) {
            return substr($cleaned, 0, Post::POST_EXCERPT_LENGTH);
        }
        return null;
    }
}
