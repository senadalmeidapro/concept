<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Score - Reflex Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-md mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-6">
                <i class="fas fa-trophy text-4xl text-yellow-500 mb-4"></i>
                <h1 class="text-2xl font-bold text-gray-800">Enregistrer un Score</h1>
                <p class="text-gray-600 mt-2">Ajoutez manuellement un score au classement</p>
            </div>

            <form action="{{ route('games.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du joueur</label>
                        <input type="text" name="name" id="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Entrez le nom du joueur">
                    </div>

                    <div>
                        <label for="score" class="block text-sm font-medium text-gray-700 mb-2">Score</label>
                        <input type="number" name="score" id="score" required min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Points obtenus">
                    </div>

                    <div>
                        <label for="targets_hit" class="block text-sm font-medium text-gray-700 mb-2">Cibles touchées</label>
                        <input type="number" name="targets_hit" id="targets_hit" required min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nombre de cibles">
                    </div>

                    <div>
                        <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-2">Difficulté</label>
                        <select name="difficulty" id="difficulty" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="easy">Facile</option>
                            <option value="medium">Moyen</option>
                            <option value="hard">Difficile</option>
                        </select>
                    </div>

                    <div>
                        <label for="time_left" class="block text-sm font-medium text-gray-700 mb-2">Temps restant</label>
                        <input type="number" name="time_left" id="time_left" required min="0" max="60"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Secondes restantes">
                    </div>
                </div>

                <div class="flex space-x-4 mt-6">
                    <a href="{{ route('games.scores') }}" class="flex-1 bg-gray-500 text-white py-3 rounded-lg font-semibold text-center hover:bg-gray-600 transition">
                        Annuler
                    </a>
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
