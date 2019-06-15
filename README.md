# tracker

## Test Code
```
namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Tracker\Web\TrackerController;

require_once 'vendor/autoload.php';


class Index extends TrackerController
{

}


$http = new \swoole_http_server("0.0.0.0", 9501);
$http->set([
    'worker_num'=>1
]);

$service = new \EasySwoole\Http\WebService();

$http->on("request", function ($request, $response)use($service) {
    $req = new \EasySwoole\Http\Request($request);
    $service->onRequest($req,new \EasySwoole\Http\Response($response));
});

$http->start();

```