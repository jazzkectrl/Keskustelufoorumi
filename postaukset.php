<?php


function syotaPostaukset($nimi, $sisalto) {
    
    $servername = "localhost";   
    $db_username = "jm";         
    $db_password = "Sipoo5";     
    $dbname = "jm";              
    
    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        
        
        $sql = "INSERT INTO postaukset (nimi, sisalto, pvm) VALUES (:nimi, :sisalto, NOW())";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nimi', $nimi);
        $stmt->bindParam(':sisalto', $sisalto);
        
        $stmt->execute();
        
        return true;
    } catch(PDOException $e) {
        
        echo "Tietokantayhteyden virhe: " . $e->getMessage();
        
        return false;
    }
}


function tuoPostaukset() {
    
    $servername = "localhost";
    $db_username = "jm";
    $db_password = "Sipoo5";
    $dbname = "jm";
    
    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        
       
        $sql = "SELECT * FROM postaukset ORDER BY pvm DESC";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        
        echo "Tietokantayhteyden virhe: " . $e->getMessage();
        
        return [];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!empty($_POST['nimi']) && !empty($_POST['sisalto'])) {
        
        $nimi = $_POST['nimi'];
        $sisalto = $_POST['sisalto'];
        
        
        if (syotaPostaukset($nimi, $sisalto)) {
            
            header("Location: keskustelu.php");
            exit(); 
        } else {
            echo "<p>Virhe lisättäessä postausta!</p>";
        }
    } else {
        echo "<p>Otsikko ja sisältö ovat pakollisia kenttiä!</p>";
    }
}
?>
