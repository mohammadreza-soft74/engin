<?php
/**
 * Created by PhpStorm.
 * User: mohammadreza
 * Date: 11/26/18
 * Time: 11:29 AM
 */

namespace App\Clasess\Languages\WebBased\Javascript;


use App\Clasess\Languages\WebBased\Javascript\MainActions\CodeManage\CodeManage;
use App\Clasess\Languages\WebBased\Javascript\MainActions\Create\Create;
use App\Clasess\Languages\WebBased\Javascript\MainActions\PageLoad\PageLoad;
use App\Clasess\Languages\WebBased\Javascript\MainActions\Run\Run;

class Javascript
{
    /**
     * @param $request
     * @return array
     * @throws \Exception
     */
    public function create($request)
    {
        $create = new Create();
        $result = $create->createContainer($request);

        return $result;
    }

    /**
     * @param $request
     * @return bool|mixed
     * @throws \Exception
     */
    public function pageLoad($request)
    {
        $pageLoad = new PageLoad();
        $result = $pageLoad->PageLoad($request);

        return $result;
    }

    /**
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function run($request)
    {
        $run = new Run();
        $result = $run->run($request);

        return $result;
    }

    /**
     * @param $request
     * @return array|false|null|string
     * @throws \Exception
     */
    public function resetCode($request)
    {
        $reset = new CodeManage();
        $result =  $reset->resetCode($request['path'], $request['key']);

        return $result;
    }

    /**
     * @param $request
     * @return array
     * @throws \Exception
     */
    public function finalCode($request)
    {
        $final = new CodeManage();
        $result = $final->finalCode($request['path'], $request['key']);

        return $result;
    }

}