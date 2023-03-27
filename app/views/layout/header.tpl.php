<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Titre du site</title>

    <!-- Getting bootstrap (and reboot.css) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--
        And getting Font Awesome 4.7 (free)
        To get HTML code icons : https://fontawesome.com/v4.7.0/icons/
    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

    <!-- We can still have our own CSS file -->
    <link rel="stylesheet" href="<?= $assetsBaseUri ?>css/style.css">
</head>

<body>

<header>

  <?php 
  
  if (isset($_SESSION['userId']) && $_SESSION['userId'] != null) {
    echo "Connexion via l'email : ";
    echo $_SESSION['userObject']->getEmail();
  } else {
    echo "Visiteur·se non connecté·e";
  }
        
  ?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
    <div class="navbar-group-items">
      <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?= $router->generate('home') ?>">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Item</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Item</a>
        </li>
      </ul>
    </div>  

  </div>
  </nav>
</header>
<main>