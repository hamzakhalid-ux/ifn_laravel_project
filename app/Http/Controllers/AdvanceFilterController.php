<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class AdvanceFilterController extends ViewComposingController
{
    //
    public function advancefilter(Request $request) {

        $filter = $request->all();
        if(empty(request('slug')) && !empty($filter))
        {
            $request->validate([
                'keyword_1' => 'required',
            ]);
        }
        $filter = $request->all();
        $slug = request('slug');
        $fromDate = (!empty($filter['from_date_year'])) ? Carbon::createFromFormat('Y-m', $filter['from_date_year'] . '-' . $filter['from_date_month']) : '';
        $toDate = (!empty($filter['to_date_year'])) ? Carbon::createFromFormat('Y-m', $filter['to_date_year'] . '-' . $filter['to_date_month']) : '';
        $type = empty($slug) ? 'advance' : 'normal';
        $filters = [$filter['category_title'] ?? '', $filter['post_country'] ??'', $filter['post_sector'] ?? '', $filter['tag_title'] ?? '', $filter['post_title'] ?? '', $slug ?? '', $fromDate ?? '', $toDate ?? '', $filter['keyword_1'] ?? '',$filter['keyword_2'] ?? '',$filter['keyword_3'] ?? '',$filter['keyword_4'] ?? ''];
        if (empty(array_filter($filters))) {
            $cat_posts = null; // Set $cat_posts to null when all filters are empty
            $filter_status = true;
        }
        else{
            $filter_status = false;

            $cat_posts = Post::with([
                'post_category.categorytitle', // Eager load post_category and its categorytitle relationship
                'post_tag.tagtitle', // Eager load post_tag and its tagtitle relationship
                'post_location.loctitle'
            ]);

            // Apply filters
            $cat_posts->when(!empty($filter['category_title']), function ($query) use ($filter) {
                $query->whereHas('post_category.categorytitle', function ($q) use ($filter) {
                    $q->where('title', 'like', '%' . $filter['category_title'] . '%');
                });
            });

            $cat_posts->when(!empty($filter['post_country']), function ($query) use ($filter) {
                $query->whereHas('post_location.loctitle', function ($q) use ($filter) {
                    $q->where('short_title', 'like', '%' . $filter['post_country'] . '%');
                });
            });

            $cat_posts->when(!empty($filter['post_sector']), function ($query) use ($filter) {
                return $query->where('sector', 'like', '%' . $filter['post_sector'] . '%');
            });

            $cat_posts->when(!empty($filter['keyword_1']), function ($query) use ($filter) {
                $query->where(function ($subQuery) use ($filter) {
                    $subQuery->orWhere('post_content', 'like', '%' . $filter['keyword_1']. '%'. $filter['keyword_2'] ?? '' . '%' . $filter['keyword_3'] ?? '' . '%'. $filter['keyword_4'] ?? '' . '%');
                    $subQuery->orWhere('post_title', 'like', '%' . $filter['keyword_1'] . '%'. $filter['keyword_2']  ?? '' . '%' . $filter['keyword_3']  ?? '' . '%'. $filter['keyword_4'] ?? '' . '%')
                        ->orWhereHas('post_category.categorytitle', function ($q) use ($filter) {
                            $q->where('title', 'like', '%' . $filter['keyword_1'] . '%'. $filter['keyword_2'] ?? '' . '%' . $filter['keyword_3'] ?? '' . '%'. $filter['keyword_4'] ?? '' . '%');
                        })
                        ->orWhereHas('post_tag.tagtitle', function ($q) use ($filter) {
                            $q->where('title', 'like', '%' . $filter['keyword_1'] . '%'.$filter['keyword_2'] ?? '' . '%' . $filter['keyword_3'] ?? '' . '%'. $filter['keyword_4'] ?? '' . '%');
                        });
                });
            });

            $cat_posts->when(!empty($filter['tag_title']), function ($query) use ($filter) {
                $query->whereHas('post_tag.tagtitle', function ($q) use ($filter) {
                    $q->where('title', 'like', '%' . $filter['tag_title'] . '%');
                });
            });

            $cat_posts->when(!empty($filter['post_title']), function ($query) use ($filter) {
                $query->where('post_title', 'like', '%' . $filter['post_title'] . '%');
            });

            $cat_posts->when(!empty($slug), function ($query) use ($slug) {
                $query->where('post_title', 'like', '%' . $slug . '%');
            });

            $cat_posts->when(!empty($fromDate), function ($query) use ($fromDate) {
                $query->where('created_at', '>=' , $fromDate);
            });

            $cat_posts->when(!empty($toDate), function ($query) use ($toDate) {
                $query->where('created_at', '<=' , $toDate);
            });
            // Get the final results
            $cat_posts = $cat_posts->get();
        }

        $this->viewData['main_class'] = 'search-results m-t-35';
        // dd($type);
        return $this->buildTemplate('advance_filter')->with(['slug'=> $slug,'filter_status'=>$filter_status,'type'=>$type,'filter'=>$filter,'cat_posts' => $cat_posts]);
    }
}
