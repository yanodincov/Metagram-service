<?php

namespace App\Services;

use App\Word;
use App\WordChain;
use Storage;

class MetagramService
{
    private $way = [];

    public function findChain($word_value_1, $word_value_2)
    {
        $errors = [];
        $word_1 = Word::where('word', $word_value_1)->first();
        $word_2 = Word::where('word', $word_value_2)->first();

        if (!$word_1 || !$word_2) {

            if (!$word_1) {
                $errors[1] = true;
            }

            if (!$word_2) {
                $errors[2] = true;
            }

            return ['error' => $errors];
        }

        $result = $this->findWay($word_1->id, $word_2->id);

        if (!$result) {
            $errors[3] = true;
            return ['error' => $errors];
        } else {
            $words = [];

            foreach ($result as $word_id) {
                $word = Word::find($word_id);
                $words[] = $word->word;
            }
        }

        return $words;
    }

    public function generateBaseData()
    {
        Word::query('SET FOREIGN_KEY_CHECKS=0');
        Word::truncate();
        WordChain::truncate();

        $path = 'public/dict';
        $words = $this->parseWords($path);

        foreach ($words as $word) {
            Word::create(['word' => $word]);
        }

        $chains = $this->generateWordChain($words);

        foreach ($chains as $chain) {
            WordChain::create([
                'word_first_id' => $chain[0],
                'word_second_id' => $chain[1]
            ]);
        }

        return array(
            'word' => count($words),
            'chain' => count($chains)
        );
    }

    public function parseWords($dict_path)
    {
        $words = [];
        $files = Storage::disk('local')->allFiles($dict_path);

        foreach ($files as $file) {
            $dict = Storage::get($file);

            preg_match_all('/\n([А-Яа-я]{4})\s/u', $dict, $matches);
            $words = array_merge($words, $matches[1]);
        }

        $words = array_values(array_unique($words));
        $words = array_map('mb_strtolower', $words);

        return $words;
    }

    public function generateWordChain(array $words)
    {
        $words_num = count($words);
        $chains = [];

        for ($i = 0; $i < $words_num; $i++) {
            $word_1 = $words[$i];

            preg_match_all('/[а-я]/u', $word_1 ,$letters);
            $letters_1 = $letters[0];

            for ($k = 0; $k < $words_num; $k++) {
                $word_2 = $words[$k];

                preg_match_all('/[а-я]/u', $word_2 ,$letters);
                $letters_2 = $letters[0];

                $words_diff = array_diff_assoc($letters_1, $letters_2);

                if (count($words_diff) === 1) {
                    $chains[] = [$i + 1, $k + 1];
                }
            }
        }

        return $chains;
    }

    public function findWay($start, $end)
    {
        $new_start = [];

        if (!is_array($start)) {
            $start = array([$start]);
            $this->way[] = $start;
        }

        foreach ($start as $chain) {
            $id = end($chain);

            if ($id == $end) {
                $this->way = [];
                $chain[] = $end;

                return $chain;
            } else {
                    $this->way[] = $id;
                    $new_chains = WordChain::where('word_first_id', $id)->get();

                    foreach ($new_chains as $new_chain) {
                        // Проверка на повторное использование
                        if (!in_array($new_chain->word_second_id, $this->way)) {
                            $chain_copy = $chain;
                            $chain_copy[] = $new_chain->word_second_id;
                            $new_start[] = $chain_copy;
                        }
                    }
            }
        }

        if (count($new_start)) {
            return $this->findWay($new_start, $end);
        } else {
            return false;
        }

    }
}