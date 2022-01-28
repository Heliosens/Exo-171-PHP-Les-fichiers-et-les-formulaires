<?php

$errorMessage = [
    "Fichier non présent",
    "Erreur lors du chargement du fichier",
    "Le type de fichier n'est pas valide",
    "La taille du fichier doit être de 3Mo max.",
    "Le fichier a bien été envoyé",
];

if(isset($_GET['error'])){
    echo "<div>" . $errorMessage[(int)$_GET['error']] . "</div>";
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formaulaire de demande de fichier</title>
</head>
<body>
    <form action="fichier.php" method="post" enctype="multipart/form-data">
        <div>
            <h1>Choisissez une image</h1>
            <p>Taille max. de 3Mo</p>
            <input type="file" name="userFile" id="idUserFile" accept=".jpg, .jpeg, .png">
        </div>
        <input type="submit">
    </form>

    <?php
        if(file_exists('file.json')){
            $picture = json_decode(file_get_contents('file.json'));
            foreach ($picture as $item){?>
                <div>
                    <img src="uploads/<?=$item?>" width="100px" height="auto">
                </div>
                <?php
            }
        }
    ?>
</body>
</html>
<?php


/**
 * 1. Créez un formulaire classique contenant un champs input de type file
 * 2. Faites pointer l'action sur la page fichier.php ( que vous créerez )
 * 3. Gérez l'upload du fichier, le fichier doit être stocké dans le répertoire upload de votre site
 * 4. Gérez tous les cas de figure:
 *    - Le fichier doit être une image
 *    - On ne peut pas uploader de fichier image de plus de 3Mo
 *    - Les fichiers doivent être renommés
 *    - Affichez les erreurs sur la page index.php s'il y en a ( fichier non présent, erreur d'upload, etc... )
 * ( BONUS )
 * 5. Une fois l'upload terminé, enregistrez le nom du fichier uploadé dans le fichier file.json ( que vous créerez s'il n'existe pas )
 *    Attention, trouvez une solution pour que le fichier contienne du JSON valide !
 * 6. Affichez sur la page index les fichiers ayant déjà été uploadés.
 */

