# LibManagerPHP

## Overview
LibManagerPHP is a PHP class library designed for streamlined book database management. It provides functionality to add, delete, update, and retrieve books, as well as manage availability status. With options to search books by ID or ISBN, this library offers a straightforward way to interact with a book inventory or library database.

## Features
- **Add and Remove Books**: Easily add or delete books from the database.
- **Update Book Details**: Update book information such as title, author, publisher, genre, and more.
- **Availability Management**: Change book availability status with a simple function.
- **Search by ID or ISBN**: Retrieve books quickly by ID or ISBN.
- **Automatic Table Creation**: Automatically creates a `books` table if it does not exist.


## Requirements
- PHP 7.0 or higher
- PDO extension enabled
- MySQL database


## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/serohant/LibManagerPHP.git
   ```
2. Navigate to the project directory:
   ```bash
   cd LibManagerPHP
   ```
3. Include the library.class.php file in your project.

4. Configure your database connection in the Library class constructor.
   
## Usage
* To add a new book, call the addBook() method with the required parameters.
* To remove a book, call the removeBook() method with the required parameters.
* To list all books, call the listBooks() method with the required parameters.
* To get book by ID, call the getBookByID() method with the required parameters.
* To get book by ISBN, call the getBookByISBN() method with the required parameters.

## Example
### addBook
```php
$library = new library('db_user', 'db_pass', 'db_name', 'localhost', 'tablename');

$title = "Kürk Mantolu Madonna";
$author = "Sabahattin Ali";
$publisher = "Kor Kitap";
$genre = "Psikolojik Roman";
$year = 2019;
$isbn = 9786052283530;
$pages = 168;
$lang = "tr";
$description = 'Kürk Mantolu Madonna, simdiye kadar okuyabileceğiniz en guzel kitaplardan bir tanesidir.';
$availability = 1;

//#new = $library->addBook($title, $author, $publisher, $genre, $year, $isbn, $pages, $lang, $description, $availability);

if ($new === true) {
    echo "successfull!";
} else {
    echo "Error";
}
```
### removeBook
```php
$library = new library('db_user', 'db_pass', 'db_name', 'localhost', 'tablename');

$book_id = 1;

$new = $library->removeBook($book_id);
if ($new === true) {
    echo "successfull!";
} else {
    echo "Error";
}
```
### listBooks
```php
$library = new library('db_user', 'db_pass', 'db_name', 'localhost', 'tablename');
print_r($library->listBooks());
```
### getBookByID
```php
$library = new library('db_user', 'db_pass', 'db_name', 'localhost', 'tablename');

$book_id = 1;
print_r($library->getBookByID($book_id));
```
### getBookByISBN
```php
$library = new library('db_user', 'db_pass', 'db_name', 'localhost', 'tablename');

$isbn = 9786052283530;
print_r($library->getBookByISBN($isbn));
```


# License
This project is licensed under the MIT License - see the LICENSE file for details.

# Contributing
Contributions are welcome! Please fork the repository and submit a pull request.
Feel free to customize any part of it as needed!
