<?php
/**
 * The main class file.
 *
 * @package Scanfully
 */

namespace Scanfully;

use Scanfully\Health\Controller;

/**
 * The main class, this is where it all starts.
 */
class Main {

	/**
	 * The singleton instance.
	 *
	 * @var ?Main
	 */
	private static $instance = null;

	/**
	 * Singleton getter
	 *
	 * @return Main|null
	 */
	public static function get(): ?Main {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Setup the plugin.
	 *
	 * @return void
	 */
	public function setup(): void {
		/** Register all events */
		Events\Controller::register( new Events\ActivatedPlugin() ); // when a plugin is activated.
		Events\Controller::register( new Events\DeactivatedPlugin() ); // when a plugin is deactivated.
		Events\Controller::register( new Events\RewriteRules() ); // when new rewrite rules are saved.
		Events\Controller::register( new Events\PostSaved() ); // when a post status is changed.

		/** Register options */
		Options\Options::register();
		Options\Page::register();

		if(isset($_GET['barry'])) {
			add_action('after_setup_theme', function() {
				Controller::send_health_request();
			});
		}
	}
}
