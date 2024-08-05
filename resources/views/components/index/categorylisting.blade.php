
@if(!empty($cat_posts['filtersetting']['template']))

@switch($cat_posts['filtersetting']['template'])
    @case('default_template')
    @include("components.index.categorylistingnewstemplate")
        @break
    @case('blank_template')
    @include("components.index.categorylistingnewstemplate")
        @break
    @case('news_template')
    @include("components.index.categorylistingnewstemplate")
        @break
    @case('newsletter_template')
    @include("components.index.listing_newsletter_template")
        @break
    @case('press_release')
    @include("components.index.listing_press_release_template")
        @break
    @default
    @include("components.index.categorylistingnewstemplate")
@endswitch
@else
    @include("components.index.categorylistingnewstemplate")

@endif
