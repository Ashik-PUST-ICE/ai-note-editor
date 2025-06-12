# 📝 AI-Enhanced Note Editor

An AI-powered Note Editor web application built with **Laravel 12**, **React**, **Inertia.js**, and **OpenAI GPT-4.1 Nano**, enabling users to create, edit, and manage notes with AI features like summarization and tag generation.

---

## 🚀 Project Overview

This project is part of a mid-level developer assessment. The goal is to build a full-stack application with:

- Google OAuth authentication
- Full CRUD for notes
- AI-powered enhancements (summarize, tag generation)
- Real-time AI streaming
- Raw PHP integration outside Laravel
- Clean and responsive UI

---

## ✨ Key Features

### 🔐 Authentication
- Google OAuth login using Laravel Socialite
- User profile info (name, email) saved in DB
- Authenticated routes protected by middleware

### 📝 Note Management
- Create, read, update (with auto-save), and delete notes
- Dashboard to view all notes
- Clean and responsive Note Editor

### 🤖 AI Enhancements (OpenAI Integration)
- **Summarize**: Auto-generate a summary of the note content
- **Generate Tags**: Extract key tags from notes
- Streaming output from OpenAI API (gpt-4.1-nano)

### 🧩 Raw PHP Component
- Separate script outside Laravel
- Demonstrates legacy PHP integration with Laravel
- Performs a simple note-processing task

### 🖥️ UI & Frontend
- Built with **React** + **Inertia.js**
- SPA-like experience with Laravel backend
- Pages:
  - Login Page (Google OAuth)
  - Dashboard
  - Note Editor with AI tools

---

## 🔗 Routes Overview

### Authentication
- `GET /auth/google` – Redirect to Google
- `GET /auth/google/callback` – Handle OAuth callback
- `GET /logout` – Logout

### Notes
- `GET /notes` – List user notes
- `GET /notes/create` – Create note form
- `POST /notes` – Store new note
- `GET /notes/{id}/edit` – Edit note
- `PUT /notes/{id}` – Update note
- `DELETE /notes/{id}` – Delete note

### AI Endpoints
- `POST /api/ai/summarize` – Summarize content
- `POST /api/ai/tags` – Generate tags

### Misc
- `GET /up` – Health check
- `GET /raw/export_notes.php` – Export notes using raw PHP

---

## 🧰 Tech Stack

- **Frontend:** React, Inertia.js, Vite
- **Backend:** Laravel 12 (PHP 8+)
- **Database:** MySQL or PostgreSQL
- **Authentication:** Google OAuth
- **AI Integration:** OpenAI GPT-4.1-nano-2025-04-14
- **Raw PHP:** One standalone script for integration demo

---

## ⚙️ Setup Instructions

### Step 1: Clone the Repo
```bash
git clone https://github.com/your-username/ai-note-editor.git
cd ai-note-editor
Step 2: Install Backend & Frontend Dependencies
bash
Copy
Edit
composer install
npm install
Step 3: Create .env File
bash
Copy
Edit
cp .env.example .env
Update the following in .env:

env
Copy
Edit
APP_URL=http://localhost:8000

DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass

GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

OPENAI_API_KEY=
OPENAI_MODEL=gpt-4.1-nano-2025-04-14
Step 4: Database Migration
bash
Copy
Edit
php artisan migrate
Step 5: Run the App
bash
Copy
Edit
php artisan serve
npm run dev
Visit the app at: http://localhost:8000

✅ Summary
This project demonstrates:

Modern authentication via Google OAuth

Secure CRUD operations with auto-save

Real-time React UI powered by Inertia

AI-enhanced user experience using OpenAI

Integration of legacy PHP with Laravel

📂 Folder Structure (Highlights)
bash
Copy
Edit
/app
/resources/js/Pages/        # React pages via Inertia
/routes/web.php             # Web routes
/routes/api.php             # API routes
/public/raw/export_notes.php # Raw PHP script
📌 Additional Notes
CSRF protection and route middleware implemented

Fully responsive for mobile and desktop

Source code contains comments for clarity

Even if partially complete, this project demonstrates structure, logic, and stack understanding

