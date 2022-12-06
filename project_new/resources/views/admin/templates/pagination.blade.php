
@php
    $totalItem = $items->total();
    $totalPages = $items->lastPage();
    $totalItemsPerPage = $items->perPage();
@endphp

<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-0">Số phần tử trên trang: <b>{{$totalItemsPerPage}}</b> trên <span class="label label-success label-pagination">{{$totalPages}}
                    trang</span></p>
            <p class="m-b-0">Hiển thị<b> 1 </b> đến<b> 2</b> trên<b> {{$totalItem}}</b> Phần tử</p>
        </div>
        
        <div class="col-md-6">
            {{$items->links('pagination.pagination_backend',['paginator'=>$items])}}
            


        </div>
    </div>
</div>
