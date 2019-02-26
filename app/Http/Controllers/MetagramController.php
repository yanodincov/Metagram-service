<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Metagram;

class MetagramController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->word_1 || !$request->word_2) {
            return view('metagram.index');
        }

        $request->validate([
            'word_1' => 'required|string|size:4',
            'word_2' => 'required|string|size:4'
        ]);

        $chain = Metagram::findChain($request->word_1, $request->word_2);

        $errors = [];
        $result = [];

        if (key_exists('error', $chain)) {
            if ($chain['error'][1]) {
                $errors[] = 'Слово №1 не найдено в словаре';
            }

            if ($chain['error'][2]) {
                $errors[] = 'Слово №2 не найдено в словаре';
            }

            if ($chain['error'][3]) {
                $errors[] = 'Связь между словом ' . $request->word_1 . ' и ' . $request->word_2 . ' не найдена';
            }
        } else {
            $result = $chain;
        }

        return view('metagram.index', [
            'results' => $result,
            'errors' => $errors,
            'word_1' => $request->word_1,
            'word_2' => $request->word_2
        ]);
    }

    public function generate()
    {
        $num_data = Metagram::generateBaseData();
        $result = [
            'Собрано слов: ' . $num_data['word'],
            'Найдено связей: ' . $num_data['chain']
        ];

        return view('metagram.index', [
            'results' => $result,
            'errors' => []
        ]);
    }
}
