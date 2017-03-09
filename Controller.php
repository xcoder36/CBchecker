<?php
require_once ('Data.php');
class Controller {
    private static function checknumber ($number) {
        if (is_numeric($number) == false) { // on regarde qu'il y a que des chiffres
            return false;
        } elseif (strlen($number) != 16 ) { // si il n'y a pas 16 chiffres
            return false;
        }
        return true; // on retourne que tout est OK
    }

    private static function checkcvv($cvv)  // Permet d'extraire le contenu d'une balise DOM
    {
        if (is_numeric($cvv) == false) { // on regarde qu'il y a que des chiffres
            return false;
        } elseif (strlen($cvv) != 3 ) { // si il n'y a pas 3 chiffres
            return false;
        }
        return true; // on retourne que tout est OK

    }

    // Permet d'extraire chaque mot d'une phrase pour les mettre dans un array.
    private static function checkdate($month, $year)
    {

        if (is_numeric($month) == false && is_numeric($year) == false) { // on regarde si le mois et l'année sont bien des chiffre
            return false;
        } elseif ($month < 1 AND $month > 12) { // on regarde si le mois est compris entre 1 et 12
            echo $month;
            return false;
        } elseif (strlen($year) != 4 ) { // On regarde si l'année fait bien 4 chiffres
            return false;
        }elseif ($year < date("Y") ) { // On regarde si l'année fait bien 4 chiffres
            return false;
        }

        //on check si la carte est toujours valide)
        if ($year == date("Y"))
        {
            if ($year < date('n'))
            {
                return false;
            }

        }

        return true; // on retourne que tout est OK
    }

    //supprime une balise et son contenu
    public static function checkCB ($number, $cvv,$month, $year,$price)
    {
        if (self::checknumber($number))
        {
            if (self::checkcvv($cvv))
            {
                if (self::checkdate($month, $year) )
                {
                    if (Data::payment($number,$price) == false)
                    {
                        echo "Montant insufisant";
                    }
                } else {
                    echo "erreur date";
                }
            } else {
                echo "CVV non valide";
            }
        } else {
            echo "Nombre non valide";
        }
    }
}