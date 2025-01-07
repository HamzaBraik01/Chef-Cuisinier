<?php
session_start();
include 'connexion.php';

if (!isset($_SESSION['roleId']) || $_SESSION['roleId'] != 2) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['ID'];
$query1 = "SELECT r.*, m.NomMenu, u.Nom, u.Prenom 
            FROM reservation r 
            INNER JOIN menu m ON r.MenuID = m.ID 
            INNER JOIN utilisateur u ON r.UtilisateurID = u.ID 
            WHERE r.UtilisateurID = '$userId' 
            ORDER BY r.Date DESC, r.Heure DESC";

$result2 = mysqli_query($con, $query1);

if (isset($_POST['unset_session'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if (isset($_POST['cancel_reservation'])) {
    $reservationId = mysqli_real_escape_string($con, $_POST['reservation_id']);
    $updateQuery = "UPDATE reservation SET Statut = 'refuse' 
                    WHERE ID = '$reservationId' AND UtilisateurID = '$userId'";
    mysqli_query($con, $updateQuery);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
/*---------------------------------------------------------------------------*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'])) {
    $menuId = mysqli_real_escape_string($con, $_POST['menu_id']);
    $userId = $_SESSION['ID'];
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $heure = mysqli_real_escape_string($con, $_POST['heure']);
    $nombrePersonnes = mysqli_real_escape_string($con, $_POST['nombre_personnes']);

    $query2 = "INSERT INTO reservation (UtilisateurID, MenuID, Date, Heure, NombreDePersonnes, Statut) 
                VALUES ('$userId', '$menuId', '$date', '$heure', '$nombrePersonnes', 'en attente')";
    mysqli_query($con, $query2);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-500 to-purple-600 text-gray-700">       
    <div class="container mx-auto px-4 py-8">
        <button onclick="toggleReservation()" class="mb-4 bg-white text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-plus mr-2"></i>Réserver un nouveau menu
        </button>
        
        <header class="text-white mb-8">
            <h1 class="text-3xl md:text-4xl font-bold">Mes Réservations</h1>
            <p class="mt-2 text-white/90">Gérez vos réservations de restaurant</p>
        </header>
        <!-- Section des menus -->
        <div id="les_menu" class="hidden bg-white/80 backdrop-blur-md rounded-xl shadow-xl border border-white/20 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menuList">
                <?php
                $result1 = mysqli_query($con, "SELECT * FROM menu");
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo '
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="data:image/jpeg;base64,'.base64_encode($row['ImageMenu']).'" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">'.$row['NomMenu'].'</h3>
                            <p class="text-gray-600">'.$row['Description'].'</p>
                        </div>
                        <div class="p-4 border-t">
                            <h4 class="font-bold mb-2">Liste des Plats</h4>
                            <div class="space-y-2">';
                            
                    $plats = mysqli_query($con, "SELECT p.*, i.ImageBlob FROM plat p LEFT JOIN image i ON p.ID = i.PlatID WHERE p.MenuID = ".$row['ID']);
                    while ($plat = mysqli_fetch_assoc($plats)) {
                        echo '
                            <div class="flex items-center space-x-4 p-2 bg-gray-50 rounded">
                                <img src="data:image/jpeg;base64,'.base64_encode($plat['ImageBlob']).'" class="w-16 h-16 object-cover rounded">
                                <div>
                                    <h5 class="font-bold">'.$plat['NomPlat'].'</h5>
                                    <p class="text-sm text-gray-600">'.$plat['Description'].'</p>
                                    <p class="text-green-600 font-bold">'.$plat['Prix'].' €</p>
                                </div>
                            </div>';
                    }
                    echo '
                            </div>
                        </div>
                        <!-- Bouton Réserver -->
                        <div class="p-4 border-t">
                            <button onclick="toggleReservationform('.$row['ID'].')" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                <i class="fas fa-calendar-check mr-2"></i>Réserver ce menu
                            </button>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
        <!-- Modal de réservation -->
        <div id="reservationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">Réserver ce menu</h3>
                    <form method="post" action="">
                        <input type="hidden" id="menuIdInput" name="menu_id">
                        <div class="space-y-4">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                <input type="date" id="date" name="date" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="heure" class="block text-sm font-medium text-gray-700">Heure</label>
                                <input type="time" id="heure" name="heure" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="nombre_personnes" class="block text-sm font-medium text-gray-700">Nombre de personnes</label>
                                <input type="number" id="nombre_personnes" name="nombre_personnes" min="1" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" onclick="toggleReservationform()"
                                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                                Annuler
                            </button>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                Confirmer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur-md rounded-xl shadow-xl border border-white/20 overflow-hidden">
            <?php if (mysqli_num_rows($result2) == 0): ?>
                <div class="p-8 text-center">
                    <i class="fas fa-calendar-times text-4xl mb-4 text-purple-400"></i>
                    <p class="text-purple-600">Aucune réservation trouvée</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="text-left p-3 text-gray-700">Date</th>
                                <th class="text-left p-3 text-gray-700">Menu</th>
                                <th class="text-left p-3 text-gray-700">Heure</th>
                                <th class="text-left p-3 text-gray-700">Personnes</th>
                                <th class="text-left p-3 text-gray-700">Statut</th>
                                <th class="text-left p-3 text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php while ($row = mysqli_fetch_assoc($result2)): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">
                                        <i class="far fa-calendar text-gray-400 mr-2"></i>
                                        <?php echo date('d/m/Y', strtotime($row['Date'])); ?>
                                    </td>
                                    <td class="p-3">
                                        <i class="fas fa-utensils text-gray-400 mr-2"></i>
                                        <?php echo htmlspecialchars($row['NomMenu']); ?>
                                    </td>
                                    <td class="p-3">
                                        <i class="far fa-clock text-gray-400 mr-2"></i>
                                        <?php echo date('H:i', strtotime($row['Heure'])); ?>
                                    </td>
                                    <td class="p-3">
                                        <i class="fas fa-users text-gray-400 mr-2"></i>
                                        <?php echo $row['NombreDePersonnes']; ?>
                                    </td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded-full
                                            <?php echo $row['Statut'] == 'accepte' ? 'bg-green-100 text-green-800' : 
                                                ($row['Statut'] == 'refuse' ? 'bg-red-100 text-red-800' : 
                                                'bg-yellow-100 text-yellow-800'); ?>">
                                            <?php echo ucfirst($row['Statut']); ?>
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <?php if ($row['Statut'] == 'en attente' || $row['Statut'] == 'accepte'): ?>
                                            <form method="post">
                                                <input type="hidden" name="reservation_id" value="<?php echo $row['ID']; ?>">
                                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" type="submit" name="cancel_reservation">
                                                    Annuler
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Logout Button -->
        <form action="" method="post" class="mt-6">
            <button type="submit" name="unset_session" 
                    class="flex items-center gap-2 bg-white text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors border border-gray-200 shadow-sm">
                <i class="fas fa-sign-out-alt"></i>
                Se déconnecter
            </button>
        </form>
    </div>
    <script>
        function toggleReservation() {
            var menuList = document.getElementById('les_menu');
            if (menuList.classList.contains('hidden')) {
                menuList.classList.remove('hidden');
            } else {
                menuList.classList.add('hidden');
            }
        }
        function toggleReservationform(menuId) {
            const modal = document.getElementById('reservationModal');
            const menuIdInput = document.getElementById('menuIdInput');
            menuIdInput.value = menuId; 
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
        window.onclick = function (event) {
            const modal = document.getElementById('reservationModal');
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        };
    </script>
</body>

</html>
