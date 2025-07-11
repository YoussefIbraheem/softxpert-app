# Introduction

This API is a task management backend system built with Laravel. It is designed to facilitate task creation, assignment, dependency tracking, and role-based collaboration within a team.

Key Features:
- **Authentication** using Laravel Sanctum with secure registration and login endpoints.
- **Role-based access control** using Spatie Permissions (Admin, Manager, User).
- **Task management** including creation, updates, status changes, and filtering by due date, status, and assignee.
- **Task dependencies** support to ensure that tasks can't be marked as completed until their dependent tasks are finished.
- **RESTful API design** following best practices, with input validation, error handling, and policy-based authorization.
- **API Documentation** generated with Scribe, including response samples, authentication headers, and detailed request requirements.

This documentation is auto-generated and kept up-to-date with the latest API behavior to serve developers and integrators effectively.


<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>

    This documentation aims to provide all the information you need to work with our API.

    <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
    You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

