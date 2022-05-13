<?php 
$serveur = "localhost";
$dbname = "finalproject";
$user = "root";
$pass = "";
$port = "3306";

$name_contact = $_POST["name_contact"];
$first_name = $_POST["first_name"];
$adress = $_POST["adress"];
$subject_contact = $_POST["subject_contact"];

try{
    //On se connecte à la BDD
    $dbfinal = new PDO("mysql:host=localhost;dbname=finalproject",$user,$pass);
    $dbfinal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* Si la table contact existe alors ne fais rien
        sinon creer la table contact */

            //On crée une table form
            $contact = "CREATE TABLE contact(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name_contact TEXT,
                first_name TEXT,
                adress TEXT,
                subject_contact TEXT)";
            $dbfinal->exec($contact);



        //On insère les données reçues
        $sth = $dbfinal->prepare("
        INSERT INTO contact(name_contact, first_name, adress, subject_contact)
        VALUES(:name_contact, :first_name, :adress, :subject_contact)");
    $sth->bindParam(':name_contact',$name_contact);
    $sth->bindParam(':first_name',$first_name);
    $sth->bindParam(':adress',$adress);
    $sth->bindParam(':subject_contact',$subject_contact);
    $sth->execute();

    //On renvoie l'utilisateur vers la page de remerciement
    header("Location: Redirection.html"); 

}
catch(PDOException $e){
    echo 'Erreur : '.$e->getMessage();
}

