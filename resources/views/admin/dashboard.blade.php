<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Админ-панель') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Статус AI -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Статус AI</h3>
                        @php
                            $aiClient = app(\App\Services\AiClient::class);
                            $health = $aiClient->health();
                            $aiStatus = $health['status'] === 'ok' ? 'ok' : 'error';
                            $aiError = $health['error'] ?? null;
                        @endphp

                        <div class="flex items-center mb-2">
                            <span class="inline-block w-3 h-3 rounded-full mr-2 {{ $aiStatus === 'ok' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            <strong class="text-gray-900">
                                @if($aiStatus === 'ok')
                                    AI сервис работает
                                @else
                                    Ошибка подключения к AI
                                @endif
                            </strong>
                        </div>

                        @if($aiError)
                            <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded text-sm text-red-800">
                                {{ $aiError }}
                            </div>
                        @endif

                        <a href="{{ route('admin.health') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-800">
                            Подробнее →
                        </a>
                    </div>
                </div>

                <!-- Быстрые действия -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Быстрые действия</h3>
                        <p class="text-sm text-gray-600 mb-3">Функции будут добавлены на следующих этапах:</p>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Управление квартирами (Этап 4)</li>
                            <li>• Telegram-бот (Этап 5)</li>
                            <li>• Диалоги и уведомления (Этап 6+)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
