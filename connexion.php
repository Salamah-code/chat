<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="chatcss/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="chatcss/css/all.min.css">
    <link rel="stylesheet" href="chatcss/fontawesome.min.css">
    <title>Connexion</title>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="border bg-primary bg-gradient">
            <h1 class="text-white">ChatApp</h1>
        </div>
        <div class="m-auto  p-5 w-50 mt-5">
            <form class="row g-3" method="post" action="traitConnexion.php">
                <div class="col-12">
                    <input type="text" class="form-control" name="pseudo" id="inputEmail4" placeholder="Votre Pseudo">
                </div>
                <div class="col-12">
                    <input type="password" class="form-control" name="mpass" id="inputAddress2" placeholder="Votre mot de passe">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
                <div class="col-md-4">
                    <p class="text-white">ou bien</p>
                </div>
                <div class="col-md-4">
                    <a href="inscription.php" class="btn btn-primary">S'inscrire</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>