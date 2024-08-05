<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Category;
use App\Models\Locations;
use App\Models\Page;
use App\Models\PostCategory;
use App\Models\PostLocations;
use App\Models\PostTag;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class ListingController extends ViewComposingController
{
    //
    public function categorylisting(Request $request) {
        $slug = request('slug');
        if (empty($slug)) {
            return redirect()->route('home');
        }
        $slug = request('slug');
        $filter = request('filter');
        $routeName = \Route::currentRouteName();

        if($routeName == 'category')
        {

            $cat_details =  Category::with('filtersetting')->where('breadcrumb',$slug)->first();
            $total_count = PostCategory::where('category_id',$cat_details['category_id'])->count();
            $perPage = 20;
            $page = 1;
            $cat_posts = Category::with([
                'postmapper' => function ($query) use ($page, $perPage,$filter) {
                    $query->with(['postdetail' => function ($q) use($filter) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                    }
                ]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.userdetail',
            ])->where('breadcrumb', $slug)->first();
            $type ='c';
        }
        elseif($routeName == 'tag')
        {
            $cat_details =  Tag::with('filtersetting')->where('slug',$slug)->first();
            $total_count = PostTag::where('tag_id',$cat_details['id'])->count();
            $perPage = 20;
            $page = 1;
            $cat_posts = Tag::with([
                'postmapper' => function ($query) use ($page, $perPage,$filter) {
                    $query->with(['postdetail' => function ($q) use($filter) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                    }
                ]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.userdetail',
            ])->where('slug', $slug)->first();
            $type ='t';

        }
        elseif($routeName == 'location')
        {
            $cat_details =  Locations::with('filtersetting')->where('short_title',$slug)->first();
            $total_count = PostLocations::where('loc_id',$cat_details['loc_id'])->count();
            $perPage = 20;
            $page = 1;
            $cat_posts = Locations::with([
                'postmapper' => function ($query) use ($page, $perPage,$filter) {
                    $query->with(['postdetail' => function ($q) use($filter) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                    }
                ]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
                'postmapper.postdetail.userdetail',
            ])->where('short_title', $slug)->first();
            $type ='l';
        }
        elseif($routeName == 'region')
        {

            $cat_details =  Locations::with('filtersetting')->where('region',$slug)->first();
            $total_count = PostLocations::where('loc_id',$cat_details['loc_id'])->count();
            $all_records = PostLocations::with('postdetail')->where('loc_id',$cat_details['loc_id'])->get();
            $perPage = 20;
            $page = 1;
            $cat_posts = Locations::with([
                'postmapper' => function ($query) use ($page, $perPage, $filter) {
                    $query->with(['postdetail' => function ($q) use ($filter) {
                        if (!empty($filter)) {
                            $q->where('post_title', 'like', '%' . $filter . '%');
                        }
                    }]);
                    $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);
                },
                'filtersetting',
                'postmapper.postdetail.post_tag.tagtitle',
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
        $class = "country-sk-page";
        if(!empty($cat_posts['filtersetting']['template']) && $cat_posts['filtersetting']['template'] == 'newsletter_template')
        {
            $class = "newsletters";
        }
        elseif(!empty($cat_posts['filtersetting']['template']) && $cat_posts['filtersetting']['template'] == 'press_release')
        {
            $class = "press-release m-t-10";
        }
        $this->viewData['main_class'] = $class;
        
        $title_name = !empty($cat_details->title) ? $cat_details->title : $cat_details->category_title;
        $this->viewData['title'] =  "IFN Investor -  $title_name";
        return $this->buildTemplate('categorylisting');
    }

    public function authorlisting(Request $request) {
        $slug = request('slug');
        if (empty($slug)) {
            return redirect()->route('home');
        }
        $this->viewData['main_class'] = 'author-page';
        $this->viewData['title'] = 'Author';
        return $this->buildTemplate('authorcategorylisting');
    }

    public function authorHomelisting(Request $request) {

        $this->viewData['main_class'] = 'author-page investor-correspondent-page p-t-0';
        $this->viewData['title'] = 'Author';
        return $this->buildTemplate('author_home_listing');
    }

    public function addmore(Request $request)
    {
        $data = $request->all();
        try{
            if(!empty($data['template']) && !empty($data['cat_id']))
            {
                $perPage = 20;
                $page = intval($data['page']);
                // $page = 1;
                if($data['data_type'] == 'category')
                {
                    $data['cat_posts'] = Category::with([
                        'postmapper' => function ($query) use ($page, $perPage) {
                            $query->with(['postdetail']);
                            $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                        },
                        'filtersetting',
                        'postmapper.postdetail.post_tag.tagtitle',
                        'postmapper.postdetail.userdetail',
                    ])->where('category_id', $data['cat_id'])->first();
                    $data['type'] = 'c';
                }
                else if($data['data_type'] == 'tag')
                {
                    $data['cat_posts'] = Tag::with([
                        'postmapper' => function ($query) use ($page, $perPage) {
                            $query->with(['postdetail']);
                            $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);

                        },
                        'filtersetting',
                        'postmapper.postdetail.post_tag.tagtitle',
                        'postmapper.postdetail.userdetail',
                    ])->where('id', $data['cat_id'])->first();
                    $data['type'] = 't';
                }
                else if($data['data_type'] == 'location')
                {
                    $data['cat_posts'] = Locations::with([
                        'postmapper' => function ($query) use ($page, $perPage) {
                            $query->with(['postdetail']);
                            $query->orderBy('created_at', 'desc')->skip(($page - 1) * $perPage)->take($perPage);
                        },
                        'filtersetting',
                        'postmapper.postdetail.post_tag.tagtitle',
                        'postmapper.postdetail.userdetail',
                    ])->where('id', $data['cat_id'])->first();
                    $data['type'] = 'l';
                }

                $html = View::make('components.index.ajax_listiing_template')->with(['data'=>$data])->render();
                $page = (count($data['cat_posts']['postmapper']) > 0 && !empty($data['cat_posts']['postmapper'])) ? ($page + 1) : 2;
                $current_total = count($data['cat_posts']['postmapper']) ?? 0;

                return response()->json(['success' => true, 'title' => 'Success', 'icon' => 'success','message' => 'Successfully', 'data' => $html,'page'=> $page ,'current_total' => $current_total]);
            }
            else{
                return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Category id is Required"]);

            }
        }catch(Exception $e)
        {
            return response()->json(['success' => false, 'title' => 'Error', 'icon' => 'error', 'message' => "Something went wrong"]);

        }
    }


    public function pagedata(Request $request) {
        $slug = request('slug');
        if (empty($slug)) {
            return redirect()->route('home');
        }
        $page_data = Page::where('page_slug',$slug)->first();
        if (empty($page_data)) {
            return redirect()->route('home');
        }

        $this->viewData['main_class'] = $page_data->page_class;

        $htmlContent = $page_data->page_content;
        $pattern = '/src="(assets\/images\/[^"]+)"/';
        $pattern2 = '/src="(_\d+_([a-f0-9]+)_l\.png)"/';

        $page_data->page_content = preg_replace_callback($pattern, [$this,'replaceCallbackoldurl'], $htmlContent);
        $page_data->page_content = preg_replace_callback($pattern2, [$this,'replaceCallbackimagelink'], $page_data->page_content);
        $this->viewData['title'] = "IFN Investor -  " . $page_data['page_title'] ?? '';
        return $this->buildTemplate('pagedetail')->with('page_data',$page_data);
    }


    private function replaceCallbackoldurl($matches) {
        return 'src="' . url('/') . '/' . $matches[1] . '"';
    }
    private function replaceCallbackimagelink($matches) {
        return 'src="' . url('/') . '/media/' . $matches[1] . '"';
    }
}
