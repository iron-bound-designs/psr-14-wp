<?php

/**
 * Event Dispatcher implementation.
 *
 * @author      Iron Bound Designs
 * @since       1.0
 * @copyright   2019 (c) Iron Bound Designs.
 * @license     GPLv2
 */

declare(strict_types=1);

namespace IronBound\Psr14WP;

use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    public const DEFAULT_PREFIX = 'ironbound.psr14wp.';

    /** @var string */
    private $prefix;

    /**
     * EventDispatcher constructor.
     *
     * @param string $prefix
     */
    public function __construct(string $prefix = self::DEFAULT_PREFIX)
    {
        $this->prefix = $prefix;
    }

    /**
     * Dispatches an Event to WordPress actions.
     *
     * Will fire separate actions for the event's class,
     * then all parent classes in ascending order up the hierarchy chain,
     * then all interfaces in ascending order up the hierarchy chain.
     *
     * @param object $event
     *
     * @return object
     */
    public function dispatch(object $event)
    {
        $this->call(get_class($event), $event);

        foreach (class_parents($event) as $parent) {
            $this->call($parent, $event);
        }

        foreach (class_implements($event) as $interface) {
            $this->call($interface, $event);
        }

        return $event;
    }

    protected function call(string $class, object $event): void
    {
        do_action($this->prefix . $class, $event);
    }
}
