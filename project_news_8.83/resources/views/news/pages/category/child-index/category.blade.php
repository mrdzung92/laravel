@if (count($category) > 0)
   
        @switch($category['display'])
            @case('list')
                @include('news.pages.category.child-index.category_list')
            @break

            @case('grid')
                @include('news.pages.category.child-index.category_grid')
            @break

          
             
        @endswitch
  

@endif
