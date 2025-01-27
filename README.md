<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<h1 align="center">Laravel Task Manager</h1>

<p align="center">
    A simple Task Management Web Application built with Laravel to demonstrate CRUD functionality, task reordering, and completion features.
</p>

---

## Features

This application includes the following features:

1. **Task Management**:
   - Add tasks with a title and description.
   - Edit existing tasks.
   - Delete tasks.
2. **Task Completion**:
   - Mark tasks as completed or incomplete.
3. **Task Reordering**:
   - Drag and drop to reorder tasks within the list.

---

## Getting Started

### Prerequisites
Ensure you have the following installed:
- [PHP 8.x](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/)
- [Node.js](https://nodejs.org/)

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Akrambasha123/task-manager.git
   cd task-manager
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Set Environment Variables**
   Copy the `.env.example` file to `.env` and update the database settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Start the Application**
   ```bash
   php artisan serve
   npm run dev
   ```
   The application should be running on `http://127.0.0.1:8000`.

---

## Visual Guide

### Step 1: Dashboard View
<p align="center">
    <img src="1.png" alt="Task Manager Dashboard" width="800">
</p>

### Step 2: Adding a New Task
<p align="center">
    <img src="2.png" alt="Add Task View" width="800">
</p>

### Step 3: Task Reordering
<p align="center">
    <img src="4.png" alt="Reordering Tasks" width="800">
</p>

### Step 4: Marking Tasks as Complete
<p align="center">
    <img src="3.png" alt="Marking Tasks Complete" width="800">
</p>

---

## Video Walkthrough

<p>
    <a href="https://youtu.be/cZoYewBNQC4" target="_blank">Watch the Video Demonstration on YouTube</a>
</p>


---


