<div class="sidebar_latest">
    <div class="sidebar_title">Bài viết gần đây</div>
    <div class="latest_posts">
        @php
            use App\Helpers\Template as Template;
            use App\Helpers\Url;
        @endphp
        @if (count($itemLatest) > 0)

            @foreach ($itemLatest as $item)
                @php
                    $name = $item['name'];
                    $categoryName = $item['category_name'];
                    $linkCategory = Url::linkCategory($item['category_id'], $item['category_name']);
                    $linkArticle = Url::linkArticle($item['id'], $item['name']);
                    $created = Template::showDateTimeFrontend($item['created']);
                    $thumb = asset('images/article/' . $item['thumb']);
                @endphp


                <!-- Latest Post -->
                <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                    <div>
                        <div class="latest_post_image"><img src="{{ $thumb }}" alt="{!! $name !!}">
                        </div>
                    </div>
                    <div class="latest_post_content">
                        <div class="post_category_small cat_video"><a
                                href="{{ $linkCategory }}">{{ $item['category_name'] }}</a></div>
                        <div class="latest_post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
                        <div class="latest_post_date">{{ $created }}</div>
                    </div>
                </div>
            @endforeach
        @endif



    </div>
</div>
