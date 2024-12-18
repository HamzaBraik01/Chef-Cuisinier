<?php

include 'connexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM utilisateur WHERE Email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['MotDePasse'])) {
            $roleId = $user['RoleID'];
            if ($roleId == 1) {
                header("Location: DashboardChef.php");
                exit(); 
            } else if ($roleId == 2) {
                header("Location: DashbardClient.php");
                exit();
            }
        } else {
            echo "<script>showMessage('Mot de passe incorrect');</script>";
        }
    } else {
        echo "<script>showMessage('Aucun utilisateur trouvé avec cet email');</script>";
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
            <img src="./img/login3.jpg" alt="Placeholder Image"
                class="object-cover w-full h-full rounded-l-lg">
        </div>

        
        <div class="p-8 lg:p-16 w-full lg:w-1/2">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Login</h1>
            <form action="#" method="POST">
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your email" autocomplete="off">
                </div>

                
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your password" autocomplete="off">
                </div>
                
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="text-blue-500 h-4 w-4">
                    <label for="remember" class="ml-2 text-gray-700 text-sm">Remember Me</label>
                </div>
                
                <div class="mb-6">
                    <a href="#" class="text-blue-500 text-sm hover:underline">Forgot Password?</a>
                </div>
                
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full">Login</button>
            </form>
            
            <div class="mt-6 text-center">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="Signup.php" class="text-blue-500 hover:underline font-medium">Sign up here</a>
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
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            };

            /*const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(fields.email)) {
                return showMessage('Veuillez entrer une adresse email valide');
            }
                
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
            if (!passwordRegex.test(fields.password)) {
                return showMessage('Le mot de passe doit contenir au moins 6 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial');
            }
                */
            showMessage('Formulaire valide !', true);
            form.submit();
        }

        form.addEventListener('submit', validateForm);
    </script>
</body>

</html>
