@extends('layout')

@section('title', $portfolio->title)

@section('content')
<div class="container">
    <div class="page-header">
        <h2>Détails du Projet</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                @if($portfolio->image_url)
                <div class="col-md-4">
                    <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="img-fluid rounded">
                </div>
                @endif
                <div class="@if($portfolio->image_url) col-md-8 @else col-12 @endif">
                    <h3 class="fw-bold">{{ $portfolio->title }}</h3>
                    
                    <div class="mb-4">
                        <p class="text-muted mb-1">
                            <i class="fas fa-user me-2"></i>
                            <strong>Auteur :</strong> {{ $portfolio->fullname }}
                        </p>
                        
                        @if($portfolio->tags)
                        <p class="mb-1">
                            <i class="fas fa-tags me-2"></i>
                            <strong>Tags :</strong> 
                            @foreach(explode(',', $portfolio->tags) as $tag)
                            <span class="badge bg-secondary me-1">{{ trim($tag) }}</span>
                            @endforeach
                        </p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <p class="text-justify">{{ $portfolio->description }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Liens</h5>
                        <div class="d-flex gap-2 flex-wrap">
                            @if($portfolio->project_link)
                            <a href="{{ $portfolio->project_link }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-external-link-alt me-2"></i>Voir le projet
                            </a>
                            @endif
                            @if($portfolio->source_link)
                            <a href="{{ $portfolio->source_link }}" target="_blank" class="btn btn-outline-secondary">
                                <i class="fab fa-github me-2"></i>Code source
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-4 border-top">
                <a href="{{ route('portfolio.home') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux projets
                </a>
                <a href="{{ route('portfolio.index') }}" class="btn btn-outline-primary ms-2">
                    <i class="fas fa-cog me-2"></i>Administration
                </a>
            </div>
        </div>
    </div>
</div>
@endsection