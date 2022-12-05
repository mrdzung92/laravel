<div class="x_title">
    <h2>Danh sách</h2>
    <ul class="nav navbar-right panel_toolbox">
        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
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
                        <tr class="even pointer">
                            <td class="">1</td>
                            <td width="40%">
                                <p><strong>Name: </strong> khoa hoc zend php</p>
                                <p><strong>Description: </strong> khoa hoc zend php</p>
                                <p><strong>Link: </strong> khoa hoc zend php</p>
                                <p><img src="{{ asset('backend/img/img.jpg') }}" alt="admin" class="zvn-thumb"></p>
                            </td>


                            <td><a href="/change-status-active/1" type="button"
                                    class="btn btn-round btn-success">Active</a>
                            </td>

                            <td>
                                <p><i class="fa fa-user"></i> admin</p>
                                <p><i class="fa fa-clock-o"></i> 10/12/2014</p>
                            </td>
                            <td>
                                <p><i class="fa fa-user"></i> hailan</p>
                                <p><i class="fa fa-clock-o"></i> 10/12/2014</p>
                            </td>
                            <td class="last">
                                <div class="zvn-box-btn-filter"><a href="/form/1" type="button"
                                        class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a><a href="/delete/1" type="button" class="btn btn-icon btn-danger btn-delete"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
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
