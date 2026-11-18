<?php

require_once "controllers/pagesController.php";
require_once "controllers/utilities.php";

try{

    if (empty($_GET['page'])){
        $page = "home";
    }else{
        $path = explode ("/", filter_var($_GET["page"],FILTER_SANITIZE_URL));
        $page = $path[0];
    }

    switch ($page){
        case "home":
            homePage();
        break;

        case "beats":
            beatsPage();
            break;  
        
        case "about":
            aboutPage();
            break;            

        case "contact":
            contactPage();
            break;

        case "admin":
            adminPage();
            break;

        case "addProd":
            addProd();
            break;

        case "deleteProd":
            deleteProd();
            break;
            
        case "editProd":
            editProd();
            break;
            
        case "updateProd":
            updateProd();            
            break;
        
        case "login":
                loginPage();
            break;
            
        case "logout":
            logout();
            break;
     
        default:
            throw new Exception("La page n'existe pas !");
    }
}catch(Exception $e){
    echo "Erreur : " .$e->getMessage();
}