<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="chatcss/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="chatcss/css/all.min.css">
    <link rel="stylesheet" href="chatcss/fontawesome.min.css">
    <title>Inscription</title>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="border bg-primary bg-gradient">
            <h1 class="text-white">ChatApp</h1>
        </div>
        <div class="m-auto p-5 w-50 mt-5">
            <form class="row g-3" method="post" action="traitInscription.php" enctype="multipart/form-data" novalidate>
                <div class="col-12">
                    <input type="text" class="form-control" name="pseudo" id="inputEmail4" placeholder="Votre Pseudo" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nom" id="inputPassword4" placeholder="Votre nom" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="prenom" id="inputAddress" placeholder="Votre prenom" required>
                </div>
                <div class="col-12">
                    <label for="formFileLg" class="form-label text-white">Selectionner une photo de profile</label>
                    <input class="form-control form-control-sm" name="profile" accept="image/*" id="formFileLg" type="file">
                </div>
                <div class="col-12">
                    <input type="password" class="form-control" name="mpass" id="inputAddress2" placeholder="Votre mot de passe" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
                <div class="col-md-4">
                    <p class="text-white">ou bien </p>
                </div>
                <div class="col-md-4">
                    <a href="connexion.php" class="btn btn-primary">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>