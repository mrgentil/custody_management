@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Conversations
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#composeModal">
                            Écrire un message
                        </button>
                    </div>

                    <div class="card-body">
                        @if(count($conversations) > 0)
                            <ul class="list-group">
                                @foreach($conversations as $conversation)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('messages.show', ['userId' => $conversation->otherUser->id]) }}">
                                            {{ $conversation->otherUser->name }}
                                        </a>
                                        @if ($conversation->unread_count > 0)
                                            <span class="badge bg-secondary">{{ $conversation->unread_count }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucune conversation disponible. <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#composeModal">Écrire un message</button></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour écrire un message -->
    <div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="composeModalLabel">Écrire un message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire pour écrire un message -->
                    <form method="post" action="{{ route('messages.send') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient_id" class="form-label">Destinataire</label>
                            <select name="recipient_id" class="form-select" required>
                                @foreach($allUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message_content" class="form-label">Message</label>
                            <textarea name="content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
