.PHONY        :

SYMFONY       = symfony
CONSOLE       = $(SYMFONY) console
BIN     	  = ./vendor/bin
PHPUNIT       = $(BIN)/simple-phpunit
RECTOR        = $(BIN)/rector
PHPSTAN       = $(BIN)/phpstan
PHP_CS_FIXER  = $(BIN)/php-cs-fixer

cs: rector stan fixer

stan:
	@$(PHPSTAN) analyse

rector:
	@$(RECTOR) process --clear-cache

test:
	@$(PHPUNIT) tests

test-cov:
	@$(PHPUNIT) --coverage-html ./coverage tests

fixer:
	@$(PHP_CS_FIXER) fix src --allow-risky=yes --using-cache=no
	@$(PHP_CS_FIXER) fix tests --allow-risky=yes --using-cache=no

deploy:
	@$(CONSOLE) deploy preprod

dep: deploy

deploy-prod:
	@$(CONSOLE) deploy prod
