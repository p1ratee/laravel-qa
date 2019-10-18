@if (session('success'))
<div class="alert alert-success alert-dismissable fade show" role="alert">
    <strong>Success!</strong> {{ session('success') }}
    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif