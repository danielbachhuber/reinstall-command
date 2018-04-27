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
	 *
	 * ## EXAMPLES
	 *
	 *     # Reinstalls core, Aksimet, and Twenty Sixteen
	 *     $ wp reinstall
	 *     Downloading WordPress 4.7.10 (en_US)...
	 *     md5 hash verified: 57813ca592cd9a1eff210627ade9f350
	 *     Success: WordPress downloaded.
	 *     Installing Akismet Anti-Spam (3.3.2)
	 *     Plugin updated successfully.
	 *     Success: Installed 1 of 1 plugins.
	 *     Skipped hello plugin.
	 *     Installing Twenty Sixteen (1.3)
	 *     Theme updated successfully.
	 *     Success: Installed 1 of 1 themes.
	 *     Success: Reinstall complete.
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
