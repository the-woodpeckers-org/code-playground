<?php

namespace App\Services;

use App\Http\Requests\CreatePostFormRequest;
use App\Http\Requests\UpdatePostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostService
{
    public function get(Request $request)
    {
        return Post::find($request->input('id'));
    }

    public function getBySlug(Request $request)
    {
        return Post::where('slug', $request->input('slug'))->firstOrFail();
    }

    public function getLanding()
    {
        return Post::take(3)->latest()->get();
    }

    public function getAll(Request $request)
    {
        return Post::paginate(8);
    }

    public function getAllByContributor(Request $request)
    {
        return Post::where('created_by', $request->user()->id)->paginate(8);
    }

    public function create(CreatePostFormRequest $request)
    {
        if ($request->user()) {
            $post = new Post();
            $thumbnail_img = $request->file('thumbnail');
            $thumbnail = cloudinary()->upload($thumbnail_img->getRealPath())->getSecurePath();
            $post->fill([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'body' => $request->input('body'),
                'thumbnail' => $thumbnail,
                'created_by' => $request->user()->id,
            ]);
            $post->save();
            return ['message' => 'Success'];
        }
        return new BadRequestHttpException('Unauthenticated');
    }

    public function update(UpdatePostFormRequest $request)
    {

    }

    public function delete(Request $request)
    {

    }

}
