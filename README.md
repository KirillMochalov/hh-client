##Установка  
В файле composer.json добавить репозиторий и имя пакета:
```
"repositories": [
    ...
    {
        "type": "vcs",
        "url": "https://github.com/KirillMochalov/hh-client"
    }
],
"require": {
    ...
    "simple-hh-client/client": "dev-master"
}
```
Выполнить команду:  
```
composer install
```
