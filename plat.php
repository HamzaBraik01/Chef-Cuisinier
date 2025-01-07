<?php
include 'connexion.php';
// Traitement de l'ajout d'un plat
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dish_name'])) {
    $nom = mysqli_real_escape_string($con, $_POST['dish_name']);
    $description = mysqli_real_escape_string($con, $_POST['dish_description']);
    $prix = floatval($_POST['dish_price']);
    $menuId = $_POST['menu_id'];
    $image = file_get_contents($_FILES['dish_image']['tmp_name']);
    
    // Insertion du plat
    $sql = "INSERT INTO plat (NomPlat, Description, Prix, MenuID) VALUES ('$nom', '$description', $prix, $menuId)";
    mysqli_query($con, $sql);
    $platId = mysqli_insert_id($con);
    
    // Insertion de l'image
    $sql = "INSERT INTO image (ImageBlob, PlatID) VALUES ('" . mysqli_real_escape_string($con, $image) . "', $platId)";
    mysqli_query($con, $sql);
    header("Location: DashboardChef.php");
    
}
?>