@if (count($itemCategory) > 0)
    @foreach ($itemCategory as $key => $category)
        @switch($category['display'])
            @case('list')
                @include('news.pages.home.child-index.category_list')
            @break

            @case('grid')
                @include('news.pages.home.child-index.category_grid')
            @break

          
             
        @endswitch
    @endforeach

@endif
