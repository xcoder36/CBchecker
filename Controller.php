<?php
require_once ('Data.php');
class Controller {
    private static function checknumber ($number) { // verification des numéro de la carte
        if (is_numeric($number) == false) { // on vérifie qu'il y a que des chiffres
            echo "testici";
            return false;
        } elseif (strlen($number) != 16 ) { // et qu'il y a bien 16 chiffres
            return false;
        }
        return true; // si les tests sont passé on retourne que tout est OK
    }

    private static function checkprice ($price) { // verification du prix
        if (is_numeric($price) == false) { // on vérifie qu'il y a que des chiffres
            return false;
        } else{
            return true; // si les tests sont passé on retourne que tout est OK
        }

    }

    private static function checkcvv($cvv)  // vérification de la CVV
    {
        if (is_numeric($cvv) == false) { // on regarde qu'il y a que des chiffres
            return false;
        } elseif (strlen($cvv) != 3 ) { // et qu'il y a bien 3 chiffres
            return false;
        }
        return true; // si les tests sont passé on retourne que tout est OK

    }

    private static function checkdate($month, $year) // vérification de la date de validité de la carte
    {

        if (is_numeric($month) == false && is_numeric($year) == false) { // on regarde si le mois et l'année sont bien des chiffre
            return false;
        } elseif ($month < 1 AND $month > 12) { // on regarde si le mois est compris entre 1 et 12
            echo $month;
            return false;
        } elseif (strlen($year) != 4 ) { // On regarde si l'année fait bien 4 chiffres
            return false;
        }elseif ($year < date("Y") ) { // On regarde si l'année est pas inferieure a l'année actuelle
            return false;
        }

        if ($year == date("Y")) // si l'année est la même que l'année en cours, on vérifie le mois
        {
            if ($year < date('n'))
            {
                return false;
            }

        }

        return true; // si les tests sont passé on retourne que tout est OK
    }


    public static function checkCB ($number, $cvv,$month, $year,$price) // le programme qui est appelé 
    {
        if (self::checknumber($number))
        {
            if (self::checkcvv($cvv))
            {
                if (self::checkdate($month, $year) )
                {
                    if (self::checkprice($price)) {
                        if (Data::payment($number, $price) == false) {
                            echo "Montant insufisant";
                            return "Montant insufisant";
                        }
                    } else {
                        echo "erreur prix";
                        return "erreur prix";
                    }
                } else {
                    echo "erreur date";
                    return "erreur date";
                }
            } else {
                echo "CVV non valide";
                return "CVV non valide";
            }
        } else {
            echo "Nombre non valide";
            return "Nombre non valide";
        }
    }
}