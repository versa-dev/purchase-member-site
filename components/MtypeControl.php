<?php


namespace app\components;


class MtypeControl
{

    //added by GP
    //get unique pay_code
    public static function getPayCode($userId){

        $arr = ['A', 'B', 'C', 'D', 'E', 'F','G', 'H', 'I','J', 'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

        $idNumber = intval($userId);

        $thirdVal = $idNumber % 999;
        $tempVal = $idNumber / 999;

        $secondVal = $tempVal % 26;
        $tempVal = $tempVal / 26;
        $firstVal = $tempVal % 26;

        $realVal = $arr[$firstVal].$arr[$secondVal];

        if ($thirdVal < 10)
        {
            $realVal .= "00".strval($thirdVal);
        }
        else if ($thirdVal >= 10 && $thirdVal < 100)
        {
            $realVal .= "0".strval($thirdVal);
        }
        else{
            $realVal .= strval($thirdVal);
        }

        return $realVal;
    }

    //    added by GP
    public static function getMtype($age)
    {
        $realAge = intval($age);
        $retVal = "";
        if ($age <= 18)
        {
            $retVal = 'U';
        }
        else{
            $retVal = 'A';
        }

        return $retVal;
    }

    public static function getMemberMtype($age)
    {
        $realAge = intval($age);
        $retVal = "";
        if ($age <= 18)
        {
            $retVal = 'D';
        }
        else if( $age > 18 && $age < 40){
            $retVal = 'G';
        }
        else{
            $retVal = 'P';
        }

        return $retVal;

    }
}