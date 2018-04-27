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
