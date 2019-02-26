<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Metagram;
use Validator;

class MetagramController extends Controller
{
    public function index(Request $request)
    {
        $messages = array(
            'word_1.required' => '<strong>Первое слово</strong> должно быть указано',
            'word_2.required' => '<strong>Второе слово</strong> должно быть указано',
            'word_1.size' => '<strong>Первое слово</strong> должно состоять из четырех букв',
            'word_2.size' => '<strong>Второе слово</strong> должно состоять из четырех букв',
            'word_1.alpha' => '<strong>Первое слово</strong> должно состоять только из букв',
            'word_2.alpha' => '<strong>Второе слово</strong> должно состоять только из букв'
        );

        $rules = array(
            'word_1' => 'required|alpha|size:4',
            'word_2' => 'required|alpha|size:4'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return view('metagram.index', [
                'error' => $validator->errors()->all(),
                'word_1' => $request->word_1,
                'word_2' => $request->word_2
            ]);
        }

        $chain = Metagram::findChain($request->word_1, $request->word_2);

        $error = [];
        $result = [];

        if (key_exists('error', $chain)) {
            if (!empty($chain['error'][1])) {
                $error[] = '<strong>Первое слово</strong> не найдено в словаре';
            }

            if (!empty($chain['error'][2])) {
                $error[] = '<strong>Второе слово</strong> не найдено в словаре';
            }

            if (!empty($chain['error'][3])) {
                $error[] = 'Связь между словом ' . $request->word_1 . ' и ' . $request->word_2 . ' не найдена';
            }
        } else {
            $result = $chain;
        }

        return view('metagram.index', [
            'result' => $result,
            'error' => $error,
            'word_1' => $request->word_1,
            'word_2' => $request->word_2
        ]);
    }

    public function generate()
    {
        $num_data = Metagram::generateBaseData();
        return view('metagram.index', [
            'info' => [
                'Собрано слов: ' . $num_data['word'],
                'Найдено связей: ' . $num_data['chain']
            ]
        ]);
    }
}
