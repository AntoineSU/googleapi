<?php
    require __DIR__ . "/vendor/autoload.php";

    use App\GoogleAPI;

    $id = "1O0oSp2y1i_sNO2vuEjRg2Qjt4cNbLjYzlJ9YW9YLUJM";
    $range = "Sheet1!A1";
    $values = [
        [ "Ça fonctionne !" ]
    ];

    GoogleAPI::sheetAppend($id, $range, $values);