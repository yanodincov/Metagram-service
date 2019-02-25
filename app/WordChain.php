<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordChain extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function word_first()
    {
        return $this->hasOne('App\Word', 'id', 'word_first_id');
    }

    public function word_second()
    {
        return $this->hasOne('App\Word', 'id', 'word_second_id');
    }
}
