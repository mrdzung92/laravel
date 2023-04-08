<h3>Giá Coin</h3>
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th><b>Tên</b></th>
            <th><b>Giá(usd)</b></th>
            <th><b>Biến động 24h</b></th>
        </tr>
    </thead>
    <tbody>   
        @foreach ($itemCoin as $item)
        @php
            $price = number_format($item['price'],2);
         
            $color = $item['percent_change_24h']>=0?'text-success':'text-danger';
            $percentChange24h =sprintf('<span class="%s">%s</span>',$color, number_format($item['percent_change_24h'],3))
        @endphp
        <tr>
            <td>{{$item['name']}}</td>
            <td>{{ $price}}</td>
            <td>{!! $percentChange24h!!}</td>
        </tr>
        @endforeach
        
    </tbody>
</table>