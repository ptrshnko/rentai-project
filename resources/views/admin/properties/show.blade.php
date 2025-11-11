<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Квартира: ') . $property->title }}
            </h2>
            <a href="{{ route('admin.properties.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                ← Назад к списку
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Основная информация -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Основная информация</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Адрес</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $property->address }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Город</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $property->city ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Цена за ночь</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ number_format($property->price_per_night, 0, ',', ' ') }} ₽</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Максимум гостей</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $property->max_guests }}</dd>
                        </div>
                        @if($property->beds)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Кроватей</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $property->beds }}</dd>
                            </div>
                        @endif
                        @if($property->description)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Описание</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $property->description }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Фото -->
            @if($property->photos->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Фото</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($property->photos->sortBy('sort_order') as $photo)
                                <div class="border border-gray-200 rounded-lg p-2">
                                    <div class="bg-gray-100 rounded h-32 flex items-center justify-center">
                                        <span class="text-xs text-gray-500">{{ $photo->path }}</span>
                                    </div>
                                    @if($photo->is_cover)
                                        <div class="mt-2 text-xs text-center">
                                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded">Обложка</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Удобства -->
            @if($property->amenities->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Удобства</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($property->amenities as $amenity)
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                    {{ $amenity->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Бронирования -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Занятость</h3>
                    @if($property->bookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата начала</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата окончания</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($property->bookings->sortBy('start_date') as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $booking->start_date->format('d.m.Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $booking->end_date->format('d.m.Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                @php
                                                    $statusColors = [
                                                        'reserved' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-green-100 text-green-800',
                                                        'blocked' => 'bg-red-100 text-red-800',
                                                    ];
                                                    $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="inline-block px-2 py-1 rounded text-xs {{ $statusColor }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Бронирований нет</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

