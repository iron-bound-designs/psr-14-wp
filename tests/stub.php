<?php

// phpcs:ignoreFile

/**
 * Test Subs.
 *
 * @author      Iron Bound Designs
 * @since       1.0
 * @copyright   2019 (c) Iron Bound Designs.
 * @license     GPLv2
 */

declare(strict_types=1);

namespace IronBound\Psr14WP\Tests\Stub;

interface ParentInterface
{

}

interface ChildInterface extends ParentInterface
{

}

interface SiblingInterface extends ParentInterface
{

}

class GrandParentClass
{

}

class ParentClass extends GrandParentClass
{

}

class ChildClass extends ParentClass
{

}

class Stub extends ChildClass implements ChildInterface, SiblingInterface
{

}
