.PHONY: composer cs it test

it: cs test

composer:
	composer install --prefer-dist

test: composer
	vendor/bin/phpunit