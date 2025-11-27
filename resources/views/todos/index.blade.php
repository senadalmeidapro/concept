<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Mes Tâches</h2>
                    </div>

                    <!-- Messages de succès -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <!-- Formulaire d'ajout -->
                        <form action="{{ route('todos.store') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="text" class="form-control @error('text') is-invalid @enderror" 
                                       placeholder="Ajouter une nouvelle tâche..." value="{{ old('text') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajouter
                                </button>
                            </div>
                            @error('text')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </form>

                        <!-- Liste des tâches -->
                        @if($todos->count() > 0)
                            <div class="list-group">
                                @foreach($todos as $todo)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <!-- Toggle completion -->
                                            <form action="{{ route('todos.toggle', $todo->id) }}" method="POST" class="me-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-{{ $todo->completed ? 'success' : 'secondary' }}">
                                                    <i class="fas fa-{{ $todo->completed ? 'check' : 'times' }}"></i>
                                                </button>
                                            </form>
                                            
                                            <!-- Texte de la tâche -->
                                            <span class="{{ $todo->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                                {{ $todo->text }}
                                            </span>
                                        </div>
                                        
                                        <!-- Actions -->
                                        <div class="btn-group">
                                            <!-- Lien show -->
                                            <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <!-- Lien edit -->
                                            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <!-- Formulaire de suppression -->
                                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                                <p>Aucune tâche pour le moment. Ajoutez votre première tâche !</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Statistiques -->
                    @if($todos->count() > 0)
                        <div class="card-footer text-muted">
                            <small>
                                Total: {{ $todos->count() }} | 
                                Complétées: {{ $todos->where('completed', true)->count() }} | 
                                En attente: {{ $todos->where('completed', false)->count() }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
