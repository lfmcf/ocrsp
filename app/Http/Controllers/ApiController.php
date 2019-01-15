<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use File;
class ApiController extends Controller
{
    public function index()
    {
    	$files = Storage::files("public");
    	$filename=storage_path("app/public/maxresdefault.jpg");
    	
    	$fileData = fopen($filename, 'r');
    	
    	// $data = array(
    	// 	"language" => "ara",
    	// 	"isOverlayRequired" => "false",
    	// 	"detectOrientation" => "true",
    	// 	"scale" => "true",
    	// 	"filetype" => "pdf",
    	// 	"url" => "https://www.docdroid.net/Dc3HzIo/180307-akhbar-al-yaoum-1-1d0e6.pdf",
    	// );
    	// $ch = curl_init();

    	// curl_setopt_array($ch, array(
    	// 	CURLOPT_URL => "https://api.ocr.space/parse/image",
    	// 	CURLOPT_RETURNTRANSFER => true,
    	// 	CURLOPT_POST => 1,
    	// 	CURLOPT_HTTPHEADER => array('Content-Type:multipart/form-data', 'apikey:apikey:6219a078ca88957'),
    	// 	CURLOPT_POSTFIELDS => $data,
    	// ));
    	// $result = curl_exec($ch);
    	// curl_close($ch);
    	// $result_array = json_decode($result);
    	// dd($result_array);
    	// $ocrresult = $result_array->ParsedResults[0]->ParsedText;
    	// dd($ocrresult);

    	$client = new Client();
    	$res = $client->post('https://api.ocr.space/parse/image', [
    		'headers' => ['apiKey' => '6219a078ca88957'],
    		'multipart' => [
    			[
    				'name' => 'file',
    				'contents' => $fileData,
    			]
    		],

    	],['file' => $fileData]);

    	$response =  json_decode($res->getBody(),true);
    	dd($response);
    }
}
