@extends('layout')

@section('title', 'Mes Projets')

@section('content')
<div class="container">
    <div class="page-header text-center">
        <h1 class="display-4 fw-bold">Mes Projets</h1>
        <p class="lead">Découvrez mes réalisations et compétences</p>
    </div>

    @if($portfolioItems->count() > 0)
    <div class="row">
        @foreach($portfolioItems as $portfolio)
        <div class="col-lg-4 col-md-6 mb-4" id="project-{{ $portfolio->id }}">
            <div class="card h-100">
                @if($portfolio->image_url)
                <img src="{{ $portfolio->image_url }}" class="card-img-top" alt="{{ $portfolio->title }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold">{{ $portfolio->title }}</h5>
                    <p class="card-text flex-grow-1">{{ Str::limit($portfolio->description, 120) }}</p>
                    
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="fas fa-user me-1"></i>{{ $portfolio->fullname }}
                        </small>
                    </div>

                    @if($portfolio->tags)
                    <div class="mb-3">
                        @foreach(explode(',', $portfolio->tags) as $tag)
                        <span class="badge bg-primary me-1">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                    @endif

                    <div class="mt-auto">
                        <div class="d-grid gap-2">
                            @if($portfolio->project_link)
                            <a href="{{ $portfolio->project_link }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i>Voir le projet
                            </a>
                            @endif
                            @if($portfolio->source_link)
                            <a href="{{ $portfolio->source_link }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="fab fa-github me-1"></i>Code source
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Aucun projet disponible</h4>
            <p class="text-muted">Les projets seront bientôt publiés.</p>
        </div>
    </div>
    @endif
</div>
@endsection