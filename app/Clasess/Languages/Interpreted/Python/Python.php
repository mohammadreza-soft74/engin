<?php
/**
 * Created by PhpStorm.
 * User: mohammadreza
 * Date: 11/24/18
 * Time: 11:08 AM
 */

namespace App\Clasess\Languages\Interpreted\Python;


use App\Clasess\Base\Update\Update;
use App\Clasess\Languages\Interpreted\Python\MainActions\CodeManage\CodeManage;
use App\Clasess\Languages\Interpreted\Python\MainActions\Create\Create;
use App\Clasess\Languages\Interpreted\Python\MainActions\PageLoad\PageLoad;
use App\Clasess\Languages\Interpreted\Python\MainActions\Run\Run;

class Python
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