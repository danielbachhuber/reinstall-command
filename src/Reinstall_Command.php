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
		if ( false !== stripos( $core_version, '-alpha-' ) ) {
			$core_version = 'nightly';
		}
		WP_CLI::runcommand( "core download --skip-content --version={$core_version} --force", array( 'exit_error' => false ) );

		$plugins = WP_CLI::runcommand( 'plugin list --format=json', array(
			'return' => true,
			'parse'  => 'json',
		) );
		foreach ( $plugins as $plugin ) {
			if ( 'hello' === $plugin['name'] ) {
				WP_CLI::log( 'Skipped hello plugin.' );
				continue;
			};
			if ( in_array( $plugin['status'], array( 'dropin', 'must-use' ), true ) ) {
				WP_CLI::log( "Skipped {$plugin['status']} plugin {$plugin['name']}." );
				continue;
			}
			WP_CLI::runcommand( "plugin install {$plugin['name']} --version={$plugin['version']} --force", array( 'exit_error' => false ) );
		}

		$themes = WP_CLI::runcommand( 'theme list --format=json', array(
			'return' => true,
			'parse'  => 'json',
		) );
		foreach ( $themes as $theme ) {
			WP_CLI::runcommand( "theme install {$theme['name']} --version={$theme['version']} --force", array( 'exit_error' => false ) );
		}

		WP_CLI::success( 'Reinstall complete.' );
	}

}
