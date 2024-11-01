<?php 

class library {
    protected $db;
    protected $table;

    function __construct($s_user, $s_pass, $s_name, $s_host, $table = "books") {
        /**
         * Sınıf kurulum fonksiyonu
         * s_user: veritabanı kullanıcı adı
         * s_pass: veritabanı şifresi
         * s_name: veritabanı adı
         * s_host: veritabanı sunucusu
         * books: kullanıcı verilerinin tutulacağı kısım
         */
        try {
            $this->db = new PDO("mysql:host=".$s_host.";dbname=".$s_name, $s_user, $s_pass);
            $this->table = $table;

            try {
                $result = $this->db->query("SHOW TABLES LIKE '$this->table'");
                if($result->rowCount() < 1){
                    try {
                        $sql = "CREATE TABLE IF NOT EXISTS ".$this->table." (
                            book_id INT AUTO_INCREMENT PRIMARY KEY,
                            title VARCHAR(255) NOT NULL,
                            author VARCHAR(255) NOT NULL,
                            publisher VARCHAR(255),
                            genre VARCHAR(100),
                            publication_year YEAR,
                            isbn VARCHAR(20) UNIQUE,
                            pages INT,
                            language VARCHAR(50),
                            description TEXT,
                            availability TINYINT DEFAULT 1
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                    
                        // Sorguyu çalıştır
                        $this->db->exec($sql);
                        
                        return true;
                    } catch(PDOException $e) {
                        return "Tablo oluşturma hatası";
                    }
                        
                }
            } catch (PDOException $e) {
                echo "Tablo doğrulama hatası: " . $e->getMessage();
                return false;
            }
            
        } catch (PDOException $e) {
            echo "Sunucu bağlantı hatası, bilgileri kontrol edin! Hata: " . $e->getMessage();
        }
    }

    function addBook($title, $author, $publisher, $genre, $year, $isbn, $pages, $language, $description, $availability){
        $nRows = $this->db->query('select count(*) from '.$this->table.' WHERE isbn = '.$isbn)->fetchColumn(); 
        if($nRows == 0){
            try {
             
                $stmt = $this->db->prepare("INSERT INTO $this->table (title, author, publisher, genre, publication_year, isbn, pages, language, description, availability) 
                           VALUES (:title, :author, :publisher, :genre, :publication_year, :isbn, :pages, :language, :description, :availability)");
                $stmt->execute([
                    ':title' => $title,
                    ':author' => $author,
                    ':publisher' => $publisher,
                    ':genre' => $genre,
                    ':publication_year' => $year,
                    ':isbn' => $isbn,
                    ':pages' => $pages,
                    ':language' => $language,
                    ':description' => $description,
                    ':availability' => $availability
                ]);
                return true;
            } catch (PDOException $e) {
                return $e;
            }

        }else{
            return false;
        }
    }

    function removeBook($book_id){
        $nRows = $this->db->query('select count(*) from '.$this->table.' WHERE book_id = '.$book_id)->fetchColumn(); 
        if($nRows == 1){
            $query = $this->db->prepare("DELETE FROM $this->table WHERE book_id = :id");
            $delete = $query->execute(array(
                'id' => $book_id
            ));

            if($delete){
                return true;
            }else{
                return false;
            }
        }
    }

    function listBooks(){
        try {
            $query = $this->db->query("SELECT * FROM {$this->table} WHERE availability = 1", PDO::FETCH_ASSOC);
            if ( $query->rowCount() ){
                $result = $query->fetchAll();
                return $result;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    function getBookByID($book_id){
        try {
            $query = $this->db->query("SELECT * FROM {$this->table} WHERE book_id = $book_id", PDO::FETCH_ASSOC);
            if ( $query->rowCount() ){
                $result = $query->fetch();
                return $result;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    function getBookByISBN($isbn){
        try {
            $query = $this->db->query("SELECT * FROM {$this->table} WHERE isbn = $isbn", PDO::FETCH_ASSOC);
            if ( $query->rowCount() ){
                $result = $query->fetchAll();
                return $result[0];
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    function changeAvailability($book_id){
        $oavailability = $this->getBookByID($book_id)['availability'];
        if($oavailability == 0){
            $navailability = 1;
        }else{
            $navailability = 0;
        }
        $query = $this->db->prepare("UPDATE $this->table SET availability = :navailability WHERE book_id = :book_id"); 
        $update = $query->execute(array(
            "navailability" => $navailability,
            "book_id" => $book_id
        ));
        if ( $update ){
            return true;
        }
        
    }
}


?>
