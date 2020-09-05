@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger mr-2 ml-2">{{ $error }}</div>
    @endforeach
@endif
