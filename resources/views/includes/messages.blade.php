@if($errors->any())
<div class="container">
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
@endif

@if(isset($success) || session()->has('success'))
<div class="container">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    @if(isset($success))
    {{ $success }}
    @else
    {{ session()->get('success') }}
    @endif

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
@endif
