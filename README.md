Laravel horizon plugin for OctoberCMS
=
Provide [Laravel Horizon](https://horizon.laravel.com/) inside your OctoberCMS application.

> Minimal requirement : OctoberCMS 420, PHP 7.1

## Setup
> Requirement : Redis queue

1. Install this plugin
2. Edit the config file `config/horizon.php` - [see here](https://divinglaravel.com/horizon/before-the-dive)
3. run `php artisan horizon`

For the production this command need to be supervised by a tool like supervisord, that take care of restarting process when fails.

[More information about running Horizon](https://laravel.com/docs/master/horizon#running-horizon)
## Graphs
Horizon provides a queue usage graph, if you want use them you need to have the [October CMS scheduler cron](http://octobercms.com/docs/setup/installation#crontab-setup)  correctly configured.