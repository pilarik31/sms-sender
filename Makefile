.PHONY: stan cs cbf decache doc help

default: install

help: ## Help
	@grep -E '^[a-zA-Z_-]+:.*?##.*$$' $(MAKEFILE_LIST) | sort | awk '{split($$0, a, ":"); printf "\033[36m%-30s\033[0m %-30s %s\n", a[1], a[2], a[3]}'

stan: ## Runs phpstan.
	php vendor/bin/phpstan analyse --memory-limit=-1

cs: ## Runs phpcs.
	php vendor/bin/phpcs inc

cbf: ## Runs phpcbf.
	php vendor/bin/phpcbf inc

composer-install:
	composer install -d 

install: composer-install ## Installs project.