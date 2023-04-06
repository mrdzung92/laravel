@php
    use App\Helpers\Template as Template;
    use App\Helpers\Url;

    $name = $items['name'];
    if($showCategoryName){
        $linkCategory = Url::linkCategory($items['category_id'],$items['category_name']);
    }

    $linkArticle =  Url::linkArticle($items['id'],$items['name']);
    $created = Template::showDateTimeFrontend($items['created']);
    $content = Template::showContent($items['content'], $lenghtContent);
@endphp


<div class="post_content">
    @if ($showCategoryName)
        <div class="post_category cat_technology "><a href="{{ $linkCategory }}">{{ $items['category_name'] }}</a></div>
    @endif

    <div class="post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div class="post_author_name"><a href="#">Lưu Trường Hải
                    Lân</a>
            </div>
        </div>
        <div class="post_date"><a href="#">{{ $created }}</a></div>
    </div>
    @if ($lenghtContent > 0)
        <div class="post_text">
            {!! $content !!}

        </div>
    @endif

</div>
