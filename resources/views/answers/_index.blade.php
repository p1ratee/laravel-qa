<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include ('layouts._messages')

                @foreach ($answers as $answer)
                <div class="media">
                    <div class="d-fex flex-column vote-controls">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form method="POST" action="/answers/{{ $answer->id }}/vote"
                                id="up-vote-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a title="I dont like this answer" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit()">
                                <i class="fas fa-caret-down fa-2x"></i>
                            </a>
                            <form method="POST" action="/questions/{{ $answer->id }}/vote"
                                id="down-vote-question-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            <a title="Click to mark as favorite (Click again to undo)"
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited) ? 'favorited' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
                            <form method="POST" action="/questions/{{ $question->id }}/favorites"
                                id="favorite-question-{{ $question->id }}">
                                @if ($question->is_favorited)
                                @method("DELETE")
                                @endif
                                @csrf
                            </form>
                    </div>
                    </div>
                    <div class="media-body">
                        {!! $answer->body_html !!}
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can ('update', $answer)
                                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                        class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can ('delete', $answer)
                                    <form class="form-delete" method="post"
                                        action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                @include('shared._author', [
                                'model' => $answer,
                                'label' => 'answered'
                                ])
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>