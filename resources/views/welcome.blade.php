<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добро пожаловать') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <h1 class="text-4xl font-bold mb-4 text-gray-900">Rental AI Admin</h1>
                    <p class="text-lg mb-4 text-gray-700">
                        Система автоматизации клиентских чатов в сфере аренды недвижимости 
                        с элементами искусственного интеллекта.
                    </p>
                    <p class="text-sm mb-4 text-gray-600">
                        Используйте админ-панель для управления объектами, просмотра диалогов 
                        и мониторинга работы AI-бота.
                    </p>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            Перейти в админ-панель
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            Войти в админку
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

