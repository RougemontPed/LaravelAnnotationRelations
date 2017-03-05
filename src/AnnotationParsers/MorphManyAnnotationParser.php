<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\AnnotationParams\MorphManyAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class MorphManyAnnotationParser extends AnnotationParser
{
    use OwnerNameGuesser;

    /**
     * Related class
     *
     * @var string
     */
    protected $related;

    /**
     * Owner
     *
     * @var string
     */
    protected $owner;

    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $className
     * @return AnnotationParameters
     * @throws BadAnnotationException
     */
    public function handle($parameters, $className)
    {
        return new MorphManyAnnotationParameters(
            $this->getRelationshipClassName($this->related, $this->getClassNamespaceName($className)),
            $this->owner
        );
    }

    /**
     * Validate annotation parameters
     *
     * @param string $parameters
     * @throws BadAnnotationException
     */
    protected function validateParameters($parameters)
    {
        if (!$parameters) {
            throw new BadAnnotationException('Annotation should\'nt be empty');
        }

        $params = explode(' ', $parameters);

        if (count($params) !== 1 && count($params) !== 2) {
            throw new BadAnnotationException('Annotation params should contain 1 or 2 parameters');
        }

        if (count($params) === 2) {
            list($this->related, $this->owner) = $params;
        } else {
            $this->related = $params[0];
            $this->owner = $this->guessOwnerName(str_singular($this->related));
        }

        if (!$this->isValidClassOrMethodName($this->related) || !$this->isValidClassOrMethodName($this->owner)) {
            throw new BadAnnotationException('Annotation params should contain 2 parameters');
        }
    }
}
