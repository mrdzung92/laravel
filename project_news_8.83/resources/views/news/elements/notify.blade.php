@if (session($content))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <h4 class="alert-heading">Có lỗi!</h4>
    <p>{{ session($content) }}</p>
    
  </div>
  @endif