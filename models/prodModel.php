<?php
require_once("pdoModel.php");

function getLastProd() {
    $req = "SELECT * FROM prod ORDER BY id DESC LIMIT 1";
    $stmt = setDB()->prepare($req);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC); // PAS fetchAll ici
    $stmt->closeCursor();
    return $data;
}

function getAllProds() {
    $req ="SELECT * FROM prod ORDER BY id DESC";
    $stmt = setDB()->prepare($req);
    $stmt->execute();
    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $datas;
}

function getProdsByType($type) {
    $pdo = setDB();
    $sql = "SELECT * FROM prod WHERE type = :type ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['type' => $type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProdById($id) {
    $sql = "SELECT * FROM prod WHERE id = :id";
    $stmt = setDB()->prepare($sql);
    $stmt->execute(["id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function searchProds($query) {
    $sql = "SELECT * FROM prod 
            WHERE nom LIKE :q OR cle LIKE :q OR type LIKE :q 
            ORDER BY id DESC";

    $stmt = setDB()->prepare($sql);
    $stmt->execute(["q" => "%" . $query . "%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertProd($nom, $bpm, $cle, $type, $chemin) {
    $sql = "INSERT INTO prod (nom, bpm, cle, type, chemin) VALUES (:nom, :bpm, :cle, :type, :chemin)";
    $stmt = setDB()->prepare($sql);
    $stmt->execute([
        "nom" => $nom,
        "bpm" => $bpm,
        "cle" => $cle,
        "type" => $type,
        "chemin" => $chemin
    ]);
}

function deleteProdById($id) {
    $sql = "DELETE FROM prod WHERE id = :id";
    $stmt = setDB()->prepare($sql);
    $stmt->execute(["id" => $id]);
}

function updateProdInDb($id, $nom, $bpm, $cle, $type, $chemin) {
    $sql = "UPDATE prod SET nom = :nom, bpm = :bpm, cle = :cle, type = :type, chemin = :chemin WHERE id = :id";
    $stmt = setDB()->prepare($sql);
    $stmt->execute([
        "id" => $id,
        "nom" => $nom,
        "bpm" => $bpm,
        "cle" => $cle,
        "type" => $type,
        "chemin" => $chemin
    ]);
}


