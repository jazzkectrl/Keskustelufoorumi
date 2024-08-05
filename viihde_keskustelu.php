
<?php


include("viihde_postaukset.php");
include("viihde_kommentit.php");
?>

<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Jarkon palsta - viihde keskustelu</title>

</head>

<body onload="kello()" style="background-color: aliceblue;">
<!-- navigointipalkki -->
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
     <!-- postauslomake -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 30vh;">
        <form method="post" action="" class="w-50">
            <div class="mb-4">
                <label for="nimi" class="form-label">Otsikko</label>
                <input type="text" name="nimi" class="form-control" id="nimi" placeholder="Otsikko">
            </div>
            <div class="mb-3">
                <label for="sisalto" class="form-label">Sisältö</label>
                <textarea name="sisalto" class="form-control" id="sisalto" rows="4" placeholder="Sisältö"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lähetä postaus</button>
        </form>
    </div>

    <div class="container">
        <h1>Viihde keskustelu</h1>
        <?php
        // hae postaukset tietokannasta
        $postaukset = tuoPostaukset();

        
        foreach ($postaukset as $postaus) {
            echo "<div class='mb-4'>";
            echo "<h3 style='color:purple;'>" . $postaus['nimi'] . "</h3>";
            echo "<p style='color: black;'>" . $postaus['sisalto'] . "</p>";
            echo "<p style='color:green;'>" . $postaus['pvm'] . " UTC</p>";

            // nappi kommenttien näyttämiseksi
            echo "<button class='btn btn-secondary' onclick='naytakommentit(" . $postaus['id'] . ")'>Näytä kommentit</button>";

            echo "<div id='comments-" . $postaus['id'] . "' style='display:none;' class='mt-3'>";

            // kommenttilomake
            echo "<form method='post' action='' class='mb-3'>";
            echo "<input type='hidden' name='post_id' value='" . $postaus['id'] . "'>";
            echo "<div class='mb-3'>";
            echo "<textarea name='comment_content' class='form-control comment-text' placeholder='Kirjoita kommentti'></textarea>";
            echo "</div>";
            echo "<button type='submit' name='comment_submit' class='btn btn-primary'>Lähetä kommentti</button>";
            echo "</form>";

            // nouda kommentit tietokannasta
            $kommentit = tuoKommentti($postaus['id']);
           
            foreach ($kommentit as $kommentti) {
                echo "<div class='mt-2'>";
                echo "<p style = 'color: blue;'>" . $kommentti['kommentti_sisalto'] . "</p>";
                echo "<p class='text-muted'>" . $kommentti['kommentti_pvm'] . " UTC</p>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        // javascripti kellolle
        function kello() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = muotoileAikaa(m);
            s = muotoileAika(s);
            document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
            setTimeout(kello, 1000);
        }
        // lisätään nolla numeroiden alkuun
        function muotoileAika(i) {
            if (i < 10) {
                i = "0" + i
            }; 
            return i;
        }
        // javascripti kommenttien piilottamiselle ja näyttämiselle
        function naytakommentit(postId) {
            var commentsDiv = document.getElementById('comments-' + postId);
            var button = commentsDiv.previousElementSibling;
            if (commentsDiv.style.display === 'none') {
                commentsDiv.style.display = 'block';
                button.innerHTML = 'Piilota kommentit';
            } else {
                commentsDiv.style.display = 'none';
                button.innerHTML = 'Näytä kommentit';
            }
        }

        
    </script>

</body>

</html>
