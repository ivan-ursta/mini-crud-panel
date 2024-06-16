
```markdown
# Mini CRUD Panel with Roles and Access Rights

This is a mini CRUD panel built with Laravel that includes role-based access control. Users can be created and managed with roles such as admin, team lead, and buyer. Each role has specific permissions and access rights.

## Features

- **Admin**: Can manage all users and view statistics for all users and team leads.
- **Team Lead**: Can manage and view statistics for their assigned buyers.
- **Buyer**: Can view their own statistics and manage their own entities.

## Requirements

- PHP 7.3 or higher
- Composer
- Node.js and npm
- SQLite (for the database)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/ivan-ursta/mini-crud-panel.git
   cd mini-crud-panel
   ```

2. **Install dependencies:**

   ```bash
   composer install
   npm install
   ```

3. **Copy the example environment file and set your environment variables:**

   ```bash
   cp .env.example .env
   ```

4. **Generate an application key:**

   ```bash
   php artisan key:generate
   ```

5. **Set up the database:**

   Make sure your `.env` file contains the following database configuration:

   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database/database.sqlite
   ```

   Create the SQLite database file:

   ```bash
   touch database/database.sqlite
   ```

6. **Run database migrations and seed the database:**

   ```bash
   php artisan migrate --seed
   ```

7. **Compile the assets:**

   ```bash
   npm run dev
   ```

8. **Start the development server:**

   ```bash
   php artisan serve
   ```

   The application will be accessible at `http://localhost:8000`.

## Usage

### Admin

- **View All Users**: `/users`
- **Create User**: `/users/create`
- **Edit User**: `/users/{id}/edit`
- **Delete User**: `/users/{id}`

### Team Lead

- **View Assigned Buyers**: `/users`
- **Create Buyer**: `/users/create`
- **Edit Buyer**: `/users/{id}/edit`
- **Delete Buyer**: `/users/{id}`

### Buyer

- **View Own Entities**: `/users`
- **Create Entity**: `/entities/create`
- **Edit Entity**: `/entities/{id}/edit`
- **Delete Entity**: `/entities/{id}`

## Project Structure

- **Controllers**: `app/Http/Controllers/`
    - `UserController.php`: Handles user-related CRUD operations.
    - `EntityController.php`: Handles entity-related CRUD operations.

- **Models**: `app/Models/`
    - `User.php`: User model with relationships and attributes.
    - `Entity.php`: Entity model with relationships and attributes.

- **Views**: `resources/views/`
    - **Layouts**: Contains the main layout file.
    - **Users**: Contains views for user CRUD operations.
    - **Entities**: Contains views for entity CRUD operations.

- **Migrations**: `database/migrations/`
    - Contains database migration files for creating tables.

- **Seeders**: `database/seeders/`
    - `DatabaseSeeder.php`: Seeds initial data into the database.
