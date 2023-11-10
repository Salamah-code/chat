<?php
    session_start();
    require_once("basedonnees/db.php");
    if(isset($_SESSION['pseudo'])){
        $pseudo = $_SESSION['pseudo'];
        $profil = $db->prepare("SELECT idMembre, prenom, nom, profil FROM membre WHERE pseudo = '$pseudo'");
        $profil->execute();

        $res = $profil->fetch();
        $_SESSION['idMembre'] = $res['idMembre'];


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="chatcss/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="chatcss/css/all.min.css">
    <link rel="stylesheet" href="chatcss/fontawesome.min.css">
</head>

<body class="bg-dark">
    <!-- Le div general -->
    <div class="container-fluid">
        <!-- debut : Le header -->
        <header class="border-bottom d-flex flex-wrap align-items-center px-2 py-3 my-2 justify-content-center justify-content-md-between bg-primary bg-gradient">
            <div>
                <h2 class="text-white">ChatApp</h2>
            </div>
            <div>
                <form>
                    <input type="search" name="search" class="form-control rchrch" placeholder="Rechercher">
                </form>
            </div>
            <div class="d-flex flex-wrap align-items-center p-1">
                <img src="<?php echo $res['profil']?>" class="rounded-circle profil">
                <h4 class="text-white mx-2"><?php echo $res['prenom']." ".$res['nom']?></h4>
                <a class="btn text-white bg-secondary" href="deconnexion.php" id="drpdwn"><i class="fas fa-sign-out-alt">Deconnexion</i></a>
            </div>

        </header>
        <!-- Fin : le header -->

        <!-- Conteneur secondaire  -->
        <div class="conatiner">
            <div class="row">
                <!-- Section 1 : partie liste des amis -->
                <div class="col-md-4 border-end rounded l-amis">
                    <h3 class="text-center text-white">Mes amis</h3>
                    <hr class="sep-users">

                    <div class=" d-block user-friendList overflow-auto" id="carduser">
                        <!-- card de l'utilisateur -->
                        <!-- <div class="container-fluid border border-3 rounded shadow-lg user-friend mt-2 align-items-center">
                            <div class="row mt-2 p-1">
                                <div class="col">
                                    <img src="image/profil.jpg" class="rounded-circle profil">
                                </div>
                                <div class="col">
                                    <h5 class="text-white">Diam Diallo</h5>
                                </div>
                                <div class="col">
                                    <button class="mt-3 bg-danger rounded btn"><i class="fas fa-user-minus"></i></button>
                                </div>
                            </div>
                        </div> -->
                        <!-- fin card -->
                    </div>

                    <hr class="sep-users">
                    <h3 class="text-center text-white">Mes demandes d'amis</h3>
                    <hr class="sep-users">

                    <div class=" d-block user-friendSelfAsk overflow-auto">
                        <!-- <div class="container-fluid border border-3 rounded shadow-lg user-friend mt-2 align-items-center">
                            <div class="row mt-2 p-1">
                                <div class="col">
                                    <img src="image/profil.jpg" class="rounded-circle profil">
                                </div>
                                <div class="col">
                                    <h5 class="text-white">Diam Diallo</h5>
                                </div>
                                <div class="col">
                                    <button class="mt-3 bg-danger rounded btn text-white"><i class="far fa-window-close"></i>Decliner</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                </div>
                <!-- Fin : partie liste des amis -->

                <!-- Section 2 : partie messages -->
                <div class="col-md-4 p-messages rounded">
                    <h3 class="text-center text-white">Conversation</h3>
                    <hr class="sep-users">
                    <!-- bloc utilisateur choisis -->
                    
                    <?php
                        if(isset($_GET['idMbre'])){
                            $_SESSION['idReceveur'] = $_GET['idMbre'];
                            ?>
                            <div class="d-block container-fluid border border-3 rounded d-flex align-items-center contact">
                                <div class="row p-1">
                                    <img src="<?php echo $_GET['profil']?>" class="col-5 rounded-circle profil">
                                    <div class="col">
                                        <h5 class="text-white"><?php echo $_GET['prenom']." ".$_GET['nom']?></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- bloc conversation -->
                            <div class="d-block border mt-2 conversation-field overflow-auto">
                                <!-- <div class="msgENv">
                                    
                                </div>
                                <div class="msgRecu">
                                    
                                </div> -->
                            </div>
                            <!-- fin du bloc -->

                            <!-- bloc champ des meesages -->
                            <div class="d-block container-fluid msg-field">
                                <div class="d-block p-1">
                                    <form method = "POST" class="sendmsg">
                                        <div class="row">
                                            <div class="col-10"><input type="text" class="form-control field" placeholder="Taper votre message"></div>
                                            <div class="col p-1"><button type="submit" class="w-100 bg-primary rounded btn btnEnvText"><i class="fas fa-paper-plane"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="d-block p-1">
                                    <form method='POST' action='sendFiles.php' enctype='multipart/form-data' class='sendFile'>
                                        <div class="row">
                                            <div class="col-10"><input type="file" name='file' class="form-control filefield"></div>
                                            <div class="col p-1"><button type="submit" class="w-100 bg-primary rounded btn"><i class="fas fa-paper-plane"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- fin block -->
                        <!-- Fin : partie messages -->

                        <?php
                        }else{
                            ?>
                                <h1 class="text-white">Si vous avez un ami selectionner le et discuter avec lui</h1>
                            <?php
                        }
                    ?>
                    <!-- Fin du bloc -->
                    <div class="d-block container-fluid border msg-field" id="searching">

                    </div>

                    
                </div>
                
                <!-- Section 3 : debut listes des utilisateurs et demandes amis -->
                <div class="col-md-4 border-start rounded l-users">
                    <h3 class="text-center text-white">Les utilisateurs</h3>
                    <hr class="sep-users">
                    <!-- bloc liste des utilisateurs non amis -->
                    <div class="d-block user-nofriend overflow-auto">
                        <!-- card de l'utilisateur -->

                        <!-- <div class="container-fluid border border-3 rounded user-friend mt-2 align-items-center">
                            <div class="row mt-2 p-1">
                                <div class="col">
                                    <img src="image/profil.jpg" class="rounded-circle profil">
                                </div>
                                <div class="col">
                                    <h5 class="text-white">Diam Diallo</h5>
                                </div>
                                <div class="col">
                                    <button class=" bg-success rounded btn"><i class="fas fa-user-plus"></i></button>
                                    <button class=" bg-danger rounded btn"><i class="fas fa-window-close"></i></button>
                                </div>
                            </div>
                        </div>
                         fin card -->
                    </div>
                    <!-- Fin du bloc -->

                    <hr class="sep-users">

                    <!-- bloc des demandes d'amis -->
                    <h3 class="text-center text-white">Les demandes d'amis</h3>
                    <hr class="sep-users">
                    <div class="d-block  user-askfriend overflow-auto">
                        <!-- card de l'utilisateur -->
                        <!-- <div class="container-fluid border border-3 rounded user-friend mt-2 align-items-center">
                            <div class="row mt-2 p-1">
                                <div class="col">
                                    <img src="image/profil.jpg" class="rounded-circle profil">
                                </div>
                                <div class="col">
                                    <h5 class="text-white">Diam Diallo</h5>
                                </div>
                                <div class="col">
                                    <button class=" bg-success rounded btn"><i class="fas fa-user-check"></i></button>
                                    <button class=" bg-danger rounded btn"><i class="fas fa-window-close"></i></button>
                                </div>
                            </div>
                        </div> -->
                        <!-- fin card -->
                    
                    </div>
                </div>
                <!-- Fin du bloc -->

            </div>
        </div>
    </div>
</body>
<script src="jquery.js"></script>
<script>
    $('document').ready(function getAlluser(){
        
        function getAllUsers() {
            $.post('getAllUsers.php', function (data) {
                $('.user-nofriend').html(data);
            });
        }
        getAllUsers();
       setInterval(getAllUsers, 1000);

        function getAllFriends() {
            $.post('getAllFriends.php', function(data){
                $('#carduser').html(data);
            });
        }
        getAllFriends();
       setInterval(getAllFriends, 1000);

        function getAllFriendAsks() {
            $.post('getAllFriendAsk.php', function(data){
                $('.user-askfriend').html(data);
            });
        }
        getAllFriendAsks();
        setInterval(getAllFriendAsks, 1000);
        
        $('.sendmsg').submit(function(){
            var $message = $('.field').val();
            $.post('sendMessge.php', {message:$message}, function(data){

            });
        });

        function getAllMessages() {
            $.post('getMessages.php', function(data){
                $('.conversation-field').html(data);
            });
        }
        getAllMessages();
        setInterval(getAllMessages, 5000);

        //setInterval(getAllusers, 1000);

        // $('..sendFile').submit(function() {
        //     var $filename = $('.filefield').val();
        //     $.post('.sendFile.php', {file:$filename}, function(data) {
                
        //     })
        // });

        function getAllSelfFriendAsk() {
            $.post('getSelfFriendAsk.php', function(data) {
                $('.user-friendSelfAsk').html(data);
            });
        }
        getAllSelfFriendAsk();
        setInterval(getAllSelfFriendAsk, 5000);

        $('.rchrch').keyup(function() {
            $motCle = $('.rchrch').val();
            if($motCle != ""){
                $.post('rechercher.php', {motCle:$motCle}, function(data){
                    $('#searching').html(data);
                });
            }else{
                $('#searching').html("");
            }
            
        //    $.post('rechercher.php', function(data) {
        //         $('.rchrch').html(data);
        //    });
        });

        
    });
</script>
</html>

<?php
}else{
    header('Location:connexion.php');
}
?>
