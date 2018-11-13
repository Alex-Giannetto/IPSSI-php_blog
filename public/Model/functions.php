<?php

/**
 * Return a safety version of the input
 * @param $input : any
 * @return string
 */
function inputSanitizer($input)
{
    $input = trim($input);
    $input = strip_tags($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = htmlentities($input);

    return $input;
}

function checkField($value, array $length = ['min' => 0, 'max' => 9999999999], array $authorizedValue = [])
{
    if (strlen($value) >= $length['min'] && strlen($value) <= $length['max']) {
        if (count($authorizedValue) > 0) {

            return in_array($value, $authorizedValue);
        }

        return true;
    } else {

        return false;
    }
}


function getPDO()
{
    try {
        return new PDO('mysql:host=db;dbname=blog;charset=utf8', 'alex', 'monFabuleuxMotDePasse');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


function dump($element)
{
    echo '<pre>';
    var_dump($element);
    echo '</pre>';
}

function printer($element){
    echo '<pre>';
    print_r($element);
    echo '</pre>';
}

