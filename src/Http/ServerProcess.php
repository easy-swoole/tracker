<?php


namespace EasySwoole\Tracker\Http;


use Co\Http\Server;
use EasySwoole\Component\Process\AbstractProcess;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Http\WebService;

class ServerProcess extends AbstractProcess
{

    protected function run($arg)
    {
        /** @var ServerConfig $config */
        $config = $this->getConfig()->getArg();
        go(function ()use($config) {
            $server = new Server($config->getListenAddress(), $config->getPort(), false);
            $webService = new WebService($config->getControllerNamaSpace());
            $server->handle('/', function ($request, $response)use($webService){
                $request = new Request($request);
                $response = new Response($response);
                $webService->onRequest($request,$response);
            });
            $server->start();
        });
    }
}