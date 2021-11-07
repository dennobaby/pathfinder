<?php

namespace Denno\PathFinder;

final class PathFinder
{
    /**
     * @param $array
     * @param $path
     * @return false|mixed
     */
    public static function getPathValue($array, $path)
    {
        $pre = $array;
        $steps = explode('.', $path);
        $last = array_key_last($steps);
        foreach ($steps as $key => $step){
            if(isset($pre[$step])){
                $pre = $pre[$step];
            } else {
                return false;
            }
            if($key === $last){
                return $pre;
            }

        }
        return false;
    }

    /**
     * @param $array
     * @param $path
     * @param $value
     */
    public static function setPathValue(&$array, $path, $value)
    {
        $pre = &$array;
        if(self::getPathValue($pre, $path)){
            $steps = explode('.', $path);
            foreach ($steps as $step){
                $pre = &$pre[$step];
            }
            $pre = $value;
        }
    }
}