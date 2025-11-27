@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Liste des Portfolios</h2>

    <a href="{{ route('portfolio.create') }}" class="btn btn-primary mb-3">Ajouter</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom complet</th>
                <th>Titre du projet</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($portfolios as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->fullName }}</td>
                <td>{{ $p->project_title }}</td>
                <td>
                    @if($p->image_url)
                        <img src="{{ asset('storage/'.$p->image_url) }}" width="70">
                    @endif
                </td>
                <td>
                    <a href="{{ route('portfolio.show', $p->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('portfolio.edit', $p->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('portfolio.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
