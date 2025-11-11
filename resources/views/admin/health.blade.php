<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Статус AI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Проверка подключения</h3>
                    
                    <div class="flex items-center mb-4">
                        <span class="inline-block w-3 h-3 rounded-full mr-2 {{ $ai_status === 'ok' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        <strong class="text-gray-900">
                            @if($ai_status === 'ok')
                                Сервис доступен
                            @else
                                Сервис недоступен
                            @endif
                        </strong>
                    </div>

                    @if($ai_error)
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
                            <strong class="block text-red-800 mb-1">Ошибка:</strong>
                            <code class="text-sm text-red-700">{{ $ai_error }}</code>
                        </div>
                    @else
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded">
                            <p class="text-green-800">
                                AI сервис отвечает корректно. Эндпоинт: 
                                <code class="text-sm">{{ config('ai.base_url') }}/health</code>
                            </p>
                        </div>
                    @endif

                    <div class="flex gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Вернуться к дашборду
                        </a>
                        <button onclick="location.reload()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Обновить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
