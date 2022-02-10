<?php
require_once "autoload.php";

function StripSpaces( array $arr ): array
{
    foreach ( $arr as $key => $value )
    {
        if (gettype($value) != "array"){
            $arr[$key] = trim($value);
        }
    }
    return $arr;


}

function ConvertSpecialChars( array $arr ): array
{
    foreach ( $arr as $key => $value )
    {

        if (gettype($value) != "array"){
            $arr[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

    }

    return $arr;
}