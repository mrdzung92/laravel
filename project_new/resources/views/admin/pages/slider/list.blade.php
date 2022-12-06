@php
    use App\helper\Template as Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title"> # </th>
                    <th class="column-title">Slider Info</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>

                @if (count($items) > 0)
                    @foreach ($items as $key => $value)
                        @php
                            $index = $key + 1;
                            $class = $index % 2 == 0 ? 'even' : 'odd';
                            $name = $value['name'];
                            $description = $value['description'];
                            $link = $value['link'];
                            $image = Template::showItemThumb($controllerName,$value['thumb'],$value['name']);
                            $status = Template::showItemStatus($controllerName, $value['status'], $value['id']);
                            $createdHistory = Template::showItemHistory($value['created_by'], $value['created']);
                            $modifiedHistory = Template::showItemHistory($value['modified_by'], $value['modified']);
                            $listBtnAction   =   Template::showButtonAction($controllerName, $value['id']);
                        @endphp
                        <tr class="{{$class}} pointer">
                            <td class="">{{ $index }}</td>
                            <td width="40%">
                                <p><strong>Name: </strong>{{ $name }}</p>
                                <p><strong>Description: </strong>{{ $description }}</p>
                                <p><strong>Link: </strong> {{ $link }}</p>
                                <p> {!! $image !!}</p>
                            </td>


                            <td>{!! $status !!}
                            </td>

                            <td>
                                {!! $createdHistory !!}
                            </td>
                            <td>
                                {!! $modifiedHistory !!}
                            </td>
                            <td class="last">
                                {!! $listBtnAction !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
