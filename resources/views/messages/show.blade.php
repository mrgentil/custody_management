@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Conversation avec {{ $otherUser->name }}</h2>

                <ul class="list-group">
                    @foreach($messages as $message)
                        <li class="list-group-item">
                            <strong>{{ $message->sender->name }}:</strong> {{ $message->content }}
                        </li>
                    @endforeach
                </ul>

                <!-- Formulaire pour répondre au message -->
                <form method="post" action="{{ route('messages.send') }}">
                    @csrf
                    <input type="hidden" name="recipient_id" value="{{ $otherUser->id }}">
                    <div class="mb-3">
                        <label for="message_content" class="form-label">Répondre au message</label>
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
                </form>
            </div>
        </div>
    </div>

@endsection
