# test-package
<h1>Install</h1>
via Composer: composer require tkachev/test-package

<h1>Usage</h1>
use Tkachev\Testing\Images;

$url = 'https://kor.ill.in.ua/m/610x386/2271510.jpg';<br>
$dir='{directory}' - optional. Default value './images';

$a = new Images();
$a->uploadImage($url, $dir);
