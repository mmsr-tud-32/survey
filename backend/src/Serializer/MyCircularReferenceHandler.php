<?php

namespace App\Serializer;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 19/06/2019
 */
class MyCircularReferenceHandler {
    public function __invoke($object)
    {
        return $object->getId();
    }
}
