<?php

require_once("models/prodModel.php");

function homePage() {
    $lastBeat = getLastProd();

    $datas_page = [
        "description" => "Page home du site",
        "title" => "Accueil : Gaby à la prod",
        "view" => "views/pages/homePage.php",
        "layout" => "views/components/layout.php",
        "lastBeat" => $lastBeat

    ];

    drawPage($datas_page);
}

function beatsPage() {
    require_once("models/prodModel.php");

    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $query = isset($_GET['q']) ? trim($_GET['q']) : null;

    if ($query) {
        $beats = searchProds($query); // Recherche par mot-clé
    } elseif ($type) {
        $beats = getProdsByType($type); // Filtrage par type
    } else {
        $beats = getAllProds(); // Tout afficher
    }

    $datas_page = [
        "description" => "Tous les beats disponibles",
        "title" => "Catalogue - Gaby à la prod",
        "view" => "views/pages/beatsPage.php",
        "layout" => "views/components/layout.php",
        "beats" => $beats,
        "typeSelected" => $type,
    ];

    drawPage($datas_page);
}


function aboutPage() {
    $datas_page = [
        "description" => "À propos de Gaby à la Prod - Beatmaker indépendant",
        "title" => "À propos - Gaby à la Prod",
        "view" => "views/pages/aboutPage.php",
        "layout" => "views/components/layout.php"
    ];

    drawPage($datas_page);
}

function contactPage(){

    $datas_page = [
        "description" => "Page de contact - Gaby à la prod",
        "title" => "Contact - Gaby à la prod",
        "view" => "views/pages/contactPage.php",
        "layout" => "views/components/layout.php",
    ];

    drawPage($datas_page);
}


function adminPage() {

    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: login");
        exit;
    }
    
    require_once("models/prodModel.php");
    $beats = getAllProds();

    $datas_page = [
        "description" => "Espace admin",
        "title" => "Admin - Gérer les prods",
        "view" => "views/pages/adminPage.php",
        "layout" => "views/components/layout.php",
        "beats" => $beats
    ];

    drawPage($datas_page);
}

function addProd() {

    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: login");
        exit;
    }
    
    require_once("models/prodModel.php");

    if (
        isset($_POST["nom"], $_POST["bpm"], $_POST["cle"], $_POST["type"]) &&
        isset($_FILES["chemin"]) && $_FILES["chemin"]["error"] === 0
    ) {
        $nom = htmlspecialchars($_POST["nom"]);
        $bpm = (int) $_POST["bpm"];
        $cle = htmlspecialchars($_POST["cle"]);
        $type = htmlspecialchars($_POST["type"]);

        $fileTmp = $_FILES["chemin"]["tmp_name"];
        $fileName = basename($_FILES["chemin"]["name"]);
        $destPath = "private/prod/" . $fileName;

        // Déplacer le fichier
        if (move_uploaded_file($fileTmp, $destPath)) {
            // Ajouter en base
            insertProd($nom, $bpm, $cle, $type, $destPath);
        }
    }

    header("Location: admin");
    exit;
}

function deleteProd() {

    session_start();
    if (!isset($_SESSION["admin"])) {
    header("Location: login");
    exit;
    }

    require_once("models/prodModel.php");

    if (!empty($_GET["id"])) {
        $id = (int) $_GET["id"];

        // Optionnel : supprimer aussi le fichier audio
        $prod = getProdById($id);
        if ($prod && file_exists($prod["chemin"])) {
            unlink($prod["chemin"]); // supprime le fichier
        }

        deleteProdById($id);
    }

    header("Location: admin");
    exit;
}

function editProd() {

    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: login");
        exit;
    }

    require_once("models/prodModel.php");

    if (!empty($_GET["id"])) {
        $prod = getProdById((int) $_GET["id"]);

        if ($prod) {
            $datas_page = [
                "description" => "Modifier une prod",
                "title" => "Modifier : " . $prod["nom"],
                "view" => "views/pages/editProdPage.php",
                "layout" => "views/components/layout.php",
                "prod" => $prod
            ];
            drawPage($datas_page);
            return;
        }
    }

    header("Location: admin");
    exit;
}

function updateProd() {

    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: login");
        exit;
    }

    require_once("models/prodModel.php");

    if (
        isset($_POST["id"], $_POST["nom"], $_POST["bpm"], $_POST["cle"], $_POST["type"])
    ) {
        $id = (int) $_POST["id"];
        $nom = htmlspecialchars($_POST["nom"]);
        $bpm = (int) $_POST["bpm"];
        $cle = htmlspecialchars($_POST["cle"]);
        $type = htmlspecialchars($_POST["type"]);

        $chemin = $_POST["ancien_chemin"]; // par défaut

        // Si un nouveau fichier est uploadé
        if (!empty($_FILES["chemin"]["name"]) && $_FILES["chemin"]["error"] === 0) {
            $fileName = basename($_FILES["chemin"]["name"]);
            $destPath = "public/prod/" . $fileName;

            if (move_uploaded_file($_FILES["chemin"]["tmp_name"], $destPath)) {
                $chemin = $destPath;
            }
        }

        updateProdInDb($id, $nom, $bpm, $cle, $type, $chemin);
    }

    header("Location: admin");
    exit;
}

function loginPage() {
    require_once("models/pdoModel.php");
    if (session_status() === PHP_SESSION_NONE) session_start();
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $pdo = setDB();
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :user");
        $stmt->execute(["user" => $user]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($pass, $admin["password"])) {
            $_SESSION["admin"] = true;
            header("Location: index.php?page=admin");
            exit;
        } else {
            $message = "❌ Identifiants incorrects";
        }
    }

    $datas_page = [
        "description" => "Connexion",
        "title" => "Connexion admin",
        "view" => "views/pages/loginPage.php",
        "layout" => "views/components/layout.php",
        "message" => $message
    ];

    drawPage($datas_page);
}


function logout() {
    session_start();
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}
