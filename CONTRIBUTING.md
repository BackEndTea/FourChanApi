# Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/BackEndTea/FourChanApi).

## Pull Requests

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to run `make cs`, which will apply all code-style fixes necessary.

- **Add tests!** - Your patch probably won't be accepted if it doesn't have tests. Any new tests must be placed in the `tests/` directory and properly namespaced at `FourChan\Test`. 

- **Mock the API calls in tests** - Your patch won't be accepted if the tests do actual api calls, make sure you mock these out properly.

- **Tests must be clear in meaning** - We value clarity in meaning / purposes behind tests. If there is excessive setup required for a test, it should be hidden behind an intention-revealing (and possibly re-usable) method.

- **Be compatible with php 5.6** - For the last few months that php 5.6 is under security support this package will support PHP 5.6. After that its 7.0 or higher.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Create feature branches** - Feature branches are critically important if you're going to be sending us more than one contribution. Don't send a PR from `master`!

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests. Large pull requests are difficult to review and manage.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. [Appropriate formatting of commit messages](http://chris.beams.io/posts/git-commit/) is also appreciated!

- **Don't close issues via commit message** - We would rather handle these actions ourselves, especially for longer-running issues that may have many PRs submitting against them.

## Running Tests

Run

```
$ make test
```

to run all the tests.

## Credit

This [CONTRIBUTING.md](CONTRIBUTING.md) format was graciously lifted from The PHP League's [example](https://github.com/thephpleague/skeleton/blob/master/CONTRIBUTING.md). Thanks!

**Happy coding**!