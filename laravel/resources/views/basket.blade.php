<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Корзина') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-bottom: 10px">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Корзина") }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(count($basket) > 0)
                    @foreach($basket as $id => $item)
                        <div
                            class="p-6 text-gray-900 dark:text-gray-100 border rounded-lg shadow-md bg-white dark:bg-gray-800 flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-semibold">Товар "{{ $item['name'] }}"</h2>
                                <p class="text-lg">Цена: {{ $item['price'] }} ₽</p>
                                <p class="text-lg">Количество: {{ $item['quantity'] }}</p>
                                <p class="text-lg">Сумма: {{ $item['price'] * $item['quantity'] }} ₽</p>
                            </div>

                            <form method="POST" action="{{ route('basket.remove', $id) }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    {{ __("Удалить") }}
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-xl font-semibold mb-4">Итого:
                            {{ collect($basket)->sum(fn($item) => $item['price'] * $item['quantity']) }} ₽
                        </p>
                        <form method="POST" action="{{ route('basket.clear') }}">
                            @csrf
                            <button
                                type="submit"
                                class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded">
                                Очистить корзину
                            </button>
                        </form>
                    </div>
                @else
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Корзина пуста
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
