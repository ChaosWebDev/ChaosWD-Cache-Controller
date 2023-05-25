Install:
````
composer require chaoswd/cache_controller
````

Instantiate:
````
require(__DIR__ . '/../vendor/autoload.php');
use Order\Controller\CacheController;
$cache = new CacheController("/path/to/cache/directory");
````
The path to chache directory needs to be where you want your cache files to be kept. Do not include the '/' at the end.
<br><br>
Here's how it works.<br>
1) When you want to see if <em>something</em> is cached, use:
````
$loadedCache = $cache->load("index");
````
In this case "index" is the key the data was saved under.<br>
<br>
If the cache is found, and not expired, $loadedCache will return as:<br>
[0] = (string) true;<br>
[1] = (string) content
<br><br>
If the cache is not found, or the cache is stale, $loadedCache will return as:<br>
<br>
[0] (string) false;
<br><br>
2) To save data to the cache:<br>
````
$cache->save("index", $content, 20);
````
"index" is the key to save it under, as shown in `load`, it's how you'll retrieve it.<br>
$content is whatever it is you want to save.<br>
20 is the amount of seconds before it expires. You can set this to whatever you want. The default, if left null, is 300 seconds (5 minutes).