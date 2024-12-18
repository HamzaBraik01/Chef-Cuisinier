<?php
include 'connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $nom = mysqli_real_escape_string($con, $_POST['nom']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $roleId = 2; 
    $check_email = "SELECT * FROM utilisateur WHERE Email = '$email'";
    $result = mysqli_query($con, $check_email);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
            showMessage('Cet email existe déjà');
        </script>";
    } else {
        
        $query = "INSERT INTO utilisateur(Nom , Prenom, Phone, Email, MotDePasse, RoleID) VALUES ('$nom', '$prenom', '$phone', '$email', '$password', $roleId)";

        if (mysqli_query($con, $query)) {
            echo "<script>
                showMessage('Inscription réussie ! Redirection...', true);
            </script>";
            header("Location: login.php");
            exit();
        } else {
            echo "<script>
                showMessage('Erreur lors de l\'inscription: " . mysqli_error($con) . "');
            </script>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg flex flex-col lg:flex-row items-center h-screen w-full lg:w-4/5 mx-auto rounded-lg">
        
        <div class="w-full lg:w-1/2 h-64 lg:h-full hidden lg:block">
            <img src="./img/login4.jpg" alt="Placeholder Image"
                class="object-cover w-full h-full rounded-l-lg">
        </div>

        
        <div class="p-8 lg:p-16 w-full lg:w-1/2">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Signup</h1>
            <form action="" method="POST">
                <!-- First Name (Prenom) -->
                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 font-medium">First Name (Prenom)</label>
                    <input type="text" id="prenom" name="prenom"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your first name" autocomplete="off">
                </div>

                <!-- Last Name (Nom) -->
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 font-medium">Last Name (Nom)</label>
                    <input type="text" id="nom" name="nom"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your last name" autocomplete="off">
                </div>

                <!-- Phone Number -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-medium">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your phone number" autocomplete="off">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your email" autocomplete="off">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium">Password (Mot de Passe)</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your password" autocomplete="off">
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="confirm_password" class="block text-gray-700 font-medium">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Confirm your password" autocomplete="off">
                </div>

                <!-- Signup Button -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Signup</button>
            </form>
            <!-- Login Link -->
            <div class="mt-6 text-center">
                <span class="text-gray-600">Already have an account?</span>
                <a href="login.php" class="text-blue-500 hover:underline font-medium">Login here</a>
            </div>
        </div>
    </div>
    <script>
        const titleElement = document.querySelector('h1');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'mb-4 p-2 text-center text-red-500';
        titleElement.insertAdjacentElement('beforebegin', messageDiv);

        const form = document.querySelector('form');

        function showMessage(message, isSuccess = false) {
            messageDiv.textContent = message;
            messageDiv.style.color = isSuccess ? 'green' : 'red';
            messageDiv.scrollIntoView({ behavior: 'smooth' });
        }

        function validateForm(e) {
            e.preventDefault();

            const fields = {
                prenom: document.getElementById('prenom').value,
                nom: document.getElementById('nom').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                confirm_password: document.getElementById('confirm_password').value
            };

            
            const nameRegex = /^[a-zA-Zéèàçêïûäöüÿ]+$/;

            
            if (!nameRegex.test(fields.prenom) || fields.prenom.length < 2) {
                return showMessage('Le prénom doit contenir au moins 2 caractères et être composé uniquement de lettres');
            }

            
            if (!nameRegex.test(fields.nom) || fields.nom.length < 2) {
                return showMessage('Le nom doit contenir au moins 2 caractères et être composé uniquement de lettres');
            }

            
            const phoneRegex = /^(06|07)\d{8}$/;
            if (!phoneRegex.test(fields.phone)) {
                return showMessage('Le numéro de téléphone doit être au format marocain (06XXXXXXXX ou 07XXXXXXXX)');
            }

            
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(fields.email)) {
                return showMessage('Veuillez entrer une adresse email valide');
            }

            
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
            if (!passwordRegex.test(fields.password)) {
                return showMessage('Le mot de passe doit contenir au moins 6 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial');
            }

            
            if (fields.password !== fields.confirm_password) {
                return showMessage('Les mots de passe ne correspondent pas');
            }

            showMessage('Formulaire valide !', true);
            form.submit();
        }

        form.addEventListener('submit', validateForm);

        
    </script>
</body>

</html>
