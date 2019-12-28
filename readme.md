# PSR-14 WP
Very simple PSR-14 Event Dispatcher for WordPress.

## Usage
```php
use IronBound\Psr14WP\EventDispatcher;
use function IronBound\Psr14WP\listen;

listen( static function( Your_Event $event ) {
    // Do something with $event
} );

$event_dispatcher = new EventDispatcher();
$dispatched = $event_dispatcher->dispatch( new Your_Event() );
```
