<?php
require_once ('Data.php');
$i = 0;
echo "utilisateurs crées <br/>";
while ($i < 10 ){
    $nbaleatoirecb = rand (1111111111111111 , 9999999999999999 );
    Data::createnewuser($nbaleatoirecb,Data::connect() );
    $i = $i + 1;
    echo $nbaleatoirecb;
    echo "<br/>";
}