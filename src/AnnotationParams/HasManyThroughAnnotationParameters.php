<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

class HasManyThroughAnnotationParameters extends AnnotationParameters
{
    /**
     * Related class name
     *
     * @var string
     */
    protected $related;

    /**
     * Through class name
     *
     * @var string
     */
    protected $through;

    public function __construct($related, $through)
    {
        $this->related = $related;
        $this->through = $through;
    }

    /**
     * Return relationship method name
     *
     * @return string
     */
    public function getRelationshipMethodName()
    {
        return str_plural(lcfirst(class_basename($this->related)));
    }

    /**
     * Return relationship method parameters
     *
     * @return array
     */
    public function getRelationshipMethodParameters()
    {
        return [
            $this->related,
            $this->through,
        ];
    }
}
