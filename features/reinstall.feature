Feature: Reinstall WordPress core, themes, and plugins

  Scenario: WordPress core is reinstalled
    Given a WP install
    And I run `wp core download --version=4.9.4 --force`
    And "GPL" replaced with "MIT" in the license.txt file

    When I try `wp core verify-checksums`
    Then STDERR should contain:
      """
      Warning: File doesn't verify against checksum: license.txt
      """

    When I run `wp reinstall`
    Then STDOUT should contain:
      """
      Success: WordPress downloaded.
      """
    And STDOUT should contain:
      """
      Success: Reinstall complete.
      """

    When I run `wp core verify-checksums`
    Then STDOUT should contain:
      """
      Success:
      """

    When I run `wp core version`
    Then STDOUT should be:
      """
      4.9.4
      """

  Scenario: Plugins are reinstalled
    Given a WP install
    And I run `wp plugin install akismet --version=3.3.2 --force`

    When I run `wp plugin get akismet --field=version`
    Then STDOUT should contain:
      """
      3.3.2
      """

    When I run `wp reinstall`
    Then STDOUT should contain:
      """
      Installing Akismet
      """
    And STDOUT should contain:
      """
      Success: Reinstall complete.
      """

    When I run `wp plugin get akismet --field=version`
    Then STDOUT should contain:
      """
      3.3.2
      """

  Scenario: mu-plugins are skipped
    Given a WP install
    And a wp-content/mu-plugins/local.php file:
      """
      <?php
      // Silence is golden.
      """

    When I run `wp reinstall`
    Then STDOUT should contain:
      """
      Skipped must-use plugin local.
      """
    And STDOUT should contain:
      """
      Success: Reinstall complete.
      """
