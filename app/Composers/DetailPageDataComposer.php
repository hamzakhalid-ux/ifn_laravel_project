<?php

namespace App\Composers;

use App\Models\Category;
use App\Models\Locations;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\View\View;
use App\Models\Tag;
class DetailPageDataComposer {

    public function compose(View $view) {

        $slug = request('slug');
        // Use preg_match to find the pattern
        if (preg_match('/([a-zA-Z]+)(\d+)-(\d+)/', $slug, $matches)) {
            $prefix = $matches[1];
            $parent_id = $matches[2];
            $post_id = $matches[3];
        }
        if (empty($prefix) || empty($parent_id) ||  empty($post_id)) {
            // Redirect to the home page
            return redirect()->route('home');
        }

        if($prefix == 'c')
        {
            $parent_details = Category::with([
                'postmapper' => function ($query)  {
                    $query->with(['postdetail']);
                    $query->orderBy('created_at', 'desc')->take(4);
                },
                'filtersetting'
            ])->where('category_id', $parent_id)->first();
            $type ='c';
            $url ='category';
        }
        if($prefix == 't')
        {
            $parent_details = Tag::with([
                'postmapper' => function ($query)  {
                    $query->with(['postdetail']);
                    $query->orderBy('created_at', 'desc')->take(4);
                },
                'filtersetting'
            ])->where('id', $parent_id)->first();
            $type ='t';
            $url ='tag';

        }
        if($prefix == 'l')
        {
            $parent_details = Locations::with([
                'postmapper' => function ($query)  {
                    $query->with(['postdetail']);
                    $query->orderBy('created_at', 'desc')->take(4);
                },
                'filtersetting'
            ])->where('loc_id', $parent_id)->first();
            $type ='l';
            $url ='location';

        }
        $main_post = Post::with('userdetail','post_tag.tagtitle','post_location.loctitle')->where('post_id' ,$post_id)->first();

        if (empty($main_post) || empty($parent_details)) {
            // Redirect to the home page
            return redirect()->route('home');
        }

        $view
        ->with('type', $type)
        ->with('url', $url)
        ->with('parent_details', $parent_details)
        ->with('main_post', $main_post);
    }

}
