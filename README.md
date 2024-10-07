
# Laravel Application with Elasticsearch, Domain-Driven Design (DDD), and Test-Driven Development (TDD)

This Laravel project demonstrates the integration of **Elasticsearch** for advanced search functionality, structured using **Domain-Driven Design (DDD)** principles, and tested following **Test-Driven Development (TDD)** practices.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
  - [Cloning the Repository](#cloning-the-repository)
  - [Setting Up the Environment](#setting-up-the-environment)
  - [Installing Dependencies](#installing-dependencies)
  - [Running Elasticsearch](#running-elasticsearch)
- [Configuration](#configuration)
  - [Environment Configuration](#environment-configuration)
  - [Elasticsearch Configuration](#elasticsearch-configuration)
- [Running the Application](#running-the-application)
  - [Seeding Data](#seeding-data)
  - [Running Tests](#running-tests)
- [Directory Structure](#directory-structure)
- [DDD Principles](#ddd-principles)
- [TDD Approach](#tdd-approach)
- [Usage](#usage)
  - [Index a Document](#index-a-document)
  - [Search for Products](#search-for-products)
- [Contributing](#contributing)
- [License](#license)

---

## Prerequisites

To get started, make sure you have the following installed on your system:

- **PHP 8**
- **Composer**
- **MySQL** or another compatible database
- **Node.js** (for frontend dependencies if needed)
- **Docker** (optional but recommended for running Elasticsearch)
- **Elasticsearch** (v7.11 or compatible version)

## Installation

### Cloning the Repository

First, clone the repository:

```bash
git clone https://github.com/thinka87/laravel-ddd-tdd-elasticsearch-app.git
cd laravel-ddd-tdd-elasticsearch-app
```

### Setting Up the Environment

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

### Installing Dependencies

Run the following commands to install PHP and Node.js dependencies:

```bash
composer install
npm install
```

### Generate the Application Key

Laravel requires an encryption key, which is stored in the .env file under the APP_KEY variable. 
Generate this key using the following Artisan command:

```bash
php artisan key:generate
```

### Setting Up the Database

Next, configure the database connection in the .env file. Open the file and locate the DB_ section to update your MySQL credentials. It should look something like this:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
### Run Database Migrations
```bash
php artisan migrate
php artisan db:seed
```

### Running Elasticsearch

Ensure that Elasticsearch is running locally. You can use Docker to start an Elasticsearch container:

```bash
docker run -p 9200:9200 -e "discovery.type=single-node" docker.elastic.co/elasticsearch/elasticsearch:7.11.0
```

## Configuration

### Environment Configuration

In your `.env` file, set the necessary environment variables for Elasticsearch:

```env
SCOUT_DRIVER=elasticsearch
ELASTICSEARCH_HOST=localhost:9200
ELASTICSEARCH_INDEX=products_index
```

Ensure that the database credentials are also set correctly in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Elasticsearch Configuration

In the `config/scout.php` file, make sure that Elasticsearch is set up as the default search engine:

```php
'driver' => env('SCOUT_DRIVER', 'elasticsearch'),

'elasticsearch' => [
    'hosts' => [
        env('ELASTICSEARCH_HOST', 'localhost:9200'),
    ],
    'index' => env('ELASTICSEARCH_INDEX', 'products_index'),
],
```

## Running the Application

### Seeding Data

You can seed your database with sample data for testing Elasticsearch functionality:

```bash
php artisan db:seed
```

### Running Tests

To ensure that your application is working correctly and follows the TDD principles, you can run the tests:

```bash
php artisan test
```

## Directory Structure

This project follows a **Domain-Driven Design (DDD)** approach, so you will see a structure like this:

```
app/
├── Domains/
│   ├── Products/           # Product domain logic
│   └── Users/              # User domain logic
├── Http/
│   └── Controllers/        # Application layer controllers
├── Services/               # Application services (service layer)
├── Models/                 # Eloquent models
├── Repositories/           # Data access layer
└── ...
```

### Key Directories:

- **Domains**: Contains the domain logic for various entities, such as `Products`, `Users`.
- **Services**: Contains service classes responsible for business logic outside the domain.
- **Repositories**: Classes that handle interaction with the database or external data sources.

## DDD Principles

This project adheres to **Domain-Driven Design (DDD)** principles by structuring code around business domains. Each domain (e.g., `Product`, `User`) has its own logic encapsulated in the `Domains` directory. Services and repositories provide a separation of concerns and maintain a clear distinction between the application logic and the domain logic.

## TDD Approach

All functionalities are covered by unit and feature tests, following **Test-Driven Development (TDD)** practices. Before implementing a feature, tests are written and then used to drive the development process.

To run the tests:

```bash
php artisan test
```

## Usage

### Index a Document

To manually index a product in Elasticsearch, you can use the following command in a controller or directly in Tinker:

```php
$product = Product::create([
    'name' => 'Sample Product',
    'description' => 'A sample product description',
    'price' => 100.00,
]);

$product->searchable(); // Index the product in Elasticsearch
```

### Search for Products

You can perform a search using the following query:

```php
$results = Product::search('Sample')->get();
```

This will return all products matching the term "Sample."

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any improvements, features, or bug fixes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
