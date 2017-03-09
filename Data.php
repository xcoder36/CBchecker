<?php
class Data {

    private static function connect ($number) {
        try
        {
            $bdd = new PDO('mysql:host=localhost;charset=utf8', 'root', '');
            return $bdd;
        }
        catch (Exception $e)
        {
        return "";
        }
    }

    private static function init ($bdd){

        $bdd->query("CREATE DATABASE IF NOT EXISTS CBchecker");
        $bdd->query("use CBchecker");
        $sql = "CREATE TABLE `account` (
      `id` int(11) NOT NULL PRIMARY KEY,
      `Number` text NOT NULL,
      `Cash` int(11) NOT NULL
        )";
        $bdd->exec($sql);
        $bdd->exec('ALTER TABLE `account` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2');
        return $bdd;
    }

    private static function createnewuser($number, $bdd)  // regarde combien d'argent
    {
        $search = 0;
        $reponse = $bdd->query("SELECT Number FROM account WHERE Number = '$number'");
        while ($donnees = $reponse->fetch())
        {
            $search = $search + 1;
        }
        if ($search == 0)
        {
            $bdd->exec('INSERT INTO account(`Number`, Cash) VALUES('.$number.', 300)');
            echo "coucou";
        }
    }

    private static function getcash($number, $bdd)  // regarde combien d'argent
    {
        $reponse = $bdd->query('SELECT Cash FROM account WHERE Number = '.$number.'');
        $donnee = $reponse->fetch();
        return $donnee;
    }

    private static function getinfo($number, $bdd)  // regarde combien d'argent
    {
        $reponse = $bdd->query('SELECT * FROM account WHERE Number = '.$number.'');
        while ($donnee = $reponse->fetch())
        {
            echo 'numero de CB : ' + $donnee['Number'] . '<br />';
            echo "argent restant : " + $donnee['Cash'] . '<br />';
        }

    }

    //supprime une balise et son contenu
    public static function payment ($number, $price)
    {
        $bdd = self::connect($number);
        $bdd = self::init($bdd);
        if ($bdd != "") { // si la connexion est OK

            // si l'utilisateur existe pas, on le crée
            self::createnewuser($number,$bdd);

            // on regarde si l'argent est suffisant

            $solde = self::getcash($number, $bdd);
            if ($solde > $price) {
                //on soustrait l'argent
                $solde = $solde[0] - $price;
                try {
                    $bdd->exec('UPDATE account SET Cash = ' . $solde . ' WHERE Number = ' . $number . '');
                    self::getinfo($number, $bdd);
                    return true;
                } catch (Exception $e) {
                    return false;
                }
            }
        }
    }
}