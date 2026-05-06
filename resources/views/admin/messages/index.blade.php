@extends('admin.layout', ['title' => 'Messages'])

@section('content')
<h1>Messages de contact</h1>
<table class="table table-dark table-striped">
<tr><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th></tr>
@foreach($messages as $message)
<tr><td>{{ $message->name }}</td><td>{{ $message->email }}</td><td>{{ $message->subject }}</td><td>{{ $message->message }}</td></tr>
@endforeach
</table>
{{ $messages->links() }}
@endsection
