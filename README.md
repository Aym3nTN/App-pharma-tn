#Application pour un labo pharmaceutique
##How to setup
First, you need to install all the dependencies using composer:

```sh
$ php composer.phar install
```

Then, you need to create the databae and update its schema:

(Don't forget to update your `app/config/parameters.yml`)

```sh
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
```

And finally, you need to run the fixtures:

```sh
$ php app/console doctrine:fixtures:load
```
