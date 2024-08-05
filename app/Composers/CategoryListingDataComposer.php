<?php

namespace App\Composers;

use App\Models\Category;
use App\Models\Locations;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostLocations;
use App\Models\PostTag;
use Illuminate\View\View;
use App\Models\Tag;
use Carbon\Carbon;

class CategoryListingDataComposer {

    public function compose(View $view) {

        $slug = request('slug');
        $filter = request('filter');
        $filter_tag =request('tag');
        $filter_cat =request('category');
        $post_date = request('post_date');
        $routeName = \Route::currentRouteName();
        $perPage = 20;
        $page = 1;
        $allcategories =(new Category)->getAllPostCategory();
        $alltags =(new Tag)->getAllPosttags();

        if($routeName == 'category')
        {

            $cat_details =  Category::with('filtersetting')->where('breadcrumb',$slug)->first();
            $total_count = PostCategory::where('category_id',$cat_details['category_id'])->count();
            $all_records = PostCategory::with('postdetail')->where('category_id',$cat_details['category_id'])->get();
            $title = 'All ';
            $cat_posts = Category::with([
                'postmapper' => function ($query) use ($page, $perPage,$filter,$post_date,$filter_tag) {
                    $query->with(['postdetail' => function ($q) use($filter,$post_date,$filter_tag) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                        if (!empty($post_date)) {
                            $q->where('post_date','like', '%'. $post_date.'%');
                        }
                        // Add a whereHas condition to filter based on the post_tag relation
                        if (!empty($filter_tag)) {
                            $q->whereHas('post_tag', function ($tagQuery) use ($filter_tag) {
                                $tagQuery->where('tag_id', $filter_tag);
                            });
                        }
                        $q->where('post_status' , 'published')
                        ->when(empty(session()->get('userData')), function($query){
                            return $query->where('allow' , 'public');
                        })
                        ->when(!empty(session()->get('userData') && session()->get('userData')->subscriber == 0), function($query){
                            return $query->where('allow' , 'basic');
                        });

                    }
                ]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.post_category.categorytitle',
                'postmapper.postdetail.userdetail',
            ])->where('breadcrumb', $slug)->first();
            $type ='c';
        }
        elseif($routeName == 'tag')
        {
            $cat_details =  Tag::with('filtersetting')->where('slug',$slug)->first();
            $total_count = PostTag::where('tag_id',$cat_details['id'])->count();
            $all_records = PostTag::with('postdetail')->where('tag_id',$cat_details['id'])->get();
            $title = 'Tag: ';
            $cat_posts = Tag::with([
                'postmapper' => function ($query) use ($page, $perPage,$filter,$post_date,$filter_cat) {
                    $query->with(['postdetail' => function ($q) use($filter,$post_date,$filter_cat) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                        if (!empty($post_date)) {
                            $q->where('post_date','like', '%'. $post_date.'%');
                        }
                        // Add a whereHas condition to filter based on the post_tag relation
                        if (!empty($filter_cat)) {
                            $q->whereHas('post_category', function ($tagQuery) use ($filter_cat) {
                                $tagQuery->where('category_id', $filter_cat);
                            });
                        }
                        $q->where('post_status' , 'published')
                        ->when(empty(session()->get('userData')), function($query){
                            return $query->where('allow' , 'public');
                        })
                        ->when(!empty(session()->get('userData') && session()->get('userData')->subscriber == 0), function($query){
                            return $query->where('allow' , 'basic');
                        });
                    }
                ]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.post_category.categorytitle',
                'postmapper.postdetail.userdetail',
            ])->where('slug', $slug)->first();
            $type ='t';

        }
        elseif($routeName == 'location')
        {
            $cat_details =  Locations::with('filtersetting')->where('short_title',$slug)->first();
            $total_count = PostLocations::where('loc_id',$cat_details['loc_id'])->count();
            $all_records = PostLocations::with('postdetail')->where('loc_id',$cat_details['loc_id'])->get();
            $title = 'Country: ';
            $cat_posts = Locations::with([
                'postmapper' => function ($query) use ($page, $perPage,$filter,$post_date) {
                    $query->with(['postdetail' => function ($q) use($filter,$post_date) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                        if (!empty($post_date)) {
                            $q->where('post_date','like', '%'. $post_date.'%');
                        }
                        $q->where('post_status' , 'published')->when(empty(session()->get('userData')), function($query){
                            return $query->where('allow' , 'public');
                        })
                        ->when(!empty(session()->get('userData') && session()->get('userData')->subscriber == 0), function($query){
                            return $query->where('allow' , 'basic');
                        });
                    }
                ]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.post_category.categorytitle',
                'postmapper.postdetail.userdetail',
            ])->where('short_title', $slug)->first();
            $type ='l';
        }
        elseif($routeName == 'region')
        {

            $cat_details =  Locations::with('filtersetting')->where('region',$slug)->first();
            $total_count = PostLocations::where('loc_id',$cat_details['loc_id'])->count();
            $all_records = PostLocations::with('postdetail')->where('loc_id',$cat_details['loc_id'])->get();
            $title = 'Region: ';
            $cat_posts = Locations::with([
                'postmapper' => function ($query) use ($page, $perPage, $filter, $post_date) {
                    $query->with(['postdetail' => function ($q) use ($filter, $post_date) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                        if (!empty($post_date)) {
                            $q->where('post_date', 'like', '%' . $post_date . '%');
                        }
                        $q->where('post_status' , 'published')
                        ->when(empty(session()->get('userData')), function($query){
                            return $query->where('allow' , 'public');
                        })
                        ->when(!empty(session()->get('userData') && session()->get('userData')->subscriber == 0), function($query){
                            return $query->where('allow' , 'basic');
                        });
                    }]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);
                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.post_category.categorytitle',
                'postmapper.postdetail.userdetail',
            ])
            ->where('region', $slug)
            ->has('postmapper')
            ->get();
            $mergedPostmapper = [];

            foreach ($cat_posts as $record) {
                $postmapper = $record->postmapper ?? [];
                $mergedPostmapper = array_merge($mergedPostmapper, $postmapper->toArray());
            }
            $newRecord = clone $cat_posts[0];
            unset($newRecord->postmapper);
            $newRecord['postmapper'] = $mergedPostmapper;
            $cat_posts = $newRecord;
            $type ='l';

        }

        $postdetails = array_column($cat_posts->postmapper->toArray(), 'postdetail');
        $nonEmptyPostdetails = array_filter($postdetails, function($postdetail) {
            return !empty($postdetail);
        });

        $view
        ->with('type', $type)
        ->with('cat_posts', $cat_posts)
        ->with('cat_details', $cat_details)
        ->with('all_records', $all_records)
        ->with('allcategories', $allcategories)
        ->with('alltags',$alltags)
        ->with('total_count',$total_count)
        ->with('current_post_count',count($nonEmptyPostdetails))
        ->with('title',$title);
    }

}
