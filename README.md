# TaskREST – Zadanie rekrutacyjne

Aplikacja umożliwia zarządzanie zwierzętami (dodawanie, edycja, usuwanie, listowanie) przez interfejs webowy, korzystając z zewnętrznego API (np. Swagger Petstore).

## Wymagania
- Docker + Docker Compose (zalecane)
- PHP >= 8.1 (jeśli nie używasz Dockera)
- Composer

## Instalacja

1. Sklonuj repozytorium:
   ```sh
   git clone https://github.com/olsza/taskREST.git
   cd taskREST
   ```
2. Skopiuj plik środowiska:
   ```sh
   cp .env.example .env
   ```
3. Zainstaluj zależności:
   ```sh
   composer install
   npm install && npm run build
   ```
4. Uruchom kontenery:
   ```sh
   ./vendor/bin/sail up -d
   ```
5. Wygeneruj klucz aplikacji:
   ```sh
   ./vendor/bin/sail artisan key:generate
   ```
6. (Opcjonalnie) Wykonaj migracje:
   ```sh
   ./vendor/bin/sail artisan migrate
   ```

## Konfiguracja API
Adres API Petstore ustawiony jest w pliku konfiguracyjnym (`config/petstore.php`).

## Uruchomienie

- Wejdź na: [http://localhost](http://localhost)
- Domyślną stroną jest lista zwierząt.
- Dodawanie, edycja i usuwanie dostępne są z poziomu interfejsu webowego.
- Uwierzytelnianie jest uproszczone (na sztywno, bez logowania).

## Testy
Aby uruchomić testy:
```sh
./vendor/bin/sail test
```

## Najczęstsze problemy
- Jeśli port 80 jest zajęty, zmień port w pliku `docker-compose.yaml`.
- Jeśli nie działa połączenie z API, sprawdź konfigurację w pliku `config/petstore.php`.

---

Pozdrawiam,
[Olsza](https://olsza.czlowiek.it)
