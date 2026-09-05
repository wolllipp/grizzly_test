# Тестовое задание

- **Фронтенд:** SvelteKit
- **Бэкенд:** PHP 8.3 
- **База данных:** PostgreSQL 16
- **DevOps:** Docker Compose + Flyway 

## Запуск

### 1. Убедитесь, что Docker установлен

```bash
docker --version
docker-compose --version
```

Если нет — скачайте: [https://www.docker.com/products/docker-desktop/](https://www.docker.com/products/docker-desktop/)

### 2. Запустите проект

```bash
docker-compose up --build
```

### 3. Откройте браузер

**[http://localhost:5173](http://localhost:5173)**

Готово.

## Структура проекта

```
grizzly_test/
├── backend/src/          # PHP API (submit.php, db.php, config.php)
├── db/migrations/        # SQL-миграции Flyway
├── frontend/src/
│   ├── lib/components/   # Svelte-компоненты
│   ├── lib/validation.js # Клиентская валидация
│   └── routes/           # SvelteKit страницы
├── docker-compose.yml
└── README.md
```



## API

`POST /submit.php` — Отправка формы заявки

Тело запроса (JSON):

```json
{
  "firstName": "string",
  "lastName": "string",
  "middleName": "string",
  "birthDate": "YYYY-MM-DD",
  "email": "string",
  "maritalStatus": "string",
  "about": "string",
  "rulesAccepted": true,
  "phones": [{ "country": "BY", "phone": "+375 ..." }]
}
```

Ответ: `201 { "success": true, "id": 1 }` или `422 { "errors": {...} }`
