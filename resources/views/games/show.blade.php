<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du Score - Reflex Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-8 text-white text-center">
                <i class="fas fa-trophy text-5xl mb-4"></i>
                <h1 class="text-3xl font-bold mb-2">Détail du Score</h1>
                <p class="text-blue-100">Performance de jeu détaillée</p>
            </div>

            <!-- Contenu -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="text-center">
                        <div class="text-5xl font-bold text-blue-600 mb-2">{{ number_format($game->score) }}</div>
                        <div class="text-gray-600">Points totaux</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold text-green-600 mb-2">{{ $game->targets_hit }}</div>
                        <div class="text-gray-600">Cibles touchées</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Joueur:</span>
                        <span class="text-lg text-gray-900">{{ $game->name }}</span>
                    </div>

                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Difficulté:</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                            @if($game->difficulty == 'easy') bg-green-100 text-green-800
                            @elseif($game->difficulty == 'medium') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            @if($game->difficulty == 'easy')
                                <i class="fas fa-leaf mr-1"></i>Facile
                            @elseif($game->difficulty == 'medium')
                                <i class="fas fa-balance-scale mr-1"></i>Moyen
                            @else
                                <i class="fas fa-fire mr-1"></i>Difficile
                            @endif
                        </span>
                    </div>

                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Temps restant:</span>
                        <span class="text-lg text-gray-900">{{ $game->time_left }} secondes</span>
                    </div>

                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Date:</span>
                        <span class="text-lg text-gray-900">{{ $game->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('games.scores') }}" class="flex-1 bg-gray-500 text-white py-3 rounded-lg font-semibold text-center hover:bg-gray-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                    <a href="{{ route('games.edit', $game->id) }}" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold text-center hover:bg-blue-700 transition">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
