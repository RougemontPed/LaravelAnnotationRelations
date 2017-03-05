<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationParsers\OwnerNameGuesser;

class OwnerNameGuesserExample
{
    use OwnerNameGuesser;

    /**
     * Tries to guess owner name
     *
     * @param string $className
     * @return string
     */
    public function tryToGuessOwnerName($className)
    {
        return $this->guessOwnerName($className);
    }
}
