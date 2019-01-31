<?php

namespace tkachev\images;

class Images
{
    private $extensions = ['jpg', 'png', 'gif', 'jpeg'];
    private $dir = './images';

    /**
     * @param string $url
     * @param string|null $dir
     * @return bool
     */
    public function uploadImage(string $url, string $dir = null) : bool
    {
        $ext = $this->checkUrlOfImage($url);

        $dir = $dir ?? $this->dir;
        $fileName = pathinfo($url, PATHINFO_FILENAME);

        $path = $dir.'/'.$fileName.'.'.$ext;

        if (!file_exists($dir)){
            if (!mkdir($dir, 0777)) {
                echo 'Could not create directory...';
                die;
            }
        }

        $res = file_put_contents($path, file_get_contents($url));

        if ($res){
            return true;
        } else {
            echo 'Failed to save file';
            die;
        }
    }

    /**
     * @param string $url
     * @return string
     */
    private function checkUrlOfImage(string $url) : string
    {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($ch);
        $header = curl_getinfo( $ch );
        if ($header["http_code"] != 200){
            curl_close($ch);
            echo 'http_code = '.$header["http_code"];
            die;
        }
        $mimeType = explode('/', curl_getinfo($ch, CURLINFO_CONTENT_TYPE));
        curl_close($ch);

        if (isset($mimeType[1]) && !in_array($mimeType[1], $this->extensions)){
            echo 'File must have the next extensions : '.implode(',', $this->extensions);
            die;
        }

        return pathinfo($url, PATHINFO_EXTENSION);
    }
}

//$url = 'https://city.com.ua/redmond rmc-m92s1.jpg';
//$url = 'https://kor.ill.in.ua/m/610x386/2271658.jpg';
//
//
//$a = new Images();
//$a->uploadImage($url);