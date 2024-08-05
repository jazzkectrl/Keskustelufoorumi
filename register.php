<!DOCTYPE html>
<html lang="fi">
<head>
  <title>Jarkon palsta - Rekisteröityminen</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body onload="kello()" style="background-color: aliceblue;">

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #0a4b94;">
        <div class="container">
            <a class="navbar-brand fs-1" style="color: hsla(261, 100%, 22%, 1)" href="projekti.php">Jarkon palsta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="projekti.php">Etusivu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="saa.php">Sää</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Keskustelu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="keskustelu.php">Yleinen keskustelu</a></li>
                            <li><a class="dropdown-item" href="urheilu_keskustelu.php">Urheilu</a></li>
                            <li><a class="dropdown-item" href="viihde_keskustelu.php">Viihde</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="col col-lg-2">
    <span style="color: black;">Kirjaudu &nbsp; <a href="register.php" style="color: black;">Rekisteröidy</a> <?php echo date("j.n.Y"); ?></span>
    <span id="txt" style="color: black;"></span>
</div>

            </div>
        </div>
    </nav>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ("tietokanta.php");

    $username = filter_input(INPUT_POST, "Käyttäjätunnus", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "Salasana", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "Sähköposti", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($username)) {
        echo "Syötä käyttäjätunnus";
    } elseif (empty($password)) {
        echo "Syötä salasana";	
    }
        elseif (empty($email)) {
        echo "Syötä sähköposti";
    
    } else {
        $result = syotaKayttaja($username, $password, $email);
        if ($result) {
            echo "Olet rekisteröitynyt";	
        } else {
            echo "Virhe rekisteröinnissä¤";
        }
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="form-group">
    <label for="Käyttäjätunnus">Käyttäjätunnus</label>
    <input type="text" class="form-control" id="Käyttäjätunnus" name="Käyttäjätunnus" placeholder="Anna käyttäjätunnus">
  </div>
  <div class="form-group">
    <label for="Sähköposti">Sähköposti</label>
    <input type="email" class="form-control" id="Sähköposti" name="Sähköposti" aria-describedby="emailHelp" placeholder="Anna sähköposti">
  </div>
  <div class="form-group">
    <label for="Salasana">Salasana</label>
    <input type="password" class="form-control" id="Salasana" name="Salasana" placeholder="Anna salasana">
  </div>
  <br>
  <button type="submit" class="btn btn-primary" id="Rekisteröidy">Rekisteröidy</button>
</form>
<script>
function kello() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = tarkistaAika(m);
  s = tarkistaAika(s);
  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(kello, 1000);
}

function tarkistaAika(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>

</body>
</html>
