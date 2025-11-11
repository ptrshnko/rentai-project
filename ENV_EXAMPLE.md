# Содержимое файла .env.example

Создайте файл `.env.example` в каталоге `web/` со следующим содержимым:

```env
APP_NAME="Rental AI Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:9000

LOG_CHANNEL=single
LOG_LEVEL=info

# DB (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rental_ai
DB_USERNAME=postgres
DB_PASSWORD=postgres

# AI Service
AI_BASE_URL=http://127.0.0.1:8000
AI_TIMEOUT=3

# Breeze (if needed)
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## Windows PowerShell

```powershell
# Создание .env.example
@"
APP_NAME="Rental AI Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:9000

LOG_CHANNEL=single
LOG_LEVEL=info

# DB (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rental_ai
DB_USERNAME=postgres
DB_PASSWORD=postgres

# AI Service
AI_BASE_URL=http://127.0.0.1:8000
AI_TIMEOUT=3

# Breeze (if needed)
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
"@ | Out-File -FilePath .env.example -Encoding utf8
```

## Linux/macOS

```bash
# Скопируйте содержимое выше в файл .env.example
cat > .env.example << 'EOF'
APP_NAME="Rental AI Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:9000

LOG_CHANNEL=single
LOG_LEVEL=info

# DB (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rental_ai
DB_USERNAME=postgres
DB_PASSWORD=postgres

# AI Service
AI_BASE_URL=http://127.0.0.1:8000
AI_TIMEOUT=3

# Breeze (if needed)
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
EOF
```

