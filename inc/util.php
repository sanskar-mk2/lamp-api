<?php

class Util
{
    /*
    *
    */
    public static function shift_to_index(&$arr)
    {
        while ($arr[0] != "index.php") {
            array_shift($arr);
        }
    }
}
