<?php
/**
 * Reinstalls WordPress core, themes, and plugins.
 */
class Reinstall_Command {

	/**
	 * Reinstalls WordPress core, themes, and plugins.
	 *
	 * Downloads and forcefully reinstalls WordPress core, themes, and plugins,
	 * all at their current versions. Skips themes and plugins not available on
	 * WordPress.org.
	 */
	public function __invoke() {
		$core_version = WP_CLI::runcommand( 'core version', array( 'return' => true ) );
		WP_CLI::runcommand( "core download --version={$core_version} --force" );
		WP_CLI::success( 'Reinstall complete.' );
	}

}
