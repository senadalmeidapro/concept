<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement - Reflex Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-bolt text-2xl text-blue-600"></i>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-pink-600 bg-clip-text text-transparent">
                        Classement
                    </h1>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('games.play') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-gamepad mr-2"></i>Jouer
                    </a>
                    <a href="/" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Classement des Scores</h2>
            <p class="text-gray-600 text-lg">Découvrez les meilleurs joueurs de Reflex Master</p>
        </div>

        <!-- Filtres -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex flex-wrap gap-4 justify-center">
                <button class="filter-btn bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold transition" data-filter="all">
                    Tous
                </button>
                <button class="filter-btn bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition" data-filter="easy">
                    Facile
                </button>
                <button class="filter-btn bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold transition" data-filter="medium">
                    Moyen
                </button>
                <button class="filter-btn bg-red-600 text-white px-6 py-2 rounded-lg font-semibold transition" data-filter="hard">
                    Difficile
                </button>
            </div>
        </div>

        <!-- Tableau des scores -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rang</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joueur</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Difficulté</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cibles</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($scores as $index => $score)
                        <tr class="score-row hover:bg-gray-50 transition" data-difficulty="{{ $score->difficulty }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($index == 0)
                                        <i class="fas fa-trophy text-yellow-500 text-xl mr-3"></i>
                                    @elseif($index == 1)
                                        <i class="fas fa-trophy text-gray-400 text-xl mr-3"></i>
                                    @elseif($index == 2)
                                        <i class="fas fa-trophy text-orange-800 text-xl mr-3"></i>
                                    @else
                                        <span class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-sm font-bold text-gray-700 mr-3">
                                            {{ $index + 1 }}
                                        </span>
                                    @endif
                                    <span class="text-lg font-bold text-gray-900">{{ $index + 1 }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $score->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-bold text-blue-600">{{ number_format($score->score) }} pts</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    @if($score->difficulty == 'easy') bg-green-100 text-green-800
                                    @elseif($score->difficulty == 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    @if($score->difficulty == 'easy')
                                        <i class="fas fa-leaf mr-1"></i>
                                    @elseif($score->difficulty == 'medium')
                                        <i class="fas fa-balance-scale mr-1"></i>
                                    @else
                                        <i class="fas fa-fire mr-1"></i>
                                    @endif
                                    {{ ucfirst($score->difficulty) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $score->targets_hit }} cibles
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $score->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-trophy text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg">Aucun score enregistré pour le moment</p>
                                <a href="{{ route('games.play') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Soyez le premier à jouer !
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Statistiques -->
        @if($scores->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $scores->count() }}</div>
                <div class="text-gray-600">Parties jouées</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ number_format($scores->max('score')) }}</div>
                <div class="text-gray-600">Meilleur score</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ number_format($scores->avg('score'), 0) }}</div>
                <div class="text-gray-600">Score moyen</div>
            </div>
        </div>
        @endif
    </div>

    <script>
        // Filtrage des scores par difficulté
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.dataset.filter;
                
                // Mettre à jour les boutons actifs
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('ring-2', 'ring-offset-2', 'ring-blue-500');
                });
                this.classList.add('ring-2', 'ring-offset-2', 'ring-blue-500');
                
                // Filtrer les lignes
                document.querySelectorAll('.score-row').forEach(row => {
                    if (filter === 'all' || row.dataset.difficulty === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Activer le filtre "Tous" par défaut
        document.querySelector('[data-filter="all"]').click();
    </script>
</body>
</html>
