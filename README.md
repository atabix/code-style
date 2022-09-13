# Atabix Code Style
A repository containing configuration files for code style and linters.

## Instalation
Run the following to install PHP-CS-Fixer
```bash
# PHP CS Fixer
mkdir -p $(brew --prefix)/lib/php-cs-fixer
composer require --working-dir=$(brew --prefix)/lib/php-cs-fixer friendsofphp/php-cs-fixer
ln -s $(brew --prefix)/lib/php-cs-fixer/vendor/bin/php-cs-fixer $(brew --prefix)/bin/php-cs-fixer
curl https://raw.githubusercontent.com/atabix/code-style/main/php-cs-fixer.dist.php > ~/Development/.php-cs-fixer.dist.php
```
