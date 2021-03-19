<?php

namespace App\Handler;

/**
 * Interface HandlerInterface
 *
 * Must be implemented in the handlers.
 */
interface HandlerInterface
{
    /**
     * Get a resource
     *
     * @param int $id
     * @return Object
     */
    public function get($id);

    /**
     * Get a collection of resources
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function all($limit, $offset);

    /**
     * Register a resource
     *
     * @param $resource
     * @return mixed
     */
    public function post($resource);
}
