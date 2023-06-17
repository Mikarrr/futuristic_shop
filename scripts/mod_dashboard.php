<?php
session_start();
require_once "check_login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link rel="stylesheet" type="text/css" href="../styles/style_admin_dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400,700&display=swap" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <title>Panel CRUD - Users and Products</title>
</head>

<body>
    <div class="cursor"></div>
    <header class="header">
        <ul class="nav-links">
            <li><a href="logout.php" class="header__sign-in animate__animated animate__fadeInLeft">Logout</a></li>
            <li><a href="./mod_dashboard.php" class="header__sign-in animate__animated animate__fadeInLeft">My
                    account</a></li>
        </ul>

        <h1 class="header__logo animate__animated animate__fadeInUp">
            FUTURISTIC
        </h1>
        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <nav class="header__navigation animate__animated animate__fadeInRight">
            <label for="menu-toggle" class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <ul class="nav-links">
                <li><a href="../pages/moderator_pages/indexhtml.php">Home</a></li>
                <li><a href="../pages/moderator_pages/productshtml.php">Products</a></li>
                <li><a href="../pages/moderator_pages/abouthtml.php">About</a></li>
                <li><a href="../pages/moderator_pages/contacthtml.php">Contact</a></li>
                <li>
                    <a href="../pages/moderator_pages/shoppingCarthtml.php"><i
                            class="fas fa-shopping-cart cart-icon"></i></a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="crud_panel animate__animated animate__fadeInUp">
        <div>
            <h1>CRUD-panel-mod</h1>
            <?php
                //Utworzenie połączenia z bazą
                require_once "connect.php";

                // Usunięcie użytkownika
                if (isset($_GET['delete'])) {
                    $userId = $_GET['delete'];

                    $deleteSql = "DELETE FROM Users WHERE id = $userId";
                    if ($conn->query($deleteSql) === TRUE) {
                    echo "Użytkownik został pomyślnie usunięty.";
                    } else {
                    echo "Błąd podczas usuwania użytkownika: " . $conn->error;
                    }
                }


                // Pobranie danych użytkowników
                $sql = "SELECT * FROM Users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Wyświetlenie tabelki
                    echo "  <br>
                            <br>
                            <table>
                            <tr>
                            <th>ID</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Email</th>
                            <th>Type</th>
                            </tr>";
                    while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["firstName"]."</td>
                            <td>".$row["lastName"]."</td>
                            <td>".$row["email"]."</td>
                            <td>".$row["role"]."</td>
                            <td><a class='btn btn-danger' href='?delete=".$row["id"]."'>Delete</a></td>
                            <td><a class='btn' href='edit_user_mod.php?id=".$row["id"]."'>Edit</a></td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No user data.";
                }

                $conn->close();
            ?>

        </div>
    </div>

    <footer class="animate__animated animate__fadeInUp">
        <div class="footer-container">
            <div class="privacy-policy">
                <a href="#">Privacy policy</a>
            </div>
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="returns-delivery">
                <a href="#">Deliveries & Returns</a>
            </div>
            <p>Created by FUTURISTIC &copy; 2023</p>
        </div>
    </footer>
    <script src=" ./cursor.js"></script>
</body>

</html>
