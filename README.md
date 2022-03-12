## About Cloudflare Bulk Always Online Update


**Step 1**: clone the project with git

```sh
$ git clone https://github.com/dutsik/CloudflareBulkAlwaysOnlineUpdate.git
```

**Step 2**: go into the `CloudflareBulkAlwaysOnlineUpdate` folder and run composer
```sh
$ cd CloudflareBulkAlwaysOnlineUpdate
$ composer install
```

**Step 3**: update the creds.php and run the script

```php
$ php script.php
```

### Alternatively run it with docker

```sh
$ docker run --rm -it   --volume $PWD:/app   composer install
```
```sh
$ docker run -ti --init --rm -v $(pwd):/app/ php:8.1-cli php /app/script.php
```