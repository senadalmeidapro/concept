@extends('layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mes Portfolios</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('portfolio.create') }}" class="btn btn-primary mb-3">Ajouter un nouveau Portfolio</a>

    @if($portfolios->count() > 0)
        <div class="row">
            @foreach($portfolios as $portfolio)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($portfolio->image_url)
                            <img src="{{ asset('storage/'.$portfolio->image_url) }}" class="card-img-top" alt="{{ $portfolio->project_title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $portfolio->project_title }}</h5>
                            <p class="card-text">{{ Str::limit($portfolio->description, 100) }}</p>
                            <p><strong>Nom :</strong> {{ $portfolio->fullName }}</p>
                            <p><strong>Tags :</strong> {{ $portfolio->tags }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('portfolio.show', $portfolio->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Aucun portfolio trouvé.</p>
    @endif
</div>
@endsection
