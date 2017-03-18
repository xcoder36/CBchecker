<?php
require_once ('Data.php');
class Controller {
    private static function checknumber ($number) { // verification des numéro de la carte
        if (is_numeric($number) == false) { // on vérifie qu'il y a que des chiffres
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

        if (is_numeric($month) == false) { // on regarde si le mois est bien un chiffre
            return false;
        } elseif (is_numeric($year) == false) { // on regarde si l'année est bien un chiffre
            return false;
        } elseif ($month < 1) { // on regarde si le mois est superieur a 0
            return false;
        } elseif ($month > 13) { // on regarde si le mois est inferieur a 13
            return false;
        } elseif (strlen($year) != 4 ) { // On regarde si l'année fait bien 4 chiffres
            return false;
        }elseif ($year < date("Y") ) { // On regarde si l'année est pas inferieure a l'année actuelle
            return false;
        }

        if ($year == date("Y")) // si l'année est la même que l'année en cours, on vérifie le mois
        {
            if ($month < date('n'))
            {
                return false;
            }

        }

        return true; // si les tests sont passé on retourne que tout est OK
    }


    public static function checkCB ($number, $cvv,$month, $year,$price) // le programme qui est appelé 
    {
        if (self::checknumber($number)) // vérification des chiffres présent sur la carte
        {
            if (self::checkcvv($cvv)) // vérification de la CVV
            {
                if (self::checkdate($month, $year) ) // vérification de la date
                {
                    if (self::checkprice($price)) { // vérification du prix
                        if (Data::payment($number, $price) == false) { // vérifie le montant et procède au paiement
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