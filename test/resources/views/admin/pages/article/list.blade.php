@php
    use App\Helpers\Template as Template;
    use App\Helpers\Highlight as Highlight;
@endphp

<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title" width="30%">Article info</th>
            <th class="column-title" width="14%">Ảnh</th>
            <th class="column-title">Trạng thái</th>
            <th class="column-title">Kiểu bài viết</th>
            <th class="column-title">Danh mục</th>
            {{-- <th class="column-title">Tạo mới</th>
            <th class="column-title">Chỉnh sửa</th> --}}
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
                    $content = Highlight::show($item->content,$params['search'],'content');
                    $link = Highlight::show($item->link,$params['search'],'link');
                    $thumb = Template::showItemThumb($item->thumb, $name,$controllerName);
                    $status = Template::showItemStatus($item->status, $id, $controllerName);
                    $type = Template::showItemSelect($item->type, $id, $controllerName,'type');
                    $categoryName = $item->category_name;
                    // $createdHistory = Template::showItemHistory($item->created, $item->created_by);
                    // $modifiedHistory = Template::showItemHistory($item->modified, $item->modified_by);
                    $listButtonAction = Template::showButtonAction($controllerName,$id);
                @endphp
                <tr class="{{ $class}} pointer">
                    <td class="">{{ $key + 1 }}</td>
                    <td>
                        <p><strong>Name : </strong>{!! $name !!}</p>
                        <p><strong>Content : </strong>{!! $content !!}</p>
                    </td>
                    <td> <p>{!!$thumb!!}</p></td>
                    <td> {!! $status !!}</td>
                    <td> {!! $type !!}</td>
                    <td> {!! $categoryName !!}</td>
                    {{-- <td>{!! $createdHistory !!}</td>
                    <td>{!! $modifiedHistory !!}</td> --}}
                    <td class="last">{!!$listButtonAction!!}</td>    
                </tr>
            @endforeach
        @else
            @include('admin.templates.list_empty', ['colspan' => 6])
        @endif

    </tbody>
</table>
