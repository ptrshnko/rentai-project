# Инструкция по установке Laravel

Этот файл содержит пошаговые инструкции по установке Laravel и Breeze в каталоге `web/`.

## Шаг 1: Установка Laravel

### Windows PowerShell

```powershell
cd web
composer create-project laravel/laravel . --prefer-dist
```

### Linux/macOS/WSL

```bash
cd web
composer create-project laravel/laravel . --prefer-dist
```

**Важно:** Если каталог `web/` уже содержит файлы, убедитесь, что они не конфликтуют с Laravel. 
После установки Laravel, файлы из этого репозитория (контроллеры, маршруты, views) нужно будет скопировать в соответствующие места.

## Шаг 2: Установка Laravel Breeze

После установки Laravel:

```bash
# В каталоге web/
composer require laravel/breeze --dev
php artisan breeze:install blade
```

Это создаст:
- Маршруты аутентификации (`routes/auth.php`)
- Views для login/register
- Миграции для users и password_resets

## Шаг 3: Настройка после установки

После установки Laravel и Breeze:

1. **Скопируйте файлы из репозитория:**
   - Контроллеры уже созданы в `app/Http/Controllers/`
   - Маршруты уже созданы в `routes/`
   - Views уже созданы в `resources/views/`
   - Конфиг `config/ai.php` уже создан

2. **Установите зависимости:**
   ```bash
   composer require guzzlehttp/guzzle
   ```

3. **Настройте .env:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Настройте базу данных в .env:**
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=rental_ai
   DB_USERNAME=postgres
   DB_PASSWORD=postgres
   ```

5. **Выполните миграции:**
   ```bash
   php artisan migrate
   ```

6. **Настройте редирект после логина:**
   
   Отредактируьте `app/Providers/RouteServiceProvider.php` или создайте middleware для редиректа на `/admin` после логина.
   
   Или добавьте в `app/Http/Controllers/Auth/AuthenticatedSessionController.php`:
   ```php
   public function store(Request $request)
   {
       // ... существующий код Breeze ...
       
       // После успешной аутентификации
       return redirect()->intended(route('admin.dashboard'));
   }
   ```

## Шаг 4: Проверка

1. Запустите сервер:
   ```bash
   php artisan serve --host=127.0.0.1 --port=9000
   ```

2. Откройте http://127.0.0.1:9000/
3. Зарегистрируйтесь
4. Проверьте доступ к `/admin`
5. Проверьте статус AI на дашборде

## Примечания

- Файлы из репозитория (контроллеры, routes, views) уже готовы и должны работать после установки Laravel и Breeze
- Убедитесь, что AI-сервис запущен на `http://127.0.0.1:8000` для проверки статуса
- На этом этапе создаются только базовые миграции Breeze (users, password_resets), доменные миграции будут на Этапе 4

