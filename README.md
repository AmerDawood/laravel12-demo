# SmartExam

**SmartExam** is an interactive test management platform built with Laravel. It allows instructors to create tests with different question types and students to take these tests online or via API, with real-time notifications and analytics.

---

## Table of Contents

- [Project Overview](#project-overview)  
- [Features](#features)  
- [Installation](#installation)  
- [Development Roadmap](#development-roadmap)  
- [API Endpoints](#api-endpoints)  
- [Technologies Used](#technologies-used)  
- [Contributing](#contributing)  
- [License](#license)  
- [Contact](#contact)

---

## Project Overview

SmartExam is designed to be a full-fledged test management system with user roles for Admin, Instructor, and Student. It supports real-time notifications, PDF report generation, and API access for mobile apps.

---

## Features

- User authentication (email & Google via Socialite)
- Role-based access control (Admin, Instructor, Student) via Spatie Permissions
- Instructor dashboard for creating and managing tests
- Support for multiple question types: MCQ, written, programming (polymorphic)
- Student interface for taking tests with timers
- Attempt and result recording
- Real-time notifications using Laravel Broadcasting & Pusher
- PDF report generation for test results
- Analytics with charts
- API with Laravel Sanctum for mobile clients
- Activity logging and session security
- Multilingual support including Arabic
- Background jobs, scheduling, and email notifications

---

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/smart-exam-platform.git
   cd smart-exam-platform

2. Install dependencies:

   ```bash
    composer install
    npm install && npm run dev

3.  Setup environment variables: 

   ```bash
    cp .env.example .env
    php artisan key:generate

4. Run migrations and seeders: 

   ```bash
   php artisan migrate --seed



5. Serve the application:

   ```bash
   php artisan serve

# Development Roadmap

## ✅ Day 1: Setup and Foundation
- Laravel project setup, GitHub repo  
- Database and Jetstream + Fortify installation  
- Socialite Google login  
- Setup roles with Spatie Permissions  

## ✅ Day 2: Database Design & Models
- Create core models:  
  `User`, `Test`, `Question`, `Attempt`, `Answer`, `Result`  
- Define relationships with Eloquent  

## ✅ Day 3: Dashboard & Test Management
- Instructor dashboard (Livewire/Vue.js)  
- CRUD for tests and questions  
- Soft deletes and restore support  

## ✅ Day 4: Test Taking & Attempt Recording
- Student test listing  
- Test start page with timers  
- Save answers and calculate preliminary results  

## ✅ Day 5: Notifications & Reporting
- Real-time notifications via Pusher  
- PDF report generation  
- Analytics and charts  

## ✅ Day 6: API & Security
- Laravel Sanctum API for mobile  
- Rate limiting and activity logging  
- Multilingual support  

## ✅ Day 7: Finalization & Deployment
- Jobs, queues, events, and email notifications  
- Scheduler setup  
- Deployment instructions and documentation  



## API Endpoints

| Method | Endpoint                      | Description                              |
|--------|-------------------------------|------------------------------------------|
| POST   | `/api/login`                  | User login                               |
| POST   | `/api/register`               | User registration                        |
| GET    | `/api/tests`                  | List all available tests                 |
| POST   | `/api/tests`                  | Create new test (Instructor only)        |
| POST   | `/api/tests/{id}/questions`   | Add questions to a test                  |
| POST   | `/api/attempts`               | Start new attempt                        |
| POST   | `/api/answers`                | Submit answers                           |
| GET    | `/api/results/{attempt_id}`   | Fetch test attempt result                |



## Technologies Used

- **Core Framework**:  
  Laravel 12 (PHP framework)

- **Authentication & Security**:  
  Laravel Breez (Auth)  
  Spatie Permissions (Role management)  
  Laravel Sanctum (API authentication)

- **Frontend Stack**:  
  Blade and Bootstrap For UI
  Livewire or Inertia.js (Interactive UI components)

- **Third-Party Integrations**:  
  Socialite (Google OAuth integration)  
  Pusher (Real-time broadcasting via Laravel Broadcasting)

- **Reporting & Analytics**:  
  Barryvdh DomPDF (PDF report generation)  
  Chart.js (Data visualization)

- **Deployment**:  
  Included in Laravel ecosystem (Queues, Scheduler, etc.)




## Contributing

Thank you for your interest in contributing to this project!

- Feel free to submit issues or pull requests.
- Please follow the existing code style and conventions.
- Include tests for any new features or bug fixes.
- Ensure your pull requests are clean, focused on a single feature or fix, and pass all tests.
- Provide a clear description and rationale for your changes in your pull request.

For detailed contribution guidelines, please refer to the official Laravel contribution guide to ensure consistency and quality.

---

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).




   


    

