<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Scores - Reflex Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Gestion des Scores</h1>
                <p class="text-gray-600 mt-2">Administration de tous les scores du jeu</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('games.play') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-gamepad mr-2"></i>Jouer
                </a>
                <a href="{{ route('games.scores') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                    <i class="fas fa-trophy mr-2"></i>Classement Public
                </a>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $games->count() }}</div>
                <div class="text-gray-600">Scores totaux</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $games->where('difficulty', 'easy')->count() }}</div>
                <div class="text-gray-600">Facile</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $games->where('difficulty', 'medium')->count() }}</div>
                <div class="text-gray-600">Moyen</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-red-600 mb-2">{{ $games->where('difficulty', 'hard')->count() }}</div>
                <div class="text-gray-600">Difficile</div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joueur</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Difficulté</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cibles</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($games as $game)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $game->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $game->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-blue-600">{{ number_format($game->score) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    @if($game->difficulty == 'easy') bg-green-100 text-green-800
                                    @elseif($game->difficulty == 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($game->difficulty) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $game->targets_hit }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $game->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('games.show', $game->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('games.edit', $game->id) }}" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce score ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-trophy text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg">Aucun score enregistré</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($games->hasPages())
        <div class="mt-6">
            {{ $games->links() }}
        </div>
        @endif
    </div>
</body>
</html>
