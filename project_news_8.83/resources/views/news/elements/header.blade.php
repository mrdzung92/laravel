@php
    use App\Models\CategoryModel as CategoryModel;
    use App\Helpers\Url;
    $CategoryModel = new CategoryModel();
  $itemCategory =  $CategoryModel->listItems(null,['task' =>'news-list-items']);
  $htmlMenuWed ='';
  $htmlMenuMobile ='';
  $currentCategoryId = Route::input('category_id');
  if(count($itemCategory)>0){
    foreach ($itemCategory as $value) {
        $link = Url::linkCategory($value['id'],$value['name']);    
        $classActive = $value['id']==$currentCategoryId ?'class="active"':'';
        $htmlMenuWed .= sprintf('<li %s><a href="%s">%s</a></li>', $classActive ,$link,$value['name']);
        $htmlMenuMobile .=' <li class="menu_mm"><a href="#">'.$value['name'].'</a></li>';
    }

    if(session('userInfo')){
        $htmlMenuWed .=sprintf('<li %s><a href="%s">%s</a></li>', $classActive ,route('auth/logout'),'Đăng xuất');
    }else {
        $htmlMenuWed .=sprintf('<li %s><a href="%s">%s</a></li>', $classActive ,route('auth/login'),'Đăng nhập');
    }
   
  }
@endphp


<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{{route('home')}}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                    style="background-image:url({{asset('news/images/zendvn-online.png')}});background-size: contain">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <!-- Navigation -->
                        <nav class="main_nav">
                            <ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">
                              {!!$htmlMenuWed!!}
                            </ul>
                        </nav>
                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menu -->
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    <nav class="menu_nav">
        <ul class="menu_mm">
            {!!$htmlMenuMobile!!}
        </ul>
    </nav>
    <div class="menu_subscribe"><a href="#">Subscribe</a></div>
    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
