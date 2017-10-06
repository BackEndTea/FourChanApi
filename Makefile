.PHONY: composer cs it test

it: cs test

composer:
	composer install --prefer-dist -o

cs: composer
	vendor/bin/php-cs-fixer fix --verbose --diff

test: composer
	vendor/bin/phpunit