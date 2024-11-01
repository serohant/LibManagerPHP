<?php

include 'library.class.php';

$username = "root";
$pass = "";
$server = "localhost";
$name = "kys";
$table = "books";

$library = new library($username, $pass, $name, $server, $table);

// Add new book

$title = "Kürk Mantolu Madonna";
$author = "Sabahattin Ali";
$publisher = "Kor Kitap";
$genre = "Psikolojik Roman";
$year = 2019;
$isbn = 9786052283530;
$pages = 168;
$lang = "tr";
$description = 'Kürk Mantolu Madonna, edebiyatimizda düsle gerçegin kesistigi noktalariyla askin yüceliginin, sevginin birlestiriciligiyle vazgeçilmezliginin romanidir. Yasama sevincinin sürekliligine, yalnizlik karsisinda birliktelige yakilmis bir türküdür. Gerçekligi bundandir. -Adnan Özyalçiner "Dün basimdan garip bir hadise geçti ve bana on sene evvelki baska birtakim hadiseleri yeniden yasatti. Unutup gittigimi zannettigim bu hatiralarin, bundan sonra beni hiç birakmayacaklarini biliyorum... Hangi hain tesadüf dün onlari yolumun üstüne çikardi ve beni, senelerden beri dalmis oldugum derin uykudan, artik yavas yavas alistigim hissiz uyusukluktan ayirdi. Deli olacagim, yahut ölecegim dersem yalan öylemis olurum. Insan tahammül edemeyecegini zannettigi seylere pek çabuk alisiyor ve katlaniyor. Ben de yasayacagim... Ama nasil yasayacagim..."';
$availability = 1;

$library->addBook($title, $author, $publisher, $genre, $year, $isbn, $pages, $lang, $description, $availability);


// Remove book

$book_id = 1;

$library->removeBook($book_id);


// List books

$library->listBooks();


// get book by

    // ID
    $book_id = 2;
    $library->getBookByID($book_id);

    // ISBN

    $isbn = 9786052283530;
    $library->getBookByISBN($isbn);



// Change Availability

$book_id = 2;
$library->changeAvailability($book_id);

?>
