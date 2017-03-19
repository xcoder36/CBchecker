<?php
class Data {

    public static function connect ($number) { // connexion a la base de donnée
        try // tentative de connexion
        {
            $bdd = new PDO('mysql:host=mysql-cbchecker.alwaysdata.net;charset=utf8', 'cbchecker', '');
            return $bdd;
        }
        catch (Exception $e) // sinon erreur
        {
        echo "Erreur de connexion a la base de donnee";
        return "Erreur de connexion a la base de donnee";
        }
    }

    private static function init ($bdd){ // on crée la base de donnée si elle est existe pas

        $bdd->query("CREATE DATABASE IF NOT EXISTS cbchecker_devops");
        $bdd->query("use cbchecker_devops");
        $sql = "CREATE TABLE `account` (
      `id` int(11) NOT NULL PRIMARY KEY,
      `Number` text NOT NULL,
      `Cash` int(11) NOT NULL
        )";
        $bdd->exec($sql);
        $bdd->exec('ALTER TABLE `account` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2');
        return $bdd;
    }

    public static function createnewuser($number, $bdd)  // si on tape un utilisateur qui existe pas on le crée (debug uniquement)
    {
        $search = 0;
        $reponse = $bdd->query("SELECT Number FROM account WHERE Number = '$number'"); // on verifie si l'utilisateur existe
        while ($donnees = $reponse->fetch())
        {
            $search = $search + 1;
        }
        if ($search == 0) // si il existe pas on le crée avec 300 sur lec ompte
        {
            $bdd->exec('INSERT INTO account(`Number`, Cash) VALUES('.$number.', 300)');
            echo "coucou";
        }
    }

    private static function getcash($number, $bdd)  // recupere l'argent sur le compte
    {
        $reponse = $bdd->query('SELECT Cash FROM account WHERE Number = '.$number.'');
        $donnee = $reponse->fetch();
        return $donnee;
    }

    private static function getinfo($number, $bdd)  // recupere les information d'un client et les affiches a l'ecran
    {
        $reponse = $bdd->query('SELECT * FROM account WHERE Number = '.$number.'');
        while ($donnee = $reponse->fetch())
        {
            echo 'numero de CB : ' + $donnee['Number'] . '<br />';
            echo "argent restant : " + $donnee['Cash'] . '<br />';
        }

    }

    //supprime une balise et son contenu
    public static function payment ($number, $price) // le paiement est déclenché
    {
        $bdd = self::connect($number);
        if ($bdd != "Erreur de connexion a la base de donnee") { // si la connexion est OK
            $bdd = self::init($bdd); // on initialise la base la base de donnée
            // si l'utilisateur existe pas, on le crée (debug uniquement)
            self::createnewuser($number,$bdd);

            // on regarde si l'argent est suffisant

            $solde = self::getcash($number, $bdd);
            if ($solde*5 >= $price) {
                //on soustrait l'argent
                $solde = $solde[0] - $price;
                try {
                    $bdd->exec('UPDATE account SET Cash = ' . $solde . ' WHERE Number = ' . $number . '');
                    self::getinfo($number, $bdd);
                    return true;
                } catch (Exception $e) { // si on y arrive pas on informe que ca n'as pas fonctionne
                    return false;
                }
            }
        }
    }
}