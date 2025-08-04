This project is a simple Blog app with list of API routes for a blog web application, organized by common functionality like posts, users, comments, authentication and also a fullstack back office application for manipulating data(db) using LaravelPHP and VueJS. 

## 📘 Post Routes

| Method | Route                     | Description                        |
|--------|---------------------------|------------------------------------|
| GET    | `/api/posts`              | Get all posts                      |
| GET    | `/api/posts/:id`          | Get a single post by ID            |
| POST   | `/api/posts`              | Create a new post                  |
| PUT    | `/api/posts/:id`          | Update a post                      |
| DELETE | `/api/posts/:id`          | Delete a post                      |
| GET    | `/api/posts?author=123`   | Get posts by a specific author     |
| GET    | `/api/posts?tag=react`    | Filter posts by tag/category       |

---

## 👤 User Routes

| Method | Route               | Description                    |
|--------|---------------------|--------------------------------|
| GET    | `/api/users`        | Get all users (admin only)     |
| GET    | `/api/users/:id`    | Get user profile               |
| POST   | `/api/users`        | Register a new user            |
| PUT    | `/api/users/:id`    | Update user profile            |
| DELETE | `/api/users/:id`    | Delete a user (admin only)     |

---

## 💬 Comment Routes

| Method | Route                         | Description                     |
|--------|-------------------------------|---------------------------------|
| GET    | `/api/posts/:postId/comments` | Get comments for a post         |
| POST   | `/api/posts/:postId/comments` | Add a comment to a post         |
| DELETE | `/api/comments/:id`           | Delete a comment (author/admin) |

---

## 🔐 Authentication Routes

| Method | Route                 | Description             |
|--------|-----------------------|-------------------------|
| POST   | `/api/auth/login`     | Login user              |
| POST   | `/api/auth/register`  | Register new user       |
| POST   | `/api/auth/logout`    | Logout current session  |
| GET    | `/api/auth/me`        | Get current user profile|

---

## 🏷️ Tags/Categories Routes

| Method | Route             | Description                    |
|--------|-------------------|--------------------------------|
| GET    | `/api/tags`       | Get all tags or categories     |
| POST   | `/api/tags`       | Create a new tag (admin only)  |
| DELETE | `/api/tags/:id`   | Delete a tag                   |
