<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/svg+xml" href="img/tab-icon.svg">
    <audio src="audio/hover.mp3" id="audio"></audio>
    <title>Rent-A-Bike Parzentny</title>
</head>
<body>

    <!-- NAVBAR SECTION -->

    <div class="nav__container">
        <nav class="navbar">
            <h1 id="navbar__logo">Rent-A-Bike Parzentny</h1>
            <div class="menu__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav__menu">
                <li><a href="#" class="nav__links">Home</a></li>
                <li><a href="#" class="nav__links">Fuhrpark</a></li>
                <li><a href="#" class="nav__links">Tarife</a></li>
                <?php
                    if (isset($_SESSION['role'])) {
                        if (strcasecmp($_SESSION['role'], "user") == 0) {
                            echo "<li><a href='user/dash.user.php' class='nav__links'>Mein Konto</a></li>";
                            echo "<li><a href='inc/logout.inc.php' class='nav__links nav_links_btn'>Ausloggen</a></li>";
                        } else if (strcasecmp($_SESSION['role'], "admin") == 0) {
                            echo "<li><a href='admin/dash.admin.php' class='nav__links'>Admin Panel</a></li>";
                            echo "<li><a href='inc/logout.inc.php' class='nav__links nav_links_btn'>Ausloggen</a></li>";
                        }
                    } else {
                        echo "<li><a href='#' class='nav__links nav_links_btn' id='login_btn'>Login</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>

    <!-- HERO SECTION -->

    <div class="main">
        <div class="main__container">
            <div class="main__content">
                <h1>Die nächste <span>Generation</span> der E-Bike Vermietung</h1>
                <p>Die beste E-Bike Vermietung seit geschnitten Brot!</p>
                <?php
                    if (isset($_SESSION['role'])) {
                        if (strcasecmp($_SESSION['role'], "user") == 0) {
                            echo "<button class='main__btn'><a href='#'>Jetzt losfahren</a></button>";
                        } else if (strcasecmp($_SESSION['role'], "admin") == 0) {
                            echo "<button class='main__btn'><a href='#'>Jetzt losfahren</a></button>";
                        }
                    } else {
                        echo "<button class='main__btn' id='main__register'><a href='#'>Jetzt losfahren</a></button>";
                    }
                ?>
            </div>
            <div class="main_img_container">
                <img src="img/Bicycle.svg" alt="Picture not found!" id="main_img">
            </div>
        </div>
    </div>

    <!-- MODAL SECTION -->

    <div class="modal" id="email-modal-register">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div class="modal-content-left">
                <img id="modal-img" src="img/signup.svg" alt="Picture not found!">
            </div>
            <div class="modal-content-right">
                <form method="POST" action="inc/signup.inc.php" class="modal-form" id="form">
                    <h1>Fahre jetzt mit uns in eine sonnenreiche Zukunft!</h1>
                    <div class="form-validation">
                        <input type="text" class="modal-input" id="firstname" name="firstname" placeholder="Vorname..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="text" class="modal-input" id="lastname" name="lastname" placeholder="Nachname..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="text" class="modal-input" id="telephone" name="telephone" placeholder="Telefon..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="email" class="modal-input" id="email" name="email" placeholder="E-Mail..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="password" class="modal-input" id="password" name="password" placeholder="Passwort..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="password" class="modal-input" id="passwordRepeat" name="passwordRepeat" placeholder="Passwort wiederholen..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="text" class="modal-input" id="street" name="street" placeholder="Straße..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <?php
                            include_once 'inc/db.inc.php';
                            $query = $conn->query("SELECT * FROM town");

                            echo '<select name="postalcode" id="postalcode" class="dropdown" required>';
                            echo '<option value="" disabled selected hidden>Ort...</option>';
                            while ($row = $query->fetch_assoc()) {
                                echo "<option value='" . $row['ZIP'] ."'>" . $row['town'] ."</option>";
                            }
                            echo "</select>";
                        ?>
                        <p>Error</p>
                    </div>
                    <input type="submit" id="submit" name="submit" class="modal-input-btn" value="Registrieren">
                    <span class="modal-input-login">Sie besitzen bereits einen Account? <a href="" id="openViaRegister">hier</a> anmelden </span>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL LOGIN -->

    <div class="modall" id="email-modal-login">
        <div class="modall-content">
            <span class="close-btn2">&times;</span>
            <div class="modall-content-left">
                <img id="modall-img" src="img/login.svg" alt="Picture not found!">
            </div>
            <div class="modall-content-right">
                <form method="POST" action="inc/login.inc.php" class="modall-form" id="form">
                    <h1>Fahre jetzt mit uns in eine sonnenreiche Zukunft!</h1>
                    <div class="form-validation">
                        <input type="email" class="modal-input" id="email" name="email" placeholder="Email..." required>
                        <p>Error</p>
                    </div>
                    <div class="form-validation">
                        <input type="password" class="modal-input" id="password" name="password" placeholder="Passwort..." required>
                        <p>Error</p>
                    </div>
                    <input type="submit" id="submit" name="submit" class="modal-input-btn" value="Login">
                    <span class="modal-input-register">Sie besitzen noch keinen Account? <a id="openViaLogin">hier</a> registrieren </span>
                </form>
            </div>
        </div>
    </div>

    <!-- GALLERY -->

    <div class="tarife-section">
        <div class="tarife-heading">
            <h1>Unsere Tarife</h1>
        </div>

        <div class="tarife">
            <div class="tarife-cell">
                <img src="img/gallery/Pic1.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Tages Tarif</div>
            </div>
            <div class="tarife-cell">
                <img src="img/gallery/Pic2.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Wochenend Tarif</div>
            </div>
            <div class="tarife-cell">
                <img src="img/gallery/Pic3.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Wochen Tarif</div>
            </div>
            <div class="tarife-cell">
                <img src="img/gallery/Pic4.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Monats Tarif</div>
            </div>
            <div class="tarife-cell">
                <img src="img/gallery/Pic5.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Jahres Tarif</div>
            </div>
            <div class="tarife-cell">
                <img src="img/gallery/Pic6.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Abo Modell</div>
            </div>
            <div class="tarife-cell">
                <img src="img/gallery/Pic7.jpg" alt="Picture not found!" class="tarife-cell_img">
                <div class="tarife-cell_text">Leasing</div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->

    <div class="footer-container">
        <div class="footer">
            <div class="footer-heading footer-1">
                <h2>Über Uns</h2>
                <a href="#">Impressum</a>
                <a href="#">Datenschutz</a>
            </div>
            <div class="footer-heading footer-2">
                <h2>Kontakt</h2>
                <a href="#">Jobs</a>
                <a href="#">Support</a>
                <a href="#">Kontakt</a>
            </div>
            <div class="footer-heading footer-3">
                <h2>Social Media</h2>
                <a href="#">Instagram</a>
                <a href="#">GitHub</a>
                <a href="#">YouTube</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </div>


    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="javascript/app.js"></script>
</body>
</html>