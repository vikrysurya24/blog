<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = in_array($request->get('status'), ['draft', 'publish']) ? $request->get('status') : 'draft';
        $posts = $status == 'draft' ? Post::draft() : Post::publish();
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }
        return view('posts.index', [
            'posts' => $posts->paginate(2)->withQueryString(),
            'statuses' => $this->statuses(),
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::with('inheritance')->onlyParent()->get(),
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:64',
                'slug' => 'required|string|unique:posts,slug',
                'category' => 'required',
                'tag' => 'required',
                'thumbnail' => 'required',
                'status' => 'required',
                'description' => 'required|string|max:250',
                'content' => 'required'
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            if ($request['category']) {
                $request['category'] = Category::select('id', 'title')->whereIn('id', $request->category)->get();
            }
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Proses
        DB::beginTransaction();
        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
            $post->tags()->attach($request->tag);
            $post->categories()->attach($request->category);

            toast(trans('posts.alert.create.message.success'), 'success');
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error(
                trans('posts.alert.create.title'),
                trans('posts.alert.create.message.error'),
                ['error' => $th->getMessage()]
            );
            if ($request['category']) {
                $request['category'] = Category::select('id', 'title')->whereIn('id', $request->category)->get();
            }
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = $post->categories;
        $tags = $post->tags;
        return view('posts.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::with('inheritance')->onlyParent()->get(),
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validator
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:64',
                'slug' => 'required|string|unique:posts,slug,' . $post->id,
                'category' => 'required',
                'tag' => 'required',
                'thumbnail' => 'required',
                'status' => 'required',
                'description' => 'required|string|max:250',
                'content' => 'required'
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            if ($request['category']) {
                $request['category'] = Category::select('id', 'title')->whereIn('id', $request->category)->get();
            }
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Proses
        DB::beginTransaction();
        try {
            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
            $post->tags()->sync($request->tag);
            $post->categories()->sync($request->category);

            toast(trans('posts.alert.update.message.success'), 'success');
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error(
                trans('posts.alert.update.title'),
                trans('posts.alert.update.message.error'),
                ['error' => $th->getMessage()]
            );
            if ($request['category']) {
                $request['category'] = Category::select('id', 'title')->whereIn('id', $request->category)->get();
            }
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Proses
        DB::beginTransaction();
        try {
            $post->tags()->detach();
            $post->categories()->detach();

            $post->delete();

            toast(trans('posts.alert.delete.message.success'), 'success');
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error(
                trans('posts.alert.delete.title'),
                trans('posts.alert.delete.message.error'),
                ['error' => $th->getMessage()]
            );
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }

    private function statuses()
    {
        return [
            'draft' => trans('posts.form_control.select.status.option.draft'),
            'publish' => trans('posts.form_control.select.status.option.publish')
        ];
    }

    private function attributes()
    {
        return [
            'title' => trans('posts.form_control.input.title.attribute'),
            'slug' => trans('posts.form_control.input.slug.attribute'),
            'category' => trans('posts.form_control.select.category.attribute'),
            'tag' => trans('posts.form_control.select.tag.attribute'),
            'thumbnail' => trans('posts.form_control.input.thumbnail.attribute'),
            'status' => trans('posts.form_control.select.status.attribute'),
            'description' => trans('posts.form_control.textarea.description.attribute'),
            'content' => trans('posts.form_control.textarea.content.attribute')
        ];
    }
}
