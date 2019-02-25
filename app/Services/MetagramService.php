<?php

namespace App\Services;

use App\Word;
use App\WordChain;
use Storage;

class MetagramService
{
    public function generateBaseData()
    {
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

        return $chains;
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

        foreach ($words as $key => $word) {
            $words[$key] = mb_strtolower($word);
        }

        $words = array_values(array_unique($words));

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
                    $chains[] = [$i, $k];
                }
            }
        }

        return $chains;
    }
}