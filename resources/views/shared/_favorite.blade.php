<form method="POST" action="/questions/{{ $model->id }}/favorites" id="favorite-question-{{ $model->id }}">
    @if ($model->is_favorited)
    @method("DELETE")
    @endif
    @csrf
</form>