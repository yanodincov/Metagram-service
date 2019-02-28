<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Metagram;
use Validator;

class MetagramController extends Controller
{
    public function index()
    {
        return view('metagram.index');
    }

    public function generate()
    {
        $num_data = Metagram::generateBaseData();
        return json_encode([
            'type' => 'info',
            'message' => [
                'Собрано слов: ' . $num_data['word'],
                'Найдено связей: ' . $num_data['chain']
            ]
        ]);
    }

    public function getWay(Request $request)
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
            return json_encode([
                'type' => 'error',
                'message' => $validator->errors()->all()
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

            return json_encode([
                'type' => 'error',
                'message' => $error
            ]);
        } else {
            return json_encode([
               'type' => 'success',
               'message' => $chain
            ]);
        }
    }
}
