@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Détails du Portfolio</h2>

    <div class="card">
        <div class="card-body">
            <h3>{{ $portfolio->project_title }}</h3>

            <p><strong>Auteur : </strong>{{ $portfolio->fullName }}</p>

            <p>{{ $portfolio->description }}</p>

            <p><strong>Tags :</strong> 
                @if($portfolio->tags)
                    {{ implode(', ', json_decode($portfolio->tags, true)) }}
                @endif
            </p>

            <p><strong>Lien source : </strong>
                <a href="{{ $portfolio->source_link }}" target="_blank">
                    {{ $portfolio->source_link }}
                </a>
            </p>

            @if($portfolio->image_url)
            <img src="{{ asset('storage/' . $portfolio->image_url) }}" width="250">
            @endif

            <br><br>

            <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
