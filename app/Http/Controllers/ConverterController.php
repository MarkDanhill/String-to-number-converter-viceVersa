<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConverterRequest;
use App\Models\One;
use App\Models\PlaceValue;
use App\Models\Postfix;
use App\Models\Teen;
use App\Models\Ten;
use App\Traits\Parseable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConverterController extends Controller
{
    use Parseable;

    private $ones;
    private $postfix;
    private $tens;
    private $teens;
    private $placeValues;

    public function __construct()
    {
        $this->ones = $this->formatArray(One::class, 'name', 'value');
        $this->postfix = $this->formatArray(Postfix::class, 'name', 'value');
        $this->tens = $this->formatArray(Ten::class, 'name', 'value');
        $this->teens = $this->formatArray(Teen::class, 'name', 'value');
        $this->placeValues = $this->formatArray(PlaceValue::class, 'name', 'value');
    }

    public function convert(ConverterRequest $request)
    {

        $string = $request['string'];
        $digit = $request['number'];
        $converted = 0;
        if ($request['string']) {
            $digit = $this->convertStringToDigits($request);
        }
        if ($request['number']) {
            $string = $this->convertDigitsToString($request);
        }
        if ($digit) {
            $converted = $this->convertPhpToUsd($digit);
        }
        return ['string' => $string, 'digit' => $digit, 'converted' => $converted];
    }

    public function convertStringToDigits(Request $request)
    {
        if ($request['string']) {
            $string = $this->removeWithRegex($this->removeWithRegex($request['string'], '/\sand\s/'), '/\s/');
            $string = strtolower($string);
            $stringArray = str_split($string);
            $stringHolder = '';
            $hasOnes = 0;
            $hasMultiplier = 0;
            $number = 0;

            for ($i = 0; $i < count($stringArray); $i++) {
                $stringHolder .= $stringArray[$i];
                if (array_key_exists($stringHolder, $this->ones)) {
                    $hasOnes = $this->ones[$stringHolder];
                    $stringHolder = '';
                }
                if (array_key_exists($stringHolder, $this->postfix)) {
                    $hasMultiplier = $this->postfix[$stringHolder];
                    $stringHolder = '';
                }


                // if()

                if ($hasOnes && $hasMultiplier) {
                    $number += $hasOnes * $hasMultiplier;
                    $hasOnes = 0;
                    $hasMultiplier = 0;
                }
                if ($hasMultiplier) {
                    $number *= $hasMultiplier;
                    $hasMultiplier = 0;
                }
                // if ($hasOnes && !$hasMultiplier && $number) {
                //     $number += $hasOnes; //3
                //     $hasOnes = 0;
                //     $stringHolder = '';
                // }
            }

            return  $number + $hasOnes;
        }
    }

    public function convertDigitsToString(Request $request)
    {
        $numberArr = $this->formatDigits($request['number']);
        $digitString = '';
        $arraylength = count($numberArr);

        for ($i = 0; $i < $arraylength; $i++) {
            for ($j = 0; $j <= 2; $j++) {
                if ($j == 0 && $numberArr[$i][$j] != 0) {
                    $digitString .= sprintf(' %s hundred', array_search($numberArr[$i][$j], $this->ones));
                } elseif ($j == 1 && $numberArr[$i][$j] == 1) {
                    $digitString .= sprintf(' %s ', array_search($numberArr[$i][$j] . $numberArr[$i][$j + 1], $this->teens));
                    break;
                } elseif ($j == 1) {
                    $digitString .= sprintf(' %s ', array_search($numberArr[$i][$j], $this->tens));
                } else {
                    $digitString .= sprintf(' %s ', array_search($numberArr[$i][$j], $this->ones));
                }
            }
            if ($arraylength > 1 && $i != $arraylength - 1) {
                $digitString = $digitString . array_search($arraylength - $i, $this->placeValues);
            }
        }

        return trim($digitString);
    }

    public function convertPhpToUsd($digit)
    {
        $apiKey = 'e48028b4bff4aab123421977';
        $response = Http::get("https://v6.exchangerate-api.com/v6/$apiKey/latest/USD");
        $phpvalue = $response->object()->conversion_rates->PHP ?? 0;
        return $digit / $phpvalue ?? 0;
    }

    private function formatDigits($number)
    {
        $remainder = strlen($number) % 3;

        if ($remainder !== 0) {
            $zerosToAdd = 3 - $remainder;
            $number = str_repeat('0', $zerosToAdd) . $number;
        }

        return array_chunk(str_split($number), 3);
    }

    private function formatArray($model, $key, $value)
    {
        return $model::select([$key, $value])->get()->flatMap(function ($item) use ($key, $value) {
            return [$item[$key] => $item[$value]];
        })->toArray();
    }
}
