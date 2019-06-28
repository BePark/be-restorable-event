# Laravel event and listener upgrade

   - This package improve the way laravel manage his listener to be able to listen on parent class of the event
   - This package allow storing the event in the database in order to make them restorable
   
## Installation

   Add an Extends from `Bepark\Eventer\EventServiceProvider` to the event provider class `App\Provider\EventServiceProvider`
    
   With just this installation the event will be saved in your database.
      
## Listen on parent class

   You can listen on the parent class of the triggered event by using the EventHelper.
   Check the StorableEventListener to see how it works.
   
       class StorableEventListener
       {
           public function onStorableEvent(RestorableEvent $event)
           {
               Event::createFromStorableEvent($event);
           }
       
           public function subscribe(Dispatcher $event)
           {
               EventHelper::listenWithChildren($event, RestorableEvent::class, __CLASS__ . '@onStorableEvent');
           }
       }
