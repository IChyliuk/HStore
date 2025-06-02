<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Магазин') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-bottom: 10px">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Магазин") }}
                </div>
            </div>

            <div class="p-6">
                <form method="GET" action="{{ route('shop') }}" class="flex items-center gap-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Поиск по названию товара..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"
                    />
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold">
                        Найти
                    </button>
                </form>
            </div>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(count($products)>0)
                    @foreach($products as $product)

                        <div
                            class="p-6 text-gray-900 dark:text-gray-100 border rounded-lg shadow-md bg-white dark:bg-gray-800 flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold">Товар "{{ $product->name }}"</h2>
                                <p class="text-lg">Цена: {{ $product->price }} ₽</p>
                            </div>

                            <form method="POST" action="{{ route('basket.add', $product->id) }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.34 5.34A1 1 0 007.6 20h8.8a1 1 0 001-1.33L17 13M9 21h.01M15 21h.01"/>
                                    </svg>
                                    {{ __("Добавить") }}
                                </button>
                            </form>
                        </div>

                    @endforeach

                @else
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Каталог пуст
                    </div>
                @endif

            </div>


        </div>
    </div>
    </div>
</x-app-layout>
