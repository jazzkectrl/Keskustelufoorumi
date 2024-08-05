<?php




// funktio kommentin lisäämiseen tietokantaan
function syotaKommentti($post_id, $kommentti_sisalto) {
    
    $palvelin = "localhost";   
    $db_kayttajanimi = "jm";         
    $db_salasana = "Sipoo5";     
    $tietokanta = "jm";              
    
    try {
        // pdo yhteys tietokantaan
        $conn = new PDO("mysql:host=$palvelin;dbname=$tietokanta", $db_kayttajanimi, $db_salasana);
        
        //  sql lauseke kommentin lisäämiseksi
        $sql = "INSERT INTO kommentit (kommentti_id, post_id, kommentti_sisalto, kommentti_pvm) VALUES (NULL, :post_id, :kommentti_sisalto, NOW())";
        $stmt = $conn->prepare($sql);
        // liitetään parametrit sql lausekkeeseen
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':kommentti_sisalto', $kommentti_sisalto);
        // suoritetaan sql lauseke
        $stmt->execute();
        
        return true;
    } catch(PDOException $e) {
        
        echo "Tietokantayhteyden virhe: " . $e->getMessage();
        
        return false;
    }
}

// funktio hakee kommentit postaukselle
function tuoKommentti($post_id) {
    
    $palvelin = "localhost";
    $db_kayttajanimi = "jm";
    $db_salasana = "Sipoo5";
    $tietokanta = "jm";
    
    try {
        // pdo yhteys tietokantaan
        $conn = new PDO("mysql:host=$palvelin;dbname=$tietokanta", $db_kayttajanimi, $db_salasana);
        
        // sql lauseke kommenttien hakemiseksi
        $sql = "SELECT * FROM kommentit WHERE post_id = :post_id ";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':post_id', $post_id);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        // Tulostetaan virheilmoitus
        echo "Tietokantayhteyden virhe: " . $e->getMessage();
        // Palautetaan tyhjä taulukko, jos virhe tapahtuu
        return [];
    }
}

// tarkistetaan onko lomake lähetetty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_submit'])) {
    // tarkistetaan että kentät on täytetty
    if (!empty($_POST['comment_content'])) {
        // hae lomakkeen tiedot
        $kommentti_sisalto = $_POST['comment_content'];
        $post_id = $_POST['post_id']; // Lisätty post_id
        // lisätään kommentti tietokantaan
        if (syotaKommentti($post_id, $kommentti_sisalto)) {
            
            header("Location: keskustelu.php");
            exit(); 
        } else {
            echo "<p>Virhe lisättäessä kommenttia!</p>";
        }
    } else {
        echo "<p>Kommentin sisältö on pakollinen kenttä!</p>";
    }
}
?>
