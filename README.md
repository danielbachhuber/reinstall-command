danielbachhuber/reinstall-command
=================================

Reinstalls WordPress core, themes, and plugins.

[![Build Status](https://travis-ci.org/danielbachhuber/reinstall-command.svg?branch=master)](https://travis-ci.org/danielbachhuber/reinstall-command)

Quick links: [Using](#using) | [Installing](#installing) | [Contributing](#contributing) | [Support](#support)

## Using

~~~
wp reinstall 
~~~

Downloads and forcefully reinstalls WordPress core, themes, and plugins,
all at their current versions. Skips themes and plugins not available on
WordPress.org.

**EXAMPLES**

    # Reinstalls core, Aksimet, and Twenty Sixteen
    $ wp reinstall
    Downloading WordPress 4.7.10 (en_US)...
    md5 hash verified: 57813ca592cd9a1eff210627ade9f350
    Success: WordPress downloaded.
    Installing Akismet Anti-Spam (3.3.2)
    Plugin updated successfully.
    Success: Installed 1 of 1 plugins.
    Skipped hello plugin.
    Installing Twenty Sixteen (1.3)
    Theme updated successfully.
    Success: Installed 1 of 1 themes.
    Success: Reinstall complete.

## Installing

Installing this package requires WP-CLI v1.1.0 or greater. Update to the latest stable release with `wp cli update`.

Once you've done so, you can install this package with:

    wp package install git@github.com:danielbachhuber/reinstall-command.git

## Contributing

We appreciate you taking the initiative to contribute to this project.

Contributing isn’t limited to just code. We encourage you to contribute in the way that best fits your abilities, by writing tutorials, giving a demo at your local meetup, helping other users with their support questions, or revising our documentation.

For a more thorough introduction, [check out WP-CLI's guide to contributing](https://make.wordpress.org/cli/handbook/contributing/). This package follows those policy and guidelines.

### Reporting a bug

Think you’ve found a bug? We’d love for you to help us get it fixed.

Before you create a new issue, you should [search existing issues](https://github.com/danielbachhuber/reinstall-command/issues?q=label%3Abug%20) to see if there’s an existing resolution to it, or if it’s already been fixed in a newer version.

Once you’ve done a bit of searching and discovered there isn’t an open or fixed issue for your bug, please [create a new issue](https://github.com/danielbachhuber/reinstall-command/issues/new). Include as much detail as you can, and clear steps to reproduce if possible. For more guidance, [review our bug report documentation](https://make.wordpress.org/cli/handbook/bug-reports/).

### Creating a pull request

Want to contribute a new feature? Please first [open a new issue](https://github.com/danielbachhuber/reinstall-command/issues/new) to discuss whether the feature is a good fit for the project.

Once you've decided to commit the time to seeing your pull request through, [please follow our guidelines for creating a pull request](https://make.wordpress.org/cli/handbook/pull-requests/) to make sure it's a pleasant experience. See "[Setting up](https://make.wordpress.org/cli/handbook/pull-requests/#setting-up)" for details specific to working on this package locally.

## Support

Github issues aren't for general support questions, but there are other venues you can try: https://wp-cli.org/#support


*This README.md is generated dynamically from the project's codebase using `wp scaffold package-readme` ([doc](https://github.com/wp-cli/scaffold-package-command#wp-scaffold-package-readme)). To suggest changes, please submit a pull request against the corresponding part of the codebase.*
