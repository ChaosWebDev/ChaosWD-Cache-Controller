<?php

namespace Order\Controller;

class CacheController
{
    public $dir = __DIR__ . "/../cache";
    public $file;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
        $this->checkLogExists($this->dir);
    }

    private function checkLogExists($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return;
    }

    private function encodeKey($key)
    {
        $encodedKey = md5($key);
        $this->file = $this->dir . "/" . $encodedKey . ".tmp";
        return;
    }

    public function load($key)
    {
        $this->encodeKey($key);
        if (file_exists($this->file)) {
            $contents = unserialize(file_get_contents($this->file));

            $exp = $contents['expiration'];
            $content = base64_decode($contents['content']);

            if ($exp <= strtotime("now")) {
                return ["false"];
            } else {
                return ["true", $content];
            }
        } else {
            return ["false"];
        }
    }

    public function save(string $key, $content, int $expiration = 300)
    {
        $this->encodeKey($key);
        $expiration = time() + $expiration;

        if (!file_exists($this->file)) {
            fclose(fopen($this->file, "w+"));
        }

        $array = array("expiration" => $expiration, "content" => base64_encode($content));
        $savingData = serialize($array);
        file_put_contents($this->file, $savingData);
        return;
    }
}
