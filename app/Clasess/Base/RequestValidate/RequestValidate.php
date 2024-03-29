<?php
/**
 * Created by PhpStorm.
 * User: mohammadreza
 * Date: 11/24/18
 * Time: 9:55 AM
 */

namespace App\Clasess\Base\RequestValidate;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Config;


class RequestValidate
{
    /**
     * @brief validate create Request.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function createValidator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string|regex:/^[1-2]+[-][0-9]+/'
        ]);

        if ($validator->fails())
            throw  new \Exception($validator->messages());


        return[
            'key'=>$request->key,
            'path'=>$request->path
        ];

    }

    /**
     * @brief validate pageLoad Request.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function pageloadValidator(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'path' => 'required|string|regex: /^\/[a-zA-Z0-9\-]+\/[a-zA-Z0-9\-]+$/',
            'key' => 'required|string|regex:/^[1-2]+[-][0-9]+/',
			'bash' => 'required|regex:/^[0-1]{0,1}$/',
        ]);

        if ($validator->fails())
            throw  new \Exception($validator->messages());


        return[

            'key'=>$request->key,
            'path'=>$request->path,
			'bash' => $request->bash,
        ];
    }

    /**
     * @brief validate run Request.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function runValidator(Request $request)
    {
        // Empty response object
        $ret = [];

        // Form Validations
        $validator = Validator::make($request->all(), [
            'path' => 'required|string|regex: /^\/[a-zA-Z0-9\-]+\/[a-zA-Z0-9\-]+$/',
            'files' => 'required|json',
            'key' => 'required|string|regex:/^[1-2]+[-][0-9]+/'
        ]);

        if ($validator->fails())
            throw  new \Exception($validator->messages());

        // Extra Validations
        $files_decoded = json_decode($request->get("files"));
        $maxFilesCount = Config::get('languages_config.max_files_count', 10);
        if (count($files_decoded) > $maxFilesCount)
            throw  new \Exception("Number of files is more than " . $maxFilesCount . ".");

        $maxFileSize = Config::get('languages_config.max_file_size', 1000);
        $files = [];
        foreach ($files_decoded as $value) {
            // TODO: regex should be more subtle! Also it should support '/' for creating files inside folders
            $validator = Validator::make((array)$value, [
                'name' => 'required|string|regex:/[a-zA-Z0-9_.\-]+/u|max:50',
                'content' => 'string|max:' . $maxFileSize
            ]);

            if ($validator->fails())
                throw  new \Exception($validator->messages());


            $files[] = [
                "name" => $value->name,
                "content" => $value->content
            ];
        }

        // {// Prepare object to be returned
        $ret["path"] = $request->path;
        $ret["key"] = $request->key;
        $ret["files"] = $files;

        return $ret;
    }

    /**
     * @brief validate reset and final Request.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function resetFinalValidator(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'path' => 'required|string|regex: /^\/[a-zA-Z0-9\-]+\/[a-zA-Z0-9\-]+$/',
            'key' => 'required|string|regex:/^[1-2]+[-][0-9]+/'
        ]);
        if ($validator->fails())
            throw  new \Exception($validator->messages());

        return[
            'key' => $request->key,
            'path' => $request->path,
        ];
    }

    /**
     * @brief validate update Request.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function updateRequestValidator(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'courseId' => 'required|string',
            'runnerTarFile' => 'required|string'
        ]);
        if ($validator->fails())
            throw  new \Exception($validator->messages());

        return[
            'courseId' => $request->courseId,
            'runnerTarFile' => $request->runnerTarFile,
        ];
    }

}