<?php

/**
 * Test the Event Dispatcher.
 *
 * @author      Iron Bound Designs
 * @since       1.0
 * @copyright   2019 (c) Iron Bound Designs.
 * @license     GPLv2
 */

declare(strict_types=1);

namespace IronBound\Psr14WP\Tests;

use IronBound\Psr14WP\EventDispatcher;
use IronBound\Psr14WP\Tests\Stub\{
    ChildClass,
    ChildInterface,
    GrandParentClass,
    ParentClass,
    ParentInterface,
    SiblingInterface,
    Stub
};
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    public function testDispatch(): void
    {
        $stub       = new Stub();
        $dispatcher = $this->getMockBuilder(EventDispatcher::class)
            ->onlyMethods([ 'call' ])
            ->getMock();

        $dispatcher->expects($this->exactly(7))
            ->method('call')
            ->withConsecutive(
                [ Stub::class, $this->identicalTo($stub) ],
                [ ChildClass::class, $this->identicalTo($stub) ],
                [ ParentClass::class, $this->identicalTo($stub) ],
                [ GrandParentClass::class, $this->identicalTo($stub) ],
                [ ChildInterface::class, $this->identicalTo($stub) ],
                [ SiblingInterface::class, $this->identicalTo($stub) ],
                [ ParentInterface::class, $this->identicalTo($stub) ]
            );

        $dispatcher->dispatch($stub);
    }
}
