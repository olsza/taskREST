<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>{{ __('Szczegóły zwierzęcia') }}</title>
    <style>
        body { font-family: sans-serif; background: #f8f8f8; margin: 0; padding: 2rem; }
        .container { max-width: 600px; margin: 2rem auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 2rem; }
        h1 { font-size: 2rem; margin-bottom: 1.5rem; }
        .back-link { display: inline-block; margin-bottom: 1.5rem; }
        .json-box { background: #f4f4f4; border: 1px solid #eee; border-radius: 6px; padding: 1rem; margin-bottom: 2rem; font-family: monospace; font-size: 0.95rem; }
        form { margin-bottom: 2rem; }
        select, button, input[type=text] { font-size: 1rem; padding: 0.3rem 0.7rem; margin-right: 0.5rem; }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ url('/') }}" class="back-link">&larr; {{ __('Powrót do listy') }}</a>
    <h1>{{ __('Szczegóły zwierzęcia') }}</h1>
    <div class="json-box">
        <pre>{{ json_encode($pet, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    </div>
    <form method="post" action="{{ route('pets.update', $pet['id']) }}">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $pet['id'] }}">
        <input type="hidden" name="category[id]" value="{{ $pet['category']['id'] ?? 0 }}">
        <input type="hidden" name="category[name]" value="{{ $pet['category']['name'] ?? 'string' }}">
        @foreach(($pet['photoUrls'] ?? []) as $i => $url)
            <input type="hidden" name="photoUrls[{{ $i }}]" value="{{ $url }}">
        @endforeach
        @if(empty($pet['photoUrls']))
            <input type="hidden" name="photoUrls[0]" value="string">
        @endif
        @foreach(($pet['tags'] ?? []) as $i => $tag)
            <input type="hidden" name="tags[{{ $i }}][id]" value="{{ $tag['id'] ?? 0 }}">
            <input type="hidden" name="tags[{{ $i }}][name]" value="{{ $tag['name'] ?? 'string' }}">
        @endforeach
        @if(empty($pet['tags']))
            <input type="hidden" name="tags[0][id]" value="0">
            <input type="hidden" name="tags[0][name]" value="string">
        @endif
        <div style="margin-bottom:1rem;">
            <label for="name">{{ __('Nazwa') }}:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $pet['name'] ?? '') }}" required maxlength="255">
            @error('name')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <div style="margin-bottom:1rem;">
            <label for="status">{{ __('Status') }}:</label>
            <select name="status" id="status" required>
                <option value="available" @if(old('status', $pet['status'] ?? '') == 'available') selected @endif>{{ __('Dostępne') }}</option>
                <option value="pending" @if(old('status', $pet['status'] ?? '') == 'pending') selected @endif>{{ __('Oczekujące') }}</option>
                <option value="sold" @if(old('status', $pet['status'] ?? '') == 'sold') selected @endif>{{ __('Sprzedane') }}</option>
            </select>
            @error('status')<div style="color:red;">{{ $message }}</div>@enderror
        </div>
        <button type="submit">{{ __('Zapisz edycję') }}</button>
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
