<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);

$title = isset($_GET['title']) ? $_GET['title'] : die(json_encode(array('message' => 'Invalid title parameter')));
$result = $book->get_single_book($title);

if ($result) {
    $book_arr = array(
        'ISBN' => $book->ISBN,
        'title' => $book->title,
        'author' => $book->author,
        'description' => $book->description,
        'cover_photo' => $book->cover_photo,
        'price' => $book->price,
        'num_copies' => $book->num_copies,
        'category' => $book->category,
    );

    echo json_encode($book_arr);
} else {
    echo json_encode(array('message' => 'Book not found'));
}
