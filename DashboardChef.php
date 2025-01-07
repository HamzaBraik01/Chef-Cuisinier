<?php
session_start();
include 'connexion.php'; 
if (!isset($_SESSION['roleId']) || $_SESSION['roleId'] != 1) {
    header("Location: login.php"); 
    exit();
}
if (isset($_POST['unset_session'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
/*-------------------------------------------------------------------------*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $statut = $_POST['statut'];
    $query = "UPDATE reservation SET Statut = ? WHERE ID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'si', $statut, $id);
    mysqli_stmt_execute($stmt);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
/*--------------------------------------------------------------------------*/
$totalClients = 0;
$queryClients = "SELECT COUNT(*) AS total FROM utilisateur WHERE RoleID=2";
$resultClients = mysqli_query($con, $queryClients);
if ($resultClients) {
    $row = mysqli_fetch_assoc($resultClients);
    $totalClients = $row['total'];
}
/*------------------------------------------------------------------*/
$dateAujourdhui = date('Y-m-d');
$dateDemain = date('Y-m-d', strtotime('+1 day'));
$reservationsAujourdhui = 0;
$reservationsDemain = 0;
$reservationsenAttente = 0;

$queryAujourdhui = "SELECT COUNT(*) AS total FROM reservation WHERE Date = '$dateAujourdhui' AND Statut = 'accepte'";
$resultAujourdhui = mysqli_query($con, $queryAujourdhui);
if ($resultAujourdhui) {
    $row = mysqli_fetch_assoc($resultAujourdhui);
    $reservationsAujourdhui = $row['total'];
}
$queryDemain = "SELECT COUNT(*) AS total FROM reservation WHERE Date = '$dateDemain' AND Statut = 'accepte'";
$resultDemain = mysqli_query($con, $queryDemain);
if ($resultDemain) {
    $row = mysqli_fetch_assoc($resultDemain);
    $reservationsDemain = $row['total'];
}
$queryenAttente = "SELECT COUNT(*) AS total FROM reservation WHERE Statut = 'en attente'";
$resultenAttente = mysqli_query($con, $queryenAttente);
if ($resultenAttente) {
    $row = mysqli_fetch_assoc($resultenAttente);
    $reservationsenAttente = $row['total'];
}
/*-----------------------------------------------------------------------------------*/
// Requête pour les prochaines réservations
$queryReservations = "SELECT r.*, u.Nom, u.Prenom FROM reservation r JOIN utilisateur u ON r.UtilisateurID = u.ID WHERE r.Statut = 'accepte' AND r.Date >= '$dateAujourdhui' ORDER BY r.Date ASC limit 1 ";
$resultReservations = mysqli_query($con, $queryReservations);
/*-----------------------------------------------------------------------------------*/
// Requête pour obtenir les réservations
$query = "SELECT r.*, u.Nom, u.Prenom, m.NomMenu FROM reservation r JOIN utilisateur u ON r.UtilisateurID = u.ID JOIN menu m ON r.MenuID = m.ID";
$result = mysqli_query($con, $query);
/*---------------------------------------------------------------------------------------*/

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-500 to-purple-600 text-gray-700">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-8">Dashboard Admin</h1>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Carte Demandes en Attente -->
            <div class="bg-white/80 rounded-lg shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Demandes en Attente</h2>
                        <p class="text-3xl font-bold text-yellow-600"><?= $reservationsenAttente ?></p>
                    </div>
                    <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Carte Réservations Aujourd'hui -->
            <div class="bg-white/80 rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Réservations Aujourd'hui</h2>
                        <p class="text-3xl font-bold text-green-600"><?= $reservationsAujourdhui ?></p>
                    </div>
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>

            <!-- Carte Réservations Demain -->
            <div class="bg-white/80 rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Réservations Demain</h2>
                        <p class="text-3xl font-bold text-blue-600"><?= $reservationsDemain ?></p>
                    </div>
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>

            <!-- Carte Total Clients -->
            <div class="bg-white/80 rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Total Clients</h2>
                        <p class="text-3xl font-bold text-purple-600"><?= $totalClients ?></p>
                    </div>
                    <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Section pour afficher les prochaines réservations -->
        <div class="bg-white/80 rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Prochaines Réservations</h2>
            <?php if (mysqli_num_rows($resultReservations) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($resultReservations)): ?>
                    <div class="reservation-item flex items-center justify-between mb-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-700"><?php echo htmlspecialchars($row['Prenom'] . ' ' . $row['Nom']); ?></p>
                            <p class="text-gray-600">Date : <?php echo date('d M Y', strtotime($row['Date'])); ?></p>
                            <p class="text-gray-600">Heure : <?php echo htmlspecialchars($row['Heure']); ?></p>
                        </div>
                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Confirmée
                        </button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-600">Aucune réservation à venir.</p>
            <?php endif; ?>
        </div>

        <!-- Tableau des Réservations -->
        <div class="bg-white/80 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Réservations</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left text-gray-600">Client</th>
                            <th class="p-3 text-left text-gray-600">NomMenu</th>
                            <th class="p-3 text-left text-gray-600">Nombre De Personnes</th>
                            <th class="p-3 text-left text-gray-600">Date</th>
                            <th class="p-3 text-left text-gray-600">Heure</th>
                            <th class="p-3 text-left text-gray-600">Statut</th>
                            <th class="p-3 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?php echo htmlspecialchars($row['Prenom'] . ' ' . $row['Nom']); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($row['NomMenu']); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($row['NombreDePersonnes']); ?></td> 
                            <td class="p-3"><?php echo date('d/m/Y', strtotime($row['Date'])); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($row['Heure']); ?></td>
                            <td class="p-3">
                                <span class="<?php 
                                    if ($row['Statut'] == 'accepte') {
                                        echo 'bg-green-100 text-green-800'; 
                                        $statusText = 'Acceptée';
                                    } elseif ($row['Statut'] == 'refuse') {
                                        echo 'bg-red-100 text-red-800';
                                        $statusText = 'Refusée'; 
                                    } else {
                                        echo 'bg-yellow-100 text-yellow-800';
                                        $statusText = 'En Attente'; 
                                    }
                                ?> px-2 py-1 rounded-full">
                                    <?php echo $statusText; ?>
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="flex space-x-2">
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                        <input type="hidden" name="statut" value="accepte">
                                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600" type="submit">
                                            Accepter
                                        </button>
                                    </form>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                        <input type="hidden" name="statut" value="refuse">
                                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" type="submit">
                                            Refuser
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Nouvelle section Gestion des Menus -->
        <div class="mt-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white/90">Gestion des Menus</h2>
                <button onclick="openMenuModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                    Ajouter un Menu
                </button>
            </div>
    
            <!-- Liste des Menus -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="menuList">
                <?php
                $result = mysqli_query($con, "SELECT * FROM menu");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="data:image/jpeg;base64,'.base64_encode($row['ImageMenu']).'" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">'.$row['NomMenu'].'</h3>
                            <p class="text-gray-600">'.$row['Description'].'</p>
                            <div class="mt-4">
                                <button onclick="openDishModal('.$row['ID'].')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Ajouter un Plat
                                </button>
                            </div>
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
                                    <p class="text-green-600 font-bold">'.$plat['Prix'].' DH</p>
                                </div>
                            </div>';
                    }
                    echo '
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
        <form action="" method="post" class="mt-6">
            <button type="submit" name="unset_session" 
                    class="flex items-center gap-2 bg-white text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors border border-gray-200 shadow-sm">
                <i class="fas fa-sign-out-alt"></i>
                Se déconnecter
            </button>
        </form>
        
    </div>
    
    
    <!-- Modal Ajouter Menu -->
    <div id="menuModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-2xl font-bold mb-4">Ajouter un Menu</h2>
                <form action="menu.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="text" name="menu_name" placeholder="Nom du Menu" class="w-full border rounded p-2" required>
                    <textarea name="menu_description" placeholder="Description du Menu" class="w-full border rounded p-2" required></textarea>
                    <input type="file" name="menu_image" accept="image/*" class="w-full border rounded p-2" required>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeMenuModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">
                            Annuler
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
    </div>

    <!-- Modal Ajouter plat -->
    <div id="dishModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-2xl font-bold mb-4">Ajouter un Plat</h2>
                <form action="plat.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="menu_id" id="menu_id_input">
                    <input type="text" name="dish_name" placeholder="Nom du Plat" class="w-full border rounded p-2" required>
                    <textarea name="dish_description" placeholder="Description du Plat" class="w-full border rounded p-2" required></textarea>
                    <input type="number" name="dish_price" step="0.01" placeholder="Prix" class="w-full border rounded p-2" required>
                    <input type="file" name="dish_image" accept="image/*" class="w-full border rounded p-2" required>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeDishModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">
                            Annuler
                        </button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
    </div>

    <script>
        function openMenuModal() {
            document.getElementById('menuModal').classList.remove('hidden');
        }

        function closeMenuModal() {
            document.getElementById('menuModal').classList.add('hidden');
        }

        function openDishModal(menuId) {
            document.getElementById('menu_id_input').value = menuId;
            document.getElementById('dishModal').classList.remove('hidden');
        }

        function closeDishModal() {
            document.getElementById('dishModal').classList.add('hidden');
        }

        
        window.onclick = function(event) {
            let menuModal = document.getElementById('menuModal');
            let dishModal = document.getElementById('dishModal');
            if (event.target == menuModal) {
                closeMenuModal();
            }
            if (event.target == dishModal) {
                closeDishModal();
            }
        }
    </script>

</body>
</html>