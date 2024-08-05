<!DOCTYPE html>
<html lang="fi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<title>Jarkon palsta</title>
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
      <br>
      <div class="container" style="background-color: #0a4b94;">
        <div class="row justify-content-md-center">
            <div class="col-12 col-lg-6 d-flex align-items-center">
                <p class="fs-1 text-center">Tervetuloa Suomen kuumimmalle keskustelupalstalle!</p> 
        </div>
        </div>
      </div>    
      <br>
    <div class="container">
        <div class="row justify-content-center"> 
            <div class="col-15 col-lg-15"> 
                <div class="card bg-dark text-dark">
                    <img class="card-img" src="aurinko.png" alt="Card image">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <p class="card-text">Tsekkaa säätiedot reaaliajassa mistäpäin maailmaa tahansa</p>
                        <a href="saa.php" class="btn btn-primary">Sää</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
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
  if (i < 10) {i = "0" + i};  
  return i;
}
</script>

</body>
</html>