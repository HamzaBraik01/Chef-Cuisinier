<?php
include 'connexion.php';
// Traitement de l'ajout d'un menu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_name'])) {
    $nom = mysqli_real_escape_string($con, $_POST['menu_name']);
    $description = mysqli_real_escape_string($con, $_POST['menu_description']);
    $image = file_get_contents($_FILES['menu_image']['tmp_name']);
    $sql = "INSERT INTO menu (NomMenu, Description, ImageMenu) VALUES ('$nom', '$description', '" . mysqli_real_escape_string($con, $image) . "')";
    mysqli_query($con, $sql);
    header("Location: DashboardChef.php");
    
}
?>