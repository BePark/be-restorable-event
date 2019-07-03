<?php

return [
	/**
	 * You can choose to also record all eloquent event to your database
	 */
    'listen_on_eloquent' => false,
    'eloquent_event_to_listen' => ['retrieved', 'creating', 'created', 'updating', 'updated', 'saving', 'saved', 'deleting', 'deleted', 'restoring', 'restored'],
];
