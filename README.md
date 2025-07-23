# 🚀 EatDrink - Déploiement Laravel 12 sur Railway

## ✅ Étapes de déploiement

1. Fork ou clone ce projet sur ton GitHub
2. Va sur [https://railway.app](https://railway.app) et connecte ton repo
3. Crée une base MySQL via "New → Database"
4. Configure les variables d'environnement dans Railway :
   - APP_KEY → génère avec `php artisan key:generate --show` (en local)
   - APP_ENV=production
   - APP_DEBUG=false
   - APP_URL=https://ton-app.up.railway.app

5. Railway remplira automatiquement les `DB_HOST`, `DB_DATABASE`, etc.

6. Le fichier `Procfile` lance automatiquement le serveur Laravel.

7. 🚀 Accède à ton site via l’URL Railway.
