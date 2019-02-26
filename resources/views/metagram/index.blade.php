@extends('layouts.app', [
    'title' => 'Метраграммы'
])

@section('content')
    <div class="container" style="height: 100vh">
        <div class="row h-100">
            <div class="col-12  h-100 d-flex justify-content-center align-items-center">
                <form class="w-50" method="get" action="{{ route('metagram.index') }}">
                    @if(!empty($errors))
                        <div class="alert alert-danger">
                            @foreach($errors as $search_error)
                                <p class="mb-0">{{ $search_error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if(!empty($results))
                        <div class="alert alert-success">
                            @foreach($results as $key => $word)
                                <p class="mb-0">{{ $key + 1 }}) {{ $word }}</p>
                            @endforeach
                        </div>
                    @endisset
                    <div class="w-100 bg-white border rounded p-4">
                        <h3 class="text-center mb-3">Метаграммы</h3>
                        <div class="w-100 bg-light">
                            <div class="form-group">
                                <label for="word-1">Первое слово:</label>
                                <input type="text" class="form-control" id="word-1" name="word_1" maxlength="4" @isset($word_1) value="{{ $word_1 }}" @endisset>
                            </div>
                            <div class="form-group">
                                <label for="word-1">Второе слово:</label>
                                <input type="text" class="form-control" id="word-2" name="word_2" maxlength="4" @isset($word_2) value="{{ $word_2 }}" @endisset>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-3">
                        Найти связь
                    </button>
                    <a href="{{ route('metagram.generate') }}" class="btn btn-link w-100 mt-3">
                        Сгенерировать таблицу слов и связей
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection