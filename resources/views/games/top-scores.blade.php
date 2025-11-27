<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Scores - Reflex Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .podium-item {
            transition: all 0.3s ease;
        }
        .podium-item:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">
    <!-- Header -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-bolt text-2xl text-blue-600"></i>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-pink-600 bg-clip-text text-transparent">
                        Top Scores
                    </h1>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('games.play') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-gamepad mr-2"></i>Jouer
                    </a>
                    <a href="{{ route('games.scores') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-list mr-2"></i>Tous les Scores
                    </a>
                    <a href="/" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">🏆 Classement d'Élite</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez les meilleurs joueurs qui dominent le classement de Reflex Master
            </p>
        </div>

        <!-- Podium -->
        @if($topScores->count() >= 3)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 items-end">
            <!-- 2ème place -->
            <div class="podium-item text-center order-2 md:order-1">
                <div class="bg-gray-200 rounded-t-xl p-6 relative" style="height: 180px;">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        2
                    </div>
                    <div class="mt-8">
                        <div class="text-2xl font-bold text-gray-700 mb-2">{{ $topScores[1]->name }}</div>
                        <div class="text-3xl font-bold text-gray-600">{{ number_format($topScores[1]->score) }}</div>
                        <div class="text-sm text-gray-500 mt-2">{{ $topScores[1]->targets_hit }} cibles</div>
                    </div>
                </div>
                <div class="bg-gray-400 text-white py-3 rounded-b-xl">
                    <span class="capitalize">{{ $topScores[1]->difficulty }}</span>
                </div>
            </div>

            <!-- 1ère place -->
            <div class="podium-item text-center order-1 md:order-2">
                <div class="bg-yellow-200 rounded-t-xl p-6 relative" style="height: 220px;">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="mt-12">
                        <div class="text-3xl font-bold text-gray-800 mb-2">{{ $topScores[0]->name }}</div>
                        <div class="text-4xl font-bold text-yellow-600">{{ number_format($topScores[0]->score) }}</div>
                        <div class="text-sm text-gray-600 mt-2">{{ $topScores[0]->targets_hit }} cibles</div>
                    </div>
                </div>
                <div class="bg-yellow-500 text-white py-4 rounded-b-xl font-semibold">
                    <span class="capitalize">{{ $topScores[0]->difficulty }}</span>
                </div>
            </div>

            <!-- 3ème place -->
            <div class="podium-item text-center order-3">
                <div class="bg-orange-200 rounded-t-xl p-6 relative" style="height: 160px;">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        3
                    </div>
                    <div class="mt-6">
                        <div class="text-xl font-bold text-gray-700 mb-2">{{ $topScores[2]->name }}</div>
                        <div class="text-2xl font-bold text-orange-600">{{ number_format($topScores[2]->score) }}</div>
                        <div class="text-sm text-gray-500 mt-2">{{ $topScores[2]->targets_hit }} cibles</div>
                    </div>
                </div>
                <div class="bg-orange-500 text-white py-3 rounded-b-xl">
                    <span class="capitalize">{{ $topScores[2]->difficulty }}</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Top 10 -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-8 text-white">
                <h2 class="text-3xl font-bold flex items-center">
                    <i class="fas fa-trophy mr-4"></i>
                    Top 10 des Meilleurs Scores
                </h2>
                <p class="text-blue-100 mt-2">Les joueurs les plus performants du jeu</p>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    @forelse($topScores as $index => $score)
                    <div class="flex items-center justify-between p-6 bg-gray-50 rounded-xl hover:bg-white hover:shadow-md transition-all duration-300 border border-gray-200">
                        <div class="flex items-center space-x-6">
                            <!-- Rang -->
                            <div class="flex items-center justify-center w-12 h-12 rounded-full 
                                @if($index == 0) bg-yellow-100 text-yellow-600 border-2 border-yellow-400
                                @elseif($index == 1) bg-gray-100 text-gray-600 border-2 border-gray-400
                                @elseif($index == 2) bg-orange-100 text-orange-600 border-2 border-orange-400
                                @else bg-blue-100 text-blue-600 border-2 border-blue-400 @endif
                                font-bold text-lg">
                                @if($index == 0)
                                    <i class="fas fa-crown"></i>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </div>

                            <!-- Informations joueur -->
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    {{ strtoupper(substr($score->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-800">{{ $score->name }}</div>
                                    <div class="flex items-center space-x-4 mt-1">
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
                                        <span class="text-gray-500 text-sm">
                                            <i class="fas fa-bullseye mr-1"></i>{{ $score->targets_hit }} cibles
                                        </span>
                                        <span class="text-gray-500 text-sm">
                                            <i class="fas fa-clock mr-1"></i>{{ $score->time_left }}s restantes
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Score -->
                        <div class="text-right">
                            <div class="text-4xl font-bold text-blue-600 mb-1">{{ number_format($score->score) }}</div>
                            <div class="text-gray-500 text-sm">points</div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <i class="fas fa-trophy text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-500 mb-2">Aucun score enregistré</h3>
                        <p class="text-gray-400 mb-6">Soyez le premier à marquer des points !</p>
                        <a href="{{ route('games.play') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                            <i class="fas fa-gamepad mr-2"></i>Jouer Maintenant
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        @if($topScores->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ number_format($topScores->max('score')) }}</div>
                <div class="text-gray-600">Meilleur score absolu</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ number_format($topScores->avg('score'), 0) }}</div>
                <div class="text-gray-600">Score moyen du top 10</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                @php
                    $mostCommonDifficulty = $topScores->groupBy('difficulty')->sortByDesc->count()->keys()->first();
                @endphp
                <div class="text-3xl font-bold text-purple-600 mb-2 capitalize">{{ $mostCommonDifficulty }}</div>
                <div class="text-gray-600">Difficulté la plus populaire</div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-12">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white">
                <h3 class="text-2xl font-bold mb-4">Relevez le défi !</h3>
                <p class="text-blue-100 mb-6 text-lg">Pensez-vous pouvoir battre les meilleurs scores ?</p>
                <a href="{{ route('games.play') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition transform hover:scale-105">
                    <i class="fas fa-gamepad mr-2"></i>Jouer et Tenter Votre Chance
                </a>
            </div>
        </div>
        @endif

        <!-- Difficulté Legend -->
        <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                Légende des Difficultés
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                    <i class="fas fa-leaf text-green-600 text-xl"></i>
                    <div>
                        <div class="font-semibold text-green-800">Facile</div>
                        <div class="text-green-600 text-sm">Cibles larges, temps généreux</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-lg">
                    <i class="fas fa-balance-scale text-yellow-600 text-xl"></i>
                    <div>
                        <div class="font-semibold text-yellow-800">Moyen</div>
                        <div class="text-yellow-600 text-sm">Équilibre défi/récompense</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-red-50 rounded-lg">
                    <i class="fas fa-fire text-red-600 text-xl"></i>
                    <div>
                        <div class="font-semibold text-red-800">Difficile</div>
                        <div class="text-red-600 text-sm">Pour les vrais experts</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="text-center">
                <p class="text-gray-400">
                    Reflex Master - Développé avec <i class="fas fa-heart text-red-500 mx-1"></i> 
                    pour les amateurs de défis
                </p>
                <div class="flex justify-center space-x-6 mt-4">
                    <a href="{{ route('games.play') }}" class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-gamepad"></i> Jouer
                    </a>
                    <a href="{{ route('games.scores') }}" class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-list"></i> Tous les Scores
                    </a>
                    <a href="{{ route('games.top-scores') }}" class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-trophy"></i> Top Scores
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Animation pour les éléments du podium
        document.addEventListener('DOMContentLoaded', function() {
            const podiumItems = document.querySelectorAll('.podium-item');
            
            podiumItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.2}s`;
                item.classList.add('animate-fade-in-up');
            });
        });
    </script>
</body>
</html>
