<?php

namespace App\Composers;

use App\Models\Domains;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\View;
use DB;

class DomianListDataComposer {

    public function compose(View $view) {

        $domains = Domains::all();
        $domains = (!empty($domains) && count($domains) > 0) ? $domains->toArray() : [];
        
        $view->with('domains', $domains);

    }

}
