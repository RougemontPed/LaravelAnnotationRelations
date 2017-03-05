<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

trait OwnerNameGuesser
{
    protected $resolvedOwnerNames = [
        'prefer' => 'preferable',
        'forget' => 'forgettable',
        'regret' => 'regrettable',
    ];

    /**
     * Tries to guess owner name by class name
     *
     * @param string $className
     * @return string
     */
    protected function guessOwnerName($className)
    {
        // get class base name
        $className = strtolower(class_basename($className));

        if (isset($this->resolvedOwnerNames[$className])) {
            return $this->resolvedOwnerNames[$className];
        }

        if (ends_with($className, 'e')) {
            // if class name suffix is ge then e keeps
            // or if class name suffix is ce then e keeps
            if (ends_with($className, 'ge') || ends_with($className, 'ce')) {
                return $className . 'able';
            } else {
                // else if last letter is 'e' then it drops
                return substr($className, 0, -1) . 'able';
            }
        }

        // if class name suffix is consonant + y then y changes to i
        if (strlen($className) > 1 &&
            $this->isConsonant($className[strlen($className) - 2]) && // last but one char is consonant
            ends_with($className, 'y')
        ) {
            return substr($className, 0, -1) . 'iable';
        }

        // if class name suffix is single vowel + consonant then consonant doubles in some cases
        if (strlen($className) > 1 &&
            $this->isVowel($className[strlen($className) - 2]) && // last but one char is vowel
            $this->isConsonant($className[strlen($className) - 1]) && // last char is consonant
            $this->onlyOneVowelInWord($className)
        ) {
            return $className . $className[strlen($className) - 1] . 'able';
        }

        return $className . 'able';
    }

    /**
     * Is char consonant
     *
     * @param string $char
     * @return bool
     */
    protected function isConsonant($char)
    {
        return (bool)preg_match('/[b-df-hj-np-tv-z]/', $char);
    }

    /**
     * Is char vowel
     *
     * @param string $char
     * @return bool
     */
    protected function isVowel($char)
    {
        return !$this->isConsonant($char);
    }

    /**
     * Returns true if there is only one vowel in word
     *
     * @param string $word
     * @return bool
     */
    protected function onlyOneVowelInWord($word)
    {
        return 1 === array_reduce(str_split($word), function ($vowelsCount, $letter) {
                return $vowelsCount + (int)$this->isVowel($letter);
        }, 0);
    }
}
