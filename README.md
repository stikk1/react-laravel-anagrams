## React Laravel Anagrams

Anagram searching app using [Laravel](https://laravel.com) backend and [React](https://react.dev/) frontend.

### Development setup using Laravel Sail

[Laravel Sail documentation](https://laravel.com/docs/12.x/sail)

Ensure you have Docker and Docker Compose installed.

1. Clone the repo
```bash
git@github.com:stikk1/react-laravel-anagrams.git 
cd react-laravel-anagrams
```

2. Download Sail and other dependencies
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install
```

3. (Optional) Create a shell alias to execute Sail commands. 
Skipping this step will require you to prefix any Sail command with ```./vendor/bin/sail```
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

4. Copy the default .env file
```bash
cp .env.example .env
```

5. Start Sail
```bash
sail up -d
```

6. Generate the Laravel app key
```bash
sail artisan key:generate
```

7. Run the database migrations
```bash
sail artisan migrate
```

8. Start the frontend
```bash
cd client
npm run dev 
```

You should now see the Laravel application running at ``http://localhost/`` and the React frontend at ``http://localhost:5173/``

API documentation will be available at [http://localhost/api/documentation](http://localhost/api/documentation)
