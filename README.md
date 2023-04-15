#Consignes

Pour une opération immobilière en VEFA, nous souhaitons réaliser une commande de mise à jour des status des logements stockés en base de données.
Les données à jour seront obtenues quotidiennement à partir d'un **flux distant** mis à disposition par le promoteur.

Les logements sont modélisés par la classe Domain\Lot et identifiés dans le flux par leur clé "key".

Le flux fonctionne de manière basique :
- si un lot est présent dans le flux : il est disponible
- si un lot est absent du flux : il est indisponible

Si un lot est présent dans le flux, mais pas en base de données, il conviendra de le rajouter à la base.

Afin d'effectuer cette mise à jour, compléter les méthodes suivantes :
- UI\CusthomeUpdateLotsCommand::execute
- Domain\LotRepository::getLotByKey
- Domain\LotRepository::registerLot

Pour lancer la commande :
```console
$ php index.php custhome:update:lots data/update.json
```

## Setup
#
[Installer les dépendances avec composer](https://getcomposer.org/)
```console
$ composer install
```