<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
//        $blogs = Blog::where('blog_category_id', BlogCategory::orderBy('id', 'DESC')->first()->id)->orderBy('id', 'DESC')->limit(4)->get();
        $blogs = Blog::orderBy('id', 'DESC')->limit(4)->get();

        $recent_blogs = Blog::orderBy('id', 'DESC')->limit(6)->get();

        $total_category = BlogCategory::all();

        if ($total_category->count() > 0) {

            $categories = BlogCategory::limit(10)->get();
        }


        return view('frontend.pages.blogs', compact('blogs', 'categories', 'recent_blogs'));
    }

    public function getBlog($slug)
    {
        $blog = Blog::whereSlug($slug)->first();

        return view('frontend.pages.blog-detail-single', compact('blog'));

    }

    public function categoryBlog($slug)
    {

        $blog_category_id = BlogCategory::where('slug', $slug)->first()->id;
        $blogs = Blog::where('blog_category_id', $blog_category_id)->orderBy('id', 'DESC')->limit(4)->get();
        $recent_blogs = Blog::orderBy('id', 'DESC')->limit(6)->get();
        $categories = BlogCategory::limit(10)->get();

        return view('frontend.pages.blogs', compact('blogs', 'categories', 'recent_blogs'));

    }

    public function loadBlogAjax(Request $request)
    {
        $output = '';
        $id = $request->id;
        $blog_category_id = $request->blog_category_id;

        $blogs = Blog::where('id', '<', $id)->where('blog_category_id', $blog_category_id)->orderBy('id', 'DESC')->limit(4)->get();

        if (!$blogs->isEmpty() && ($blogs->count() > 0)) {
            $blogId = null;
            $blog_category_id = null;
            foreach ($blogs as $blog) {
                $url = url('uploads/blogs_images/' . $blog->image);


                $blogId = $blog->id;
                $blog_category_id = $blog->blog_category_id;


                $output .= ' <div class="col-md-6 col-sm-6 col-xs-12 blogPost">
                            <div class="thumbnail">
                                <img src="' . $url . '" alt="">
                                <div class="caption">
                                    <h6><i class="far fa-clock"></i>' . $blog->created_at->format('F j, Y') . '
                                    <span>/ </span>' . ucfirst($blog->blogCategory->name) . '
                                    </h6>
                                    <h3>' . $blog->name . '</h3>
                                    <p>' . \Illuminate\Support\Str::limit($blog->description, 100) . '</p>
                                    <a href="' . route('blog.show', $blog->slug) . '"
                                       class="btn buttonMain hvr-bounce-to-right">Read More</a>
                                </div>
                            </div>
                        </div>';
            }

            $output .= '<div class="col-md-12" id="remove-row">
                            <button id="btn-more" data-id="' . $blogId . '"  data-blog-category-id="' . $blog_category_id . '" class="btn buttonMain hvr-bounce-to-right" > Load More </button>
                        </div>';

            echo $output;
        }
    }

}
