<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Mes Réservations</h1>
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                + Nouvelle Réservation
            </button>
        </div>

        <div class="p-4">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3">Date</th>
                        <th class="text-left p-3">Service</th>
                        <th class="text-left p-3">Heure</th>
                        <th class="text-left p-3">Statut</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="p-3">15/03/2024</td>
                        <td class="p-3">Consultation médicale</td>
                        <td class="p-3">10:00</td>
                        <td class="p-3">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                Confirmé
                            </span>
                        </td>
                        <td class="p-3 space-x-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Modifier
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Annuler
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3">02/04/2024</td>
                        <td class="p-3">Examen dentaire</td>
                        <td class="p-3">14:30</td>
                        <td class="p-3">
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                En attente
                            </span>
                        </td>
                        <td class="p-3 space-x-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Modifier
                            </button>
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Annuler
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3">20/02/2024</td>
                        <td class="p-3">Radiographie</td>
                        <td class="p-3">11:15</td>
                        <td class="p-3">
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">
                                Terminé
                            </span>
                        </td>
                        <td class="p-3 space-x-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Détails
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>