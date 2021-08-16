<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $page = 12;

    public function home()
    {
        return view('blog.home', [
            'posts' => Post::publish()->latest()->paginate($this->page)
        ]);
    }

    public function category()
    {
        return view('blog.categories', [
            'categories' => Category::onlyParent()->paginate($this->page)
        ]);
    }

    public function tag()
    {
        return view('blog.tags', [
            'tags' => Tag::paginate($this->page)
        ]);
    }

    public function search(Request $request)
    {
        if (!$request->get('keyword')) {
            return redirect()->route('blog.home');
        }

        return view('blog.search', [
            'posts' => Post::publish()->search($request->keyword)->paginate($this->page)->appends(['keyword' => $request->keyword])
        ]);
    }

    public function postByCategory($slug)
    {
        $posts = Post::publish()->whereHas('categories', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate($this->page);

        $category = Category::where('slug', $slug)->first();
        $rootCategory = $category->root();
        return view('blog.posts-category', [
            'posts' => $posts,
            'categories' => $category,
            'rootCategory' => $rootCategory
        ]);
    }

    public function postByTag($slug)
    {
        $posts = Post::publish()->whereHas('tags', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate($this->page);

        $tag = Tag::where('slug', $slug)->first();
        $tags = Tag::search($tag->title)->get();
        return view('blog.posts-tag', [
            'posts' => $posts,
            'tags' => $tags,
            'tag' => $tag
        ]);
    }

    public function postDetail($slug)
    {
        $post = Post::with(['categories', 'tags'])->where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('blog.home');
        }

        return view('blog.detail-posts', [
            'post' => $post
        ]);
    }
}
