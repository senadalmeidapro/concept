@extends('layout')

@section('title', 'Gestion des Portfolios')

@section('content')
<div class="container">
    <div class="page-header">
        <h2><i class="fas fa-th-large me-2"></i>Gestion des Portfolios</h2>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('portfolio.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Ajouter un Projet
        </a>
        <a href="{{ route('portfolio.home') }}" class="btn btn-outline-primary">
            <i class="fas fa-eye me-2"></i>Voir le Site Public
        </a>
    </div>

    @if($portfolioItems->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                        @foreach($portfolioItems as $portfolio)
                        <tr>
                            <td>{{ $portfolio->id }}</td>
                            <td>{{ $portfolio->fullname }}</td>
                            <td>{{ $portfolio->title }}</td>
                            <td>
                                @if($portfolio->image_url)
                                    <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="portfolio-image" width="60" height="60" style="object-fit: cover;">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('portfolio.home') }}#project-{{ $portfolio->id }}" class="btn btn-info btn-sm" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Aucun projet trouvé</h4>
            <p class="text-muted">Commencez par ajouter votre premier projet.</p>
            <a href="{{ route('portfolio.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un Projet
            </a>
        </div>
    </div>
    @endif
</div>
@endsection