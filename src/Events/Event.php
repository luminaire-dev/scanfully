<?php

namespace Scanfully\Events;

use Scanfully\API\EventRequest;

/**
 * Class Event
 */
abstract class Event {

	/**
	 * The type of event
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Action to listen to
	 *
	 * @var string
	 */
	private $action;

	/**
	 * Priority of the action
	 *
	 * @var int
	 */
	private $priority = 10;

	/**
	 * Accepted arguments
	 *
	 * @var int
	 */
	private $accepted_args = 1;

	/**
	 * Constructor
	 *
	 * @param  string $event The type of event.
	 * @param  string $action The action to listen to.
	 * @param  int    $priority The priority of the action.
	 * @param  int    $accepted_args The accepted arguments.
	 */
	public function __construct(
		string $event,
		string $action,
		int $priority = 10,
		int $accepted_args = 1
	) {
		$this->type          = $event;
		$this->action        = $action;
		$this->priority      = $priority;
		$this->accepted_args = $accepted_args;

		$this->add_listener();
	}

	/**
	 * Add the listener to the action
	 *
	 * @return void
	 */
	private function add_listener(): void {
		add_action( $this->action, [ $this, 'listener_callback' ], $this->priority, $this->accepted_args );
	}

	/**
	 * Get the current user
	 *
	 * @return array
	 */
	private function get_user(): array {
		$current_user = wp_get_current_user();

		return [
			'id'   => $current_user->ID,
			'name' => $current_user->display_name,
		];
	}


	/**
	 * The callback for the action
	 *
	 * @param  any ...$args The arguments passed to the action.
	 *
	 * @return void
	 */
	public function listener_callback( ...$args ): void {
		$request = new EventRequest();
		$request->send_event(
			[
				'type' => $this->type,
				'user' => $this->get_user(),
				'data' => $this->get_post_body( $args ),
			]
		);
	}

	/**
	 * Get the post body
	 *
	 * @param  array $data The data passed to the action.
	 *
	 * @return array
	 */
	abstract protected function get_post_body( array $data ): array;
}
