<?php

namespace Rx;

use Rx\Observer\CallbackObserver;

function is($class): callable
{
    return function ($value) use ($class): bool {
        return is_a($value, $class);
    };
}

function equalTo($a): callable
{
    return function ($b) use ($a): bool {
        return $a == $b;
    };
}

function notEqualTo($a): callable
{
    return function ($b) use ($a): bool {
        return $a != $b;
    };
}

function same($a): callable
{
    return function ($b) use ($a): bool {
        return $a === $b;
    };
}

function notSame($a): callable
{
    return function ($b) use ($a): bool {
        return $a !== $b;
    };
}

function add($accum, $value)
{
    return $accum + $value;
}

function concat($accum, $value): string
{
    return $accum . $value;
}

function concatLeft($accum, $value): string
{
    return $value . $accum;
}

function sub($accum, $value)
{
    return $accum - $value;
}

function mult($accum, $value)
{
    return $accum * $value;
}

function echoLine($value)
{
    echo $value, PHP_EOL;
}

function odd($number)
{
    return $number % 2 !== 0;
}

function even($number)
{
    return $number % 2 === 0;
}

function echoObserver($prefix = '')
{
    return new CallbackObserver(
        function ($value) use ($prefix) {
            echo $prefix . 'Next value: ' . asString($value) . PHP_EOL;
        },
        function (\Throwable $error) use ($prefix) {
            echo $prefix . 'Exception: ' . $error->getMessage() . PHP_EOL;
        },
        function () use ($prefix) {
            echo $prefix . 'Complete! ' . PHP_EOL;
        }
    );
}

function echoFinally($prefix = ''): callable
{
    return function (Observable $observable) use ($prefix): Observable {
        return $observable->finally(function () use ($prefix) {
            echo $prefix . 'Finally! ' . PHP_EOL;
        });
    };
}

function asString($value): string
{
    if (is_array($value)) {
        return json_encode($value);
    }

    if (is_bool($value)) {
        return (string)(integer)$value;
    }

    return (string)$value;
}

/**
 * Partial Apply
 *
 * @param callable $func
 * @param $lastValue
 * @return callable
 *
 */
function p(callable $func, $lastValue): callable
{
    return function ($value) use ($func, $lastValue) {
        return $func($value, $lastValue);
    };
}