# Laravel event and listener upgrade

   - This package improve the way laravel manage his listener to be able to listen on parent class of the event
   - This package allow storing the event in the database in order to make them restorable
   
## Installation

   Add an Extends from `Bepark\Eventer\EventServiceProvider` to the event provider class `App\Provider\EventServiceProvider`
    
   With just this installation the event will be saved in your database.
      
## Listen on parent class

   You can listen on the parent class of the triggered event by using the EventHelper.
   Check the StorableEventListener to see how it works.
   
   `listenWithChildren()` will start listening on all event and will call the listener when it match.
   
   Call it in the subscribe() method of your listener
   
    EventHelper::listenWithChildren(Dispatcher $event, <ParentClass>, 'ListenerClass@method');
   
