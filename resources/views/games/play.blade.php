<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reflex Master - Jeu de Réflexe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #4cc9f0;
            --accent: #f72585;
            --success: #4ade80;
            --warning: #f59e0b;
            --error: #ef4444;
        }

        .target {
            position: absolute;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            transition: transform 0.2s ease, opacity 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .target.hit {
            animation: hitAnimation 0.5s forwards;
        }

        @keyframes hitAnimation {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.5); opacity: 0.7; }
            100% { transform: scale(0); opacity: 0; }
        }

        .target.missed {
            animation: missAnimation 0.5s forwards;
        }

        @keyframes missAnimation {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0); opacity: 0; }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-bolt text-2xl text-blue-600"></i>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-pink-600 bg-clip-text text-transparent">
                        Reflex Master
                    </h1>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('games.scores') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-trophy mr-2"></i>Classement
                    </a>
                    <a href="/" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Game Container -->
    <div class="pt-20 pb-8">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-6 rounded-xl shadow-lg text-center border border-gray-200">
                    <div class="text-4xl font-bold text-blue-600 mb-2" id="score">0</div>
                    <div class="text-gray-600 uppercase text-sm tracking-wider">Score</div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center border border-gray-200">
                    <div class="text-4xl font-bold text-green-600 mb-2" id="timeLeft">60</div>
                    <div class="text-gray-600 uppercase text-sm tracking-wider">Temps</div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center border border-gray-200">
                    <div class="text-4xl font-bold text-purple-600 mb-2" id="targetsHit">0</div>
                    <div class="text-gray-600 uppercase text-sm tracking-wider">Cibles Touchées</div>
                </div>
            </div>

            <!-- Difficulty Selector -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Difficulté</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="difficulty-btn bg-green-100 border-2 border-green-400 text-green-800 py-3 rounded-lg text-center cursor-pointer font-medium transition active" data-difficulty="easy">
                        <i class="fas fa-leaf mr-2"></i>Facile
                    </div>
                    <div class="difficulty-btn bg-yellow-100 border-2 border-yellow-300 text-yellow-800 py-3 rounded-lg text-center cursor-pointer font-medium transition" data-difficulty="medium">
                        <i class="fas fa-balance-scale mr-2"></i>Moyen
                    </div>
                    <div class="difficulty-btn bg-red-100 border-2 border-red-400 text-red-800 py-3 rounded-lg text-center cursor-pointer font-medium transition" data-difficulty="hard">
                        <i class="fas fa-fire mr-2"></i>Difficile
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div id="progressBar" class="bg-gradient-to-r from-blue-600 to-pink-600 h-3 rounded-full transition-all duration-300" style="width: 100%"></div>
                </div>
            </div>

            <!-- Game Message -->
            <div id="gameMessage" class="hidden p-4 rounded-lg mb-6 text-center font-semibold"></div>

            <!-- Controls -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <button id="startBtn" class="bg-green-600 hover:bg-green-700 text-white py-4 px-6 rounded-lg font-semibold text-lg transition flex items-center justify-center">
                    <i class="fas fa-play mr-3"></i>Commencer
                </button>
                <button id="pauseBtn" disabled class="bg-yellow-500 hover:bg-yellow-600 text-white py-4 px-6 rounded-lg font-semibold text-lg transition flex items-center justify-center opacity-50 cursor-not-allowed">
                    <i class="fas fa-pause mr-3"></i>Pause
                </button>
                <button id="resetBtn" class="bg-gray-600 hover:bg-gray-700 text-white py-4 px-6 rounded-lg font-semibold text-lg transition flex items-center justify-center">
                    <i class="fas fa-redo mr-3"></i>Réinitialiser
                </button>
            </div>

            <!-- Game Area -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-dashed border-gray-300">
                <div id="gameArea" class="w-full h-96 bg-gradient-to-br from-blue-50 to-purple-50 relative">
                    <!-- Les cibles apparaîtront ici -->
                    <div class="absolute inset-0 flex items-center justify-center" id="startPrompt">
                        <div class="text-center">
                            <i class="fas fa-bolt text-6xl text-blue-600 mb-4"></i>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Prêt à jouer ?</h2>
                            <p class="text-gray-600">Cliquez sur "Commencer" pour lancer le jeu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-white p-6 rounded-xl shadow-lg mt-6 border-l-4 border-blue-600">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-blue-600"></i>Comment jouer
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-mouse-pointer text-blue-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800">Cliquez rapidement</h4>
                            <p class="text-gray-600 text-sm">Cliquez sur les cibles avant qu'elles ne disparaissent</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-bolt text-yellow-500 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800">Score élevé</h4>
                            <p class="text-gray-600 text-sm">Plus vous êtes rapide, plus vous gagnez de points</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-clock text-green-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800">60 secondes</h4>
                            <p class="text-gray-600 text-sm">Le jeu dure 60 secondes - soyez rapide !</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-trophy text-purple-600 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800">Difficulté</h4>
                            <p class="text-gray-600 text-sm">Les cibles plus petites rapportent plus de points</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Scores -->
            @if($topScores->count() > 0)
            <div class="bg-white p-6 rounded-xl shadow-lg mt-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-trophy mr-3 text-yellow-500"></i>Meilleurs Scores
                </h3>
                <div class="space-y-3">
                    @foreach($topScores as $index => $score)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">{{ $score->name }}</div>
                                <div class="text-sm text-gray-500 capitalize">{{ $score->difficulty }}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-blue-600 text-lg">{{ $score->score }} pts</div>
                            <div class="text-sm text-gray-500">{{ $score->targets_hit }} cibles</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Score Submission Modal -->
    <div id="scoreModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Partie Terminée !</h2>
            <p class="text-gray-600 mb-6">Votre score: <span id="finalScore" class="font-bold text-blue-600"></span></p>
            
            <form id="scoreForm" action="{{ route('games.store') }}" method="POST">
                @csrf
                <input type="hidden" name="score" id="formScore">
                <input type="hidden" name="targets_hit" id="formTargetsHit">
                <input type="hidden" name="difficulty" id="formDifficulty">
                <input type="hidden" name="time_left" id="formTimeLeft">
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Votre nom</label>
                    <input type="text" name="name" id="name" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Entrez votre nom" maxlength="100">
                </div>
                
                <div class="flex space-x-4">
                    <button type="button" id="cancelScore" class="flex-1 bg-gray-500 text-white py-3 rounded-lg font-semibold hover:bg-gray-600 transition">
                        Annuler
                    </button>
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // État du jeu
        let gameState = {
            score: 0,
            timeLeft: 60,
            targetsHit: 0,
            isPlaying: false,
            isPaused: false,
            gameTimer: null,
            targetTimer: null,
            difficulty: 'easy'
        };

        // Paramètres de difficulté
        const difficultySettings = {
            easy: { targetSize: 70, targetLifetime: 2000, spawnInterval: 1000, points: 10 },
            medium: { targetSize: 50, targetLifetime: 1500, spawnInterval: 800, points: 15 },
            hard: { targetSize: 35, targetLifetime: 1000, spawnInterval: 600, points: 20 }
        };

        // Éléments DOM
        const gameArea = document.getElementById('gameArea');
        const startPrompt = document.getElementById('startPrompt');
        const scoreEl = document.getElementById('score');
        const timeLeftEl = document.getElementById('timeLeft');
        const targetsHitEl = document.getElementById('targetsHit');
        const progressBar = document.getElementById('progressBar');
        const gameMessage = document.getElementById('gameMessage');
        const startBtn = document.getElementById('startBtn');
        const pauseBtn = document.getElementById('pauseBtn');
        const resetBtn = document.getElementById('resetBtn');
        const difficultyBtns = document.querySelectorAll('.difficulty-btn');
        const scoreModal = document.getElementById('scoreModal');
        const finalScoreEl = document.getElementById('finalScore');
        const scoreForm = document.getElementById('scoreForm');

        // Initialisation
        function init() {
            updateDisplay();
            setupEventListeners();
        }

        function setupEventListeners() {
            startBtn.addEventListener('click', startGame);
            pauseBtn.addEventListener('click', togglePause);
            resetBtn.addEventListener('click', resetGame);
            
            difficultyBtns.forEach(btn => {
                btn.addEventListener('click', () => changeDifficulty(btn.dataset.difficulty));
            });

            document.getElementById('cancelScore').addEventListener('click', () => {
                scoreModal.classList.add('hidden');
            });

            // Empêcher la soumission du formulaire par défaut
            scoreForm.addEventListener('submit', function(e) {
                e.preventDefault();
                this.submit();
            });
        }

        function updateDisplay() {
            scoreEl.textContent = gameState.score;
            timeLeftEl.textContent = gameState.timeLeft;
            targetsHitEl.textContent = gameState.targetsHit;
            progressBar.style.width = `${(gameState.timeLeft / 60) * 100}%`;
        }

        function startGame() {
            if (gameState.isPlaying) return;
            
            gameState.isPlaying = true;
            gameState.isPaused = false;
            gameState.score = 0;
            gameState.timeLeft = 60;
            gameState.targetsHit = 0;
            
            startBtn.disabled = true;
            pauseBtn.disabled = false;
            startPrompt.style.display = 'none';
            
            updateDisplay();
            showMessage('Le jeu commence !', 'bg-green-100 text-green-800 border-green-300');
            
            gameState.gameTimer = setInterval(() => {
                if (!gameState.isPaused) {
                    gameState.timeLeft--;
                    updateDisplay();
                    
                    if (gameState.timeLeft <= 0) {
                        endGame();
                    }
                }
            }, 1000);
            
            spawnTarget();
        }

        function togglePause() {
            gameState.isPaused = !gameState.isPaused;
            
            if (gameState.isPaused) {
                pauseBtn.innerHTML = '<i class="fas fa-play mr-3"></i>Reprendre';
                showMessage('Jeu en pause', 'bg-yellow-100 text-yellow-800 border-yellow-300');
            } else {
                pauseBtn.innerHTML = '<i class="fas fa-pause mr-3"></i>Pause';
                showMessage('Jeu repris', 'bg-green-100 text-green-800 border-green-300');
            }
        }

        function resetGame() {
            clearInterval(gameState.gameTimer);
            clearTimeout(gameState.targetTimer);
            
            gameState.isPlaying = false;
            gameState.isPaused = false;
            gameState.score = 0;
            gameState.timeLeft = 60;
            gameState.targetsHit = 0;
            
            startBtn.disabled = false;
            pauseBtn.disabled = true;
            pauseBtn.innerHTML = '<i class="fas fa-pause mr-3"></i>Pause';
            startPrompt.style.display = 'flex';
            
            document.querySelectorAll('.target').forEach(target => target.remove());
            updateDisplay();
            hideMessage();
        }

        function endGame() {
            clearInterval(gameState.gameTimer);
            clearTimeout(gameState.targetTimer);
            
            gameState.isPlaying = false;
            gameState.isPaused = false;
            
            startBtn.disabled = false;
            pauseBtn.disabled = true;
            
            document.querySelectorAll('.target').forEach(target => target.remove());
            
            // Afficher le modal de score
            finalScoreEl.textContent = gameState.score;
            document.getElementById('formScore').value = gameState.score;
            document.getElementById('formTargetsHit').value = gameState.targetsHit;
            document.getElementById('formDifficulty').value = gameState.difficulty;
            document.getElementById('formTimeLeft').value = gameState.timeLeft;
            
            scoreModal.classList.remove('hidden');
        }

        function spawnTarget() {
            if (!gameState.isPlaying || gameState.isPaused) return;
            
            const settings = difficultySettings[gameState.difficulty];
            const targetSize = settings.targetSize;
            
            const maxX = gameArea.offsetWidth - targetSize;
            const maxY = gameArea.offsetHeight - targetSize;
            
            const x = Math.floor(Math.random() * maxX);
            const y = Math.floor(Math.random() * maxY);
            
            const colors = [
                'linear-gradient(135deg, #4361ee, #3a0ca3)',
                'linear-gradient(135deg, #f72585, #b5179e)',
                'linear-gradient(135deg, #4cc9f0, #4895ef)',
                'linear-gradient(135deg, #4ade80, #16a34a)',
                'linear-gradient(135deg, #f59e0b, #d97706)'
            ];
            
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            const target = document.createElement('div');
            target.className = 'target';
            target.style.width = `${targetSize}px`;
            target.style.height = `${targetSize}px`;
            target.style.left = `${x}px`;
            target.style.top = `${y}px`;
            target.style.background = color;
            target.style.backgroundImage = `${color}, radial-gradient(circle at 30% 30%, rgba(255,255,255,0.4) 0%, transparent 60%)`;
            
            const symbols = ['⚡', '🎯', '⭐', '🔴', '🟢', '🔵', '🟡'];
            const symbol = symbols[Math.floor(Math.random() * symbols.length)];
            target.innerHTML = symbol;
            
            target.addEventListener('click', () => {
                if (!gameState.isPlaying || gameState.isPaused) return;
                
                target.classList.add('hit');
                gameState.score += settings.points;
                gameState.targetsHit++;
                
                createClickEffect(x + targetSize/2, y + targetSize/2);
                updateDisplay();
                
                setTimeout(() => target.remove(), 500);
            });
            
            gameArea.appendChild(target);
            
            setTimeout(() => {
                if (target.parentNode) {
                    target.classList.add('missed');
                    setTimeout(() => {
                        if (target.parentNode) target.remove();
                    }, 500);
                }
            }, settings.targetLifetime);
            
            if (gameState.isPlaying && !gameState.isPaused) {
                gameState.targetTimer = setTimeout(spawnTarget, settings.spawnInterval);
            }
        }

        function createClickEffect(x, y) {
            const effect = document.createElement('div');
            effect.style.position = 'absolute';
            effect.style.left = `${x}px`;
            effect.style.top = `${y}px`;
            effect.style.width = '0px';
            effect.style.height = '0px';
            effect.style.borderRadius = '50%';
            effect.style.background = 'rgba(255, 255, 255, 0.7)';
            effect.style.pointerEvents = 'none';
            effect.style.transform = 'translate(-50%, -50%)';
            effect.style.zIndex = '10';
            
            gameArea.appendChild(effect);
            
            const animation = effect.animate([
                { width: '0px', height: '0px', opacity: 1 },
                { width: '50px', height: '50px', opacity: 0 }
            ], { duration: 500, easing: 'ease-out' });
            
            animation.onfinish = () => effect.remove();
        }

        function showMessage(text, className) {
            gameMessage.textContent = text;
            gameMessage.className = `p-4 rounded-lg mb-6 text-center font-semibold border ${className}`;
            gameMessage.classList.remove('hidden');
            
            setTimeout(hideMessage, 3000);
        }

        function hideMessage() {
            gameMessage.classList.add('hidden');
        }

        function changeDifficulty(difficulty) {
            gameState.difficulty = difficulty;
            
            difficultyBtns.forEach(btn => {
                if (btn.dataset.difficulty === difficulty) {
                    btn.classList.add('border-2', 'border-blue-500', 'scale-105');
                    btn.classList.remove('border-gray-300');
                } else {
                    btn.classList.remove('border-2', 'border-blue-500', 'scale-105');
                    btn.classList.add('border-gray-300');
                }
            });
            
            if (gameState.isPlaying) {
                showMessage(`Difficulté changée : ${difficulty}`, 'bg-blue-100 text-blue-800 border-blue-300');
            }
        }

        // Initialiser le jeu
        init();
    </script>
</body>
</html>
