# Настройка редиректа после логина

После установки Laravel Breeze нужно настроить редирект на `/admin` после успешного входа.

## Вариант 1: Изменение AuthenticatedSessionController (рекомендуется)

После установки Breeze, отредактируйте файл:

`app/Http/Controllers/Auth/AuthenticatedSessionController.php`

Найдите метод `store()` и измените редирект:

```php
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    // Изменяем редирект на /admin
    return redirect()->intended(route('admin.dashboard'));
}
```

## Вариант 2: Через RouteServiceProvider

Отредактируйте `app/Providers/RouteServiceProvider.php`:

```php
public const HOME = '/admin';
```

## Вариант 3: Middleware (если нужно)

Создайте middleware для редиректа после логина, но для простоты используйте Вариант 1.

## Проверка

1. Зарегистрируйтесь на сайте
2. Войдите в систему
3. Должен произойти автоматический редирект на `/admin`

