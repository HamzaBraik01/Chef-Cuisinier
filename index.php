<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChefExcellence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Open Sans', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="font-sans">
    <!-- Header -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
        <div class="container mx-auto flex justify-between items-center p-4">
            <!-- Logo -->
            <a href="index.php" class="flex items-center">
                <img src="./img/logo.png" alt="Chef Excellence Logo" class="h-10">
                <span class="ml-2 text-dark text-xl font-semibold">Chef</span>
                <span class="text-blue-600 text-xl font-semibold">Excellence</span>
            </a>

            <!-- Mobile Toggle -->
            <button id="mobile-toggle" class="md:hidden" aria-label="Toggle navigation">
                <i class="bx bx-menu text-2xl"></i>
            </button>

            <!-- Navigation -->
            <div id="mobile-menu"class="hidden md:flex items-center space-x-4">
                <a href="index.php" class="px-3 py-2 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">Home</a>
                <a href="#about" class="px-3 py-2 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">About</a>
                <a href="#menus" class="px-3 py-2 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">Menu</a>
                <a href="#contact" class="px-3 py-2 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">Contact</a>
                <a href="login.php" class="text-blue-600">
                    <i class="bx bx-user-circle text-2xl"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Banner Hero -->
    <div class="pt-24 bg-cover bg-no-repeat" style="background-image: url('./img/cover3.jpg'); height: 100vh;">
        <div class="container mx-auto px-4 py-36 flex justify-end height: h-full"> 
            <div class="max-w-2xl text-center"> 
                <h1 class="text-5xl font-bold text-white mb-6">
                    Discover Our <span class="text-blue-600">Delicious Menu</span>
                    <br>Crafted Just for You
                </h1>
                <p class="text-gray-300 mb-8">
                    Indulge in a culinary experience like no other. Explore our carefully curated menu, featuring fresh ingredients and dishes crafted to perfection.
                </p>
                <a href="#menus" class="inline-block px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                    View Menu
                </a>
            </div>
        </div>
    </div>

    <section id="about" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-culinary-primary mb-12">À Propos du Chef</h2>
            
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <img src="./img/chefportf.jpg" alt="Chef Portrait" class="rounded-lg shadow-lg">
                </div>
                <div>
                    <h3 class="text-3xl font-semibold text-culinary-secondary mb-6">Chef Michel Dupont</h3>
                    <p class="text-gray-700 mb-4">
                        Passionné par la gastronomie depuis son plus jeune âge, le Chef Michel Dupont a parcouru le monde à la recherche des saveurs les plus exceptionnelles. Formé dans les meilleures écoles culinaires de France, il a travaillé dans des restaurants étoilés Michelin à Paris, Tokyo et New York.
                    </p>
                    <p class="text-gray-700 mb-4">
                        Sa philosophie culinaire repose sur le respect des ingrédients, la créativité et la précision technique. Chaque plat est une histoire, un voyage sensoriel qui transporte les convives au-delà des frontières gastronomiques traditionnelles.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        
                        <a href="#contact" 
                        class="inline-block px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                        Me Contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    
    <!-- Menus Section -->
    <section id="menus" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-culinary-primary mb-12">Nos Menus Exclusifs</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Menu Card 1 -->
                <div class="bg-gray-100 rounded-lg shadow-lg overflow-hidden">
                    <img src="./img/Menu1.jpg" alt="Menu Gastronomique" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-culinary-secondary mb-4">Menu Dégustation</h3>
                        <p class="text-gray-600 mb-4">Un voyage culinaire à travers 5 plats signatures, accordés avec des vins sélectionnés.</p>
                        <button onclick="showMenuDetails('degustation')" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
                            Voir les Plats
                        </button>
                    </div>
                </div>

                <!-- Menu Card 2 -->
                <div class="bg-gray-100 rounded-lg shadow-lg overflow-hidden">
                    <img src="./img/Menu2.jpg" alt="Menu Végétarien" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-culinary-secondary mb-4">Menu Végétarien</h3>
                        <p class="text-gray-600 mb-4">Des saveurs végétales raffinées, un hommage à la nature et à la créativité.</p>
                        <button onclick="showMenuDetails('vegetarien')" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
                            Voir les Plats
                        </button>
                    </div>
                </div>

                <!-- Menu Card 3 -->
                <div class="bg-gray-100 rounded-lg shadow-lg overflow-hidden">
                    <img src="./img/Menu3.jpg" alt="Menu Découverte" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-culinary-secondary mb-4">Menu Découverte</h3>
                        <p class="text-gray-600 mb-4">Une exploration culinaire surprise, renouvelée chaque semaine selon les inspirations.</p>
                        <button onclick="showMenuDetails('decouverte')" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
                            Voir les Plats
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full relative mx-4 sm:mx-0">
            <button onclick="closeModal()" class="absolute top-2 right-2 bg-red-600 text-white rounded-full hover:bg-red-700 focus:outline-none p-1">
                &times; 
            </button>
            <h2 id="modalTitle" class="text-2xl font-bold mb-4">Détails du Menu</h2>
            
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 pr-4">
                    <div id="platesContainer">
                        <!-- Les plats dynamiques seront insérés ici -->
                    </div>
                </div>
                <div class="md:w-1/2 pl-4 border-l border-gray-300">
                    <h3 class="text-lg font-semibold mb-2">Réservation</h3>
                    <form id="reservationForm">
                        <div class="mb-4">
                            <label for="reservationDate" class="block mb-1">Date de réservation</label>
                            <input type="date" id="reservationDate" class="border border-gray-300 rounded w-full px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label for="reservationTime" class="block mb-1">Heure de réservation</label>
                            <input type="time" id="reservationTime" class="border border-gray-300 rounded w-full px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label for="numberOfPersons" class="block mb-1">Nombre de personnes</label>
                            <input type="number" id="numberOfPersons" class="border border-gray-300 rounded w-full px-3 py-2" min="1">
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition w-full">
                            Réserver
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="contact" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-culinary-primary mb-12">Contactez-Nous</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Formulaire de Contact -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-semibold text-culinary-secondary mb-6">Formulaire de Contact</h3>
                    <form id="contact-form" class="space-y-4">
                        <div>
                            <label for="fullname" class="block text-gray-700 mb-2">Nom Complet</label>
                            <input type="text" id="fullname" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-culinary-primary transition duration-200">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-culinary-primary transition duration-200">
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 mb-2">Message</label>
                            <textarea id="message" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-culinary-primary transition duration-200" rows="5"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-full hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                            Envoyer le Message
                        </button>
                    </form>
                </div>
                
                <!-- Informations de Contact -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-semibold text-culinary-secondary mb-6">Informations de Contact</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="bx bx-map text-culinary-primary text-2xl mr-4"></i>
                            <p>123 Rue de la Gastronomie, Paris, France</p>
                        </div>
                        <div class="flex items-center">
                            <i class="bx bx-phone text-culinary-primary text-2xl mr-4"></i>
                            <p>+33 1 23 45 67 89</p>
                        </div>
                        <div class="flex items-center">
                            <i class="bx bx-envelope text-culinary-primary text-2xl mr-4"></i>
                            <p>reservations@chefexcellence.com</p>
                        </div>
                        <div class="mt-6">
                            <h4 class="text-xl font-semibold text-culinary-secondary mb-4">Horaires d'Ouverture</h4>
                            <p>Lundi - Vendredi: 10h00 - 22h00</p>
                            <p>Samedi: 12h00 - 23h00</p>
                            <p>Dimanche: Fermé</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center"> 
                <!-- Company Info -->
                <div class="flex flex-col items-center mb-8 md:mb-0"> 
                    <h3 class="text-xl font-semibold mb-4">Chef Excellence</h3>
                    <p class="mb-4">Delivering exceptional culinary experiences and digital solutions.</p>
                    <div class="flex justify-center space-x-4 mb-4"> 
                        <a href="#" class="text-white hover:text-blue-200"><i class="bx bxl-facebook text-2xl"></i></a>
                        <a href="#" class="text-white hover:text-blue-200"><i class="bx bxl-linkedin text-2xl"></i></a>
                        <a href="#" class="text-white hover:text-blue-200"><i class="bx bxl-twitter text-2xl"></i></a>
                    </div>
                </div>
    
                <!-- Quick Links -->
                <div class="flex flex-col items-center mb-8 md:mb-0"> 
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-200">Home</a></li>
                        <li><a href="#" class="hover:text-blue-200">Menu</a></li>
                        <li><a href="#" class="hover:text-blue-200">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-200">Contact</a></li> 
                    </ul>
                </div>
    
                <!-- Contact -->
                <div class="flex flex-col items-center"> 
                    <h4 class="font-semibold mb-4">Contact Us</h4>
                    <p>123 Chef Street</p>
                    <p>Culinary City, CC 12345</p>
                    <p>Phone: (123) 456-7890</p>
                    <p>Email: <a href="mailto:hello@chefexcellence.com" class="hover:text-blue-200">hello@chefexcellence.com</a></p>
                </div>
            </div>
    
            <!-- Copyright -->
            <div class="mt-8 pt-4 border-t border-blue-500 text-center">
                <p>© 2024 Chef Excellence. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    

    <script>
        
        document.getElementById('mobile-toggle').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });
// Exemple de données de plats pour chaque menu
const menusData = {
    degustation: [
        { name: "Plat 1", description: "Description du Plat 1", price: "15€" },
        { name: "Plat 2", description: "Description du Plat 2", price: "20€" },
        { name: "Plat 3", description: "Description du Plat 3", price: "25€" },
    ],
    vegetarien: [
        { name: "Plat 1", description: "Description du Plat Végétarien 1", price: "12€" },
        { name: "Plat 2", description: "Description du Plat Végétarien 2", price: "16€" },
        { name: "Plat 3", description: "Description du Plat Végétarien 3", price: "14€" },
    ],
    decouverte: [
        { name: "Plat 1", description: "Description du Plat Découverte 1", price: "18€" },
        { name: "Plat 2", description: "Description du Plat Découverte 2", price: "22€" },
        { name: "Plat 3", description: "Description du Plat Découverte 3", price: "20€" },
    ]
};

// Fonction pour afficher les détails du menu dans le modal
function showMenuDetails(menuType) {
    // Récupérer les données des plats correspondant au type de menu
    const plates = menusData[menuType];

    // Remplir le modal avec les informations du menu
    const platesContainer = document.getElementById('platesContainer');
    platesContainer.innerHTML = ''; 

    plates.forEach(plate => {
        const plateDiv = document.createElement('div');
        plateDiv.className = 'border-b border-gray-300 py-2'; 
        plateDiv.innerHTML = `
            <h4 class="font-semibold">${plate.name}</h4>
            <p class="text-gray-600">${plate.description}</p>
            <p class="text-lg font-bold">${plate.price}</p>
        `;
        platesContainer.appendChild(plateDiv);
    });

    // Afficher le modal
    document.getElementById('menuModal').classList.remove('hidden');
}

// Fonction pour fermer le modal
function closeModal() {
    document.getElementById('menuModal').classList.add('hidden');
}

// Événement 'submit' sur le formulaire de réservation pour éviter le rechargement de la page
document.getElementById('reservationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire
    alert("Réservation effectuée !");
    closeModal(); 
});


    </script>
</body>
</html>