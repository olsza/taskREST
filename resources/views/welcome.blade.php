<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>{{ __('Lista zwierząt z Petstore API') }}</title>
    <style>
        body { font-family: sans-serif; background: #f8f8f8; margin: 0; padding: 2rem; }
        .container { max-width: 600px; margin: 2rem auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 2rem; }
        h1 { font-size: 2rem; margin-bottom: 1.5rem; }
        ul { list-style: none; padding: 0; }
        li { border: 1px solid #eee; border-radius: 6px; margin-bottom: 1rem; padding: 1rem; background: #fafafa; }
        strong { display: inline-block; min-width: 70px; }
        form { margin-bottom: 2rem; }
        select, button { font-size: 1rem; padding: 0.3rem 0.7rem; margin-right: 0.5rem; }
    </style>
</head>
<body>
<div class="container">
    <h1>{{ __('Lista zwierząt z Petstore API') }}</h1>
    <a href="{{ route('pets.create') }}" style="display:inline-block;margin-bottom:1.5rem;">{{ __('Dodaj zwierzę') }}</a>
    <form method="get" action="{{ url('/') }}">
        <label for="status">{{ __('Status') }}:</label>
        <select name="status" id="status">
            <option value="available" @if(request('status') == 'available') selected @endif>{{ __('Dostępne') }}</option>
            <option value="pending" @if(request('status') == 'pending') selected @endif>{{ __('Oczekujące') }}</option>
            <option value="sold" @if(request('status') == 'sold') selected @endif>{{ __('Sprzedane') }}</option>
        </select>
        <button type="submit">{{ __('Pokaż') }}</button>
    </form>
    @if(request()->has('status'))
        @if($pets?->count())
            <ul>
                @foreach($pets as $pet)
                    <li>
                        <strong>{{ __('ID') }}:</strong> {{ $pet['id'] ?? '-' }}<br>
                        <strong>{{ __('Nazwa') }}:</strong> {{ $pet['name'] ?? '-' }}<br>
                        <strong>{{ __('Status') }}:</strong> {{ $pet['status'] ?? '-' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>{{ __('Brak danych do wyświetlenia.') }}</p>
        @endif
    @endif
</div>
</body>
</html>
