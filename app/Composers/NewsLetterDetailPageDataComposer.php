<?php

namespace App\Composers;

use App\Models\Category;
use App\Models\Locations;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\View\View;
use App\Models\Tag;
class NewsLetterDetailPageDataComposer {

    public function compose(View $view) {

        $post_id = request('slug');
        // Use preg_match to find the pattern
        $main_post = Post::with('post_category.categorytitle')->where('post_id' ,$post_id)->first();
        $main_highlights = Category::with('postmapper.postdetail')->where('breadcrumb','main-highlights')->first();
        $news_briefs = Category::with('postmapper.postdetail')->where('breadcrumb','news-briefs')->first();
        $other_articles = Category::with('postmapper.postdetail')->where('breadcrumb','other-articles')->first();

        $view
        ->with('main_post', $main_post)
        ->with('main_highlights', $main_highlights)
        ->with('news_briefs', $news_briefs)
        ->with('other_articles', $other_articles);
    }

}
