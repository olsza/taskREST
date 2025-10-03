<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>{{ __('Dodaj zwierzę') }}</title>
    <style>
        body { font-family: sans-serif; background: #f8f8f8; margin: 0; padding: 2rem; }
        .container { max-width: 600px; margin: 2rem auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 2rem; }
        h1 { font-size: 2rem; margin-bottom: 1.5rem; }
        form { margin-bottom: 2rem; }
        select, button, input[type=text] { font-size: 1rem; padding: 0.3rem 0.7rem; margin-right: 0.5rem; }
        .back-link { display: inline-block; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ url('/') }}" class="back-link">&larr; {{ __('Powrót do listy') }}</a>
    <h1>{{ __('Dodaj zwierzę') }}</h1>
    <form method="post" action="{{ route('pets.store') }}">
        @csrf
        <div style="margin-bottom:1rem;">
            <label for="name">{{ __('Nazwa') }}:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required maxlength="255">
            @error('name')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <div style="margin-bottom:1rem;">
            <label for="status">{{ __('Status') }}:</label>
            <select name="status" id="status" required>
                <option value="">-- {{ __('Wybierz status') }} --</option>
                <option value="available" @if(old('status') == 'available') selected @endif>{{ __('Dostępne') }}</option>
                <option value="pending" @if(old('status') == 'pending') selected @endif>{{ __('Oczekujące') }}</option>
                <option value="sold" @if(old('status') == 'sold') selected @endif>{{ __('Sprzedane') }}</option>
            </select>
            @error('status')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <button type="submit">{{ __('Dodaj zwierzę') }}</button>
    </form>
    @if(session('success'))
        <div style="color:green; margin-bottom:1rem;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color:red; margin-bottom:1rem;">{{ session('error') }}</div>
    @endif
</div>
</body>
</html>

