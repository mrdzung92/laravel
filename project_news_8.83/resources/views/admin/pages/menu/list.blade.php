@php
    use App\Helpers\Template as Template;
    use App\Helpers\Highlight as Highlight;
@endphp

<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title" >Tên</th>
            <th class="column-title" >Link</th>
            <th class="column-title">Trạng thái</th>
            <th class="column-title">Sắp xếp</th>
            <th class="column-title">Kiểu Menu</th>
            <th class="column-title">Kiểu mở</th>
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
                    $description = Highlight::show($item->description,$params['search'],'description');
                    $link = Highlight::show($item->link,$params['search'],'link');
                    $status = Template::showItemStatus($item->status, $id, $controllerName);
                    $ordering =  Template::orderingInput($controllerName,$item->ordering,$id);
                    $typeMenu = Template::showItemSelect($item->type_menu, $id, $controllerName,'type_menu');
                    $typeOpen = Template::showItemSelect($item->type_open, $id, $controllerName,'type_open');
                    // $createdHistory = Template::showItemHistory($item->created, $item->created_by);
                    // $modifiedHistory = Template::showItemHistory($item->modified, $item->modified_by);
                    $listButtonAction = Template::showButtonAction($controllerName,$id);
                @endphp
                <tr class="{{ $class}} pointer">
                    <td class="">{{ $key + 1 }}</td>
                    <td><strong>{!! $name !!}</strong></td>
                    <td><strong>{!! $link !!}</strong></td>
                       
                  
                    <td> {!! $status !!}</td>
                    <td> {!! $ordering !!}</td>
                    <td> {!! $typeMenu !!}</td>
                    <td> {!! $typeOpen !!}</td>
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
