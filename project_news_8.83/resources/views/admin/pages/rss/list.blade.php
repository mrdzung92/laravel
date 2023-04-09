@php
    use App\Helpers\Template as Template;
    use App\Helpers\Highlight as Highlight;
@endphp

<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title" width="30%">Rss info</th>
            <th class="column-title">Trạng thái</th>
            <th class="column-title" width="5%" >Sắp xếp</th>
            <th class="column-title">Nguồn</th>
            <th class="column-title">Tạo mới</th>
            <th class="column-title">Chỉnh sửa</th>
            <th class="column-title">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @if (count($items) > 0)
            @foreach ($items as $key => $item)
                @php
                    $index = $key + 1;
                    $id = $item->id;
                    $class = $index % 2 == 0 ? 'even' : 'odd';
                    $name = Highlight::show( $item->name,$params['search'],'name');
                    $link = Highlight::show($item->link,$params['search'],'link');
                    $ordering = Template::orderingInput($controllerName,$item->ordering,$id);
                    $status = Template::showItemStatus($item->status, $id, $controllerName);
                    $source = Template::showItemSelect($item->source, $id, $controllerName,'source');
                    $createdHistory = Template::showItemHistory($item->created, $item->created_by);
                    $modifiedHistory = Template::showItemHistory($item->modified, $item->modified_by);
                    $listButtonAction = Template::showButtonAction($controllerName,$id);

                @endphp
                <tr class="{{ $class}} pointer">
                    <td class="">{{ $key + 1 }}</td>
                    <td>
                        <p><strong>Name : </strong>{!! $name !!}</p>
                        <p><strong>Link : </strong>{!! $link !!}</p>                      
                    </td>
                    <td> {!! $status !!}</td>
                    <td > {!! $ordering !!}</td>
                    <td> {!! $source !!}</td>
                    <td>{!! $createdHistory !!}</td>
                    <td>{!! $modifiedHistory !!}</td>
                    <td class="last">{!!$listButtonAction!!}</td>    
                </tr>
            @endforeach
        @else
            @include('admin.templates.list_empty', ['colspan' => 6])
        @endif

    </tbody>
</table>
