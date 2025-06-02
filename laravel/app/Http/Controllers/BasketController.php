<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BasketController extends Controller
{
    // Отображение корзины
    public function index()
    {
        $basket = session()->get('basket', []);
        return view('basket', compact('basket'));
    }

    // Добавление товара в корзину
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $basket = session()->get('basket', []);

        if (isset($basket[$id])) {
            $basket[$id]['quantity']++;
        } else {
            $basket[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'game_id' => $product->id // добавляем game_id для поиска ключей
            ];
        }

        session()->put('basket', $basket);
        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    // Удаление товара из корзины
    public function remove($id)
    {
        $basket = session()->get('basket', []);
        if (isset($basket[$id])) {
            unset($basket[$id]);
            session()->put('basket', $basket);
        }

        return redirect()->back()->with('success', 'Товар удален из корзины.');
    }

    // Очистка корзины
    public function clear()
    {
        session()->forget('basket');
        return redirect()->back()->with('success', 'Корзина очищена.');
    }

    // Метод для оплаты и загрузки ключей
    public function pay(Request $request)
    {
        // Получаем корзину
        $basket = session()->get('basket', []);
        $gameIds = collect($basket)->pluck('game_id')->unique();

        // Получаем ключи, которые будут использоваться (где actual = 1)
        $keysQuery = Key::whereIn('game_id', $gameIds)
            ->where('actual', 1);

        // Получаем сами ключи
        $keys = $keysQuery->get();

        // Если ключей нет — ошибка
        if ($keys->isEmpty()) {
            return redirect()->route('basket.index')->with('error', 'Нет доступных ключей для оплаты.');
        }

        // Генерация содержимого txt
        $keyValues = $keys->pluck('key')->toArray();
        $fileContent = implode("\n", $keyValues);
        $filePath = storage_path('app/keys.txt');
        file_put_contents($filePath, $fileContent);

        // Обновляем actual = 0 для всех использованных ключей
        $keysQuery->update(['actual' => 0]);

        // Очищаем корзину
        session()->forget('basket');

        // Отдаём файл на скачивание
        return response()->download($filePath, 'keys.txt', [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="keys.txt"',
        ]);


    }

}
