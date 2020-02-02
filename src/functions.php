<?php

/**
 * API functions.
 *
 * @author      Iron Bound Designs
 * @since       1.0
 * @copyright   2019 (c) Iron Bound Designs.
 * @license     GPLv2
 */

declare(strict_types=1);

namespace IronBound\Psr14WP;

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Registers a listener for an event.
 *
 * @param callable $callable The function to be called back. The type of the first parameter
 *                           will determine what event the function is called for.
 * @param int      $priority The WordPress priority to place the hook. Larger priority numbers
 *                           will execute the hook later.
 * @param string   $prefix   The string all hook names are prefixed by. Must be the same used
 *                           when configuring the {@see EventDispatcher}.
 */
function listen(callable $callable, int $priority = 10, string $prefix = EventDispatcher::DEFAULT_PREFIX): void
{
    $class = ParameterDeriver::getParameterType($callable);
    \add_action($prefix . $class, static function (object $subject) use ($callable) {
        if ($subject instanceof StoppableEventInterface && $subject->isPropagationStopped()) {
            return;
        }

        $callable($subject);
    }, $priority);
}
