<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Détails de la Tâche</h4>
                        <span class="badge bg-{{ $todo->completed ? 'success' : 'warning' }}">
                            {{ $todo->completed ? 'Complétée' : 'En attente' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="text-muted">Description :</h5>
                            <p class="lead {{ $todo->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $todo->text }}
                            </p>
                        </div>
                        
                        <div class="row text-muted">
                            <div class="col-6">
                                <small><strong>Créée le :</strong></small><br>
                                <small>{{ $todo->created_at->format('d/m/Y à H:i') }}</small>
                            </div>
                            <div class="col-6">
                                <small><strong>Modifiée le :</strong></small><br>
                                <small>{{ $todo->updated_at->format('d/m/Y à H:i') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('todos.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning me-md-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
