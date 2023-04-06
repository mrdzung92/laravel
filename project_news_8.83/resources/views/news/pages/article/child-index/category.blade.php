@php
    
@endphp

@if (count($item['reated_article']) > 0)
        @switch($item['display'])
            @case('list')
                @include('news.pages.article.child-index.category_list',['item'=>$item['reated_article']])
            @break

            @case('grid')
                @include('news.pages.article.child-index.category_grid',['item'=>$item['reated_article']])
            @break        
        @endswitch
  

@endif
