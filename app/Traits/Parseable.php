<?php

namespace App\Traits;

trait Parseable
{
    public function removeWithRegex($string,$regex){
        return preg_replace($regex, '',$string);
    }
}
