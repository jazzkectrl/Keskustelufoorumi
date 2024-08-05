<?php
function syotaKayttaja($username, $password, $email) {
    $servername = "localhost";
    $db_username = "jm";
    $db_password = "Sipoo5";
    $dbname = "jm";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO kayttajat (kayttajatunnus, salasana, sahkoposti) VALUES (:username, :password, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hash);
        $stmt ->bindParam(':email', $email);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return false;
    }
}