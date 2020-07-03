<?php
namespace Facebook\V1\Rest\AssociatedData;

class AssociatedDataResourceFactory
{
    public function __invoke($services)
    {
        return new AssociatedDataResource();
    }
}
