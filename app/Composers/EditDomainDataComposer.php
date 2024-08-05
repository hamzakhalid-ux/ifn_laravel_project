<?php

namespace App\Composers;

use App\Models\Domains;
use App\Models\Page;
use Illuminate\View\View;
use App\Models\Tag;
class EditDomainDataComposer {

    public function compose(View $view) {

        $domain_id = request('domain_id');
        $domain = (!empty($domain_id)) ? Domains::where('id',$domain_id)->first() : '';
        $domain = (!empty($domain)) ? $domain->toArray() : [];

        $view->with('domain', $domain);
    }

}
