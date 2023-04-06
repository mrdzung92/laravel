@php
    use App\Helpers\Template as Template;
    use App\Helpers\Highlight as Highlight;
@endphp

<table class="table table-striped jambo_table bulk_action">
    <thead>
        <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title" >User info</th>
            <th class="column-title" width="15%">Avatar</th>
            <th class="column-title">Trạng thái</th>
            <th class="column-title">Cấp độ</th>
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
                    $username = Highlight::show( $item->username,$params['search'],'username');
                    $email = Highlight::show($item->email,$params['search'],'email');
                    $fullname = Highlight::show($item->fullname,$params['search'],'fullname');
                    $avatar = Template::showItemThumb($item->avatar, $item->avatar,$controllerName);
                    $status = Template::showItemStatus($item->status, $id, $controllerName);
                    $level = Template::showItemSelect($item->level, $id, $controllerName,'level');
                    $createdHistory = Template::showItemHistory($item->created, $item->created_by);
                    $modifiedHistory = Template::showItemHistory($item->modified, $item->modified_by);
                    $listButtonAction = Template::showButtonAction($controllerName,$id);
                @endphp
                <tr class="{{ $class}} pointer">
                    <td class="">{{ $key + 1 }}</td>
                    <td>
                        <p><strong>UserName : </strong>{!! $username !!}</p>
                        <p><strong>Email : </strong>{!!  $email !!}</p>
                        <p><strong>Fullname : </strong>{!!  $fullname !!}</p>
                        {{-- <p>{!!$thumb!!}</p> --}}
                    </td>
                    <td> {!! $avatar !!}</td>
                    <td> {!! $status !!}</td>
                    <td> {!! $level !!}</td>
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
