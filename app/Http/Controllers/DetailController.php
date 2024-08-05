<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\ViewComposingController;
use App\Models\Post;

use Illuminate\Http\Request;

class DetailController extends ViewComposingController
{
    //
    public function detailPage(Request $request) {

        $slug = request('slug');
        // Use preg_match to find the pattern
        if (preg_match('/([a-zA-Z]+)(\d+)-(\d+)/', $slug, $matches)) {
            $prefix = $matches[1];
            $parent_id = $matches[2];
            $post_id = $matches[3];
        }
        $this->viewData['main_class'] = 'inDepth-single-report';
        $main_post = Post::with('userdetail','post_tag.tagtitle','post_location.loctitle')
        ->when(empty(session()->get('userData')), function($query){
            return $query->where('allow' , 'public');
        })
        ->when(!empty(session()->get('userData') && session()->get('userData')->subscriber == 0), function($query){
            return $query->where('allow' , 'basic');
        })
        ->where('post_id' ,$post_id)->first();
        if (empty($prefix) || empty($parent_id) ||  empty($post_id) || empty($main_post)) {
            // Redirect to the home page
            return redirect()->route('home');
        }
        $this->viewData['title'] = 'IFN Investor - '. $main_post->post_title;

        return $this->buildTemplate('detail_page');
    }

    public function newsletterdetailPage(Request $request) {

        $slug = request('slug');
        // dd($slug);
        // Use preg_match to find the pattern
        // if (preg_match('/([a-zA-Z]+)(\d+)-(\d+)/', $slug, $matches)) {
        //     $prefix = $matches[1];
        //     $parent_id = $matches[2];
        //     $post_id = $matches[3];
        // }
        // if (empty($prefix) || empty($parent_id) ||  empty($post_id)) {
        //     // Redirect to the home page
        //     return redirect()->route('home');
        // }
        $this->viewData['main_class'] = 'container';
        $this->viewData['title'] = 'IFN Investor - ' . 'NewsLetter';

        return $this->buildTemplate('newsletter_detail_page');
    }
}
