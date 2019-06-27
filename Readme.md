# Laravel event and listener upgrade

   - This package improve the way laravel manage his listener to be able to listen on parent class of the event
   - This package allow storing the event in the database in order to make them restorable
   
## Installation

   Add an Extends from `Bepark\Eventer\EventServiceProvider` to the event provider class `App\Provider\EventServiceProvider`
      
## Usage in listener

	/**
	 * @param Dispatcher $events
	 */
	public function subscribe(Dispatcher $events)
	{
		$events->listen(
			EditMyModelEvent::class,
			__CLASS__ . '@onEditEvent'
		);
		$events->listen(
			CreateMyModelEvent::class,
			__CLASS__ . '@onCreateEvent'
		);
	}
	
	public function onEditEvent($event) {};
	public function onCreateEvent($event) {};
