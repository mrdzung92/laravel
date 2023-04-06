@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade in zvn-alert  " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong><i class="fa fa-exclamation-triangle"></i> Xảy ra lỗi!</strong>
        @foreach ($errors->all() as $error)
            <p>{!! $error !!}</p>
        @endforeach
        </ul>
    </div>
@endif
