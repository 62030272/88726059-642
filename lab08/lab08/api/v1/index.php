<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    return $response;
});

// 1 Retrieving All Books
$app->get('/books', function (Request $request, Response $response) {
    require_once('db.php');
    if ($conn->connect_errno) {
        return $conn->connect_errno;
    } else {
        $sql = "SELECT * 
                FROM books 
                ORDER BY id DESC";
        $result = $conn->query($sql);
        //var_dump($result);
        $data = array();
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return  json_encode($data);
    }
});

// 2 Retrieving a Books
$app->get('/book/{id}', function (Request $request, Response $response) {
    require_once('db.php');
    $id = $request->getAttribute('id');
    $sql = "SELECT * 
            FROM books 
            WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_object();
    return json_encode($row);
});

// 3 Search  Books
$app->get('/search/{kw}', function (Request $request, Response $response) {
    require_once('db.php');
    $kw = $request->getAttribute('kw');
    $sql = "SELECT * 
            FROM books 
            WHERE 1=1 AND concat(id,book_name,book_isbn,book_category) LIKE '%$kw%'
            ORDER BY id DESC";
    $result = $conn->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()){
        $data[] = $row; 
    } 
    return  json_encode($data);
});

// Creating a record
$app->post('/book', function (Request $request, Response $response) {
    require_once('db.php');
    $book_name = $request->getParsedBody()['book_name'];
    $book_isbn = $request->getParsedBody()['book_isbn'];
    $book_category = $request->getParsedBody()['book_category'];
    $sql = "INSERT 
            INTO books (book_name,book_isbn,book_category) 
            VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$book_name,$book_isbn,$book_category);
    $stmt->execute();
});

// Deleting a record
$app->delete('/book/{id}', function (Request $request, Response $response) {
    require_once('db.php');
    $id = $request->getAttribute('id');
    $sql = "DELETE 
            FROM books 
            WHERE id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("d",$id);
    $stmt->execute();
});

// Creating a record
$app->put('/book', function (Request $request, Response $response) {
    require_once('db.php');
    $id = $request->getParsedBody()['id'];
    $book_name = $request->getParsedBody()['book_name'];
    $book_isbn = $request->getParsedBody()['book_isbn'];
    $book_category = $request->getParsedBody()['book_category'];
    $sql = "UPDATE books 
            SET
                book_name = ?,
                book_isbn = ?, 
                book_category = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd",$book_name,$book_isbn,$book_category, $id);
    $stmt->execute();
});


// 
$app->get('/check', function($request){
    return "get";
});

$app->post('/check', function($request){
    return "post";
});

$app->put('/check', function($request){
    return "put";
});

$app->delete('/check', function($request){
    return "delete";
});

$app->run();