<?php
//use Illuminate\Foundation\Testing\TestCase;

class AssetURLHelperTest extends Illuminate\Foundation\Testing\TestCase {

    public function createApplication() {
        $app = new Illuminate\Foundation\Application(
            realpath(__DIR__.'/../')
        );
        $app->singleton(
            'Illuminate\Contracts\Http\Kernel',
            'App\Http\Kernel'
        );
        $app->singleton(
            'Illuminate\Contracts\Console\Kernel',
            'App\Console\Kernel'
        );
        $app->singleton(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            'App\Exceptions\Handler'
        );
        return $app;
    }

    public function testAssetURL()
    {
        $app = $this->createApplication();

        // This file shouldn't exist.
        $str = asset_url("/fake/file.css");
        $this->assertEquals("/fake/file.css",$str);

        // This one should.
        $str = asset_url("/assets/css/styles.css");
        $this->assertEquals("/assets/css/styles.css?testHashString",$str);

        // This file should exist, lets add another param to the query string.
        $str = asset_url("/assets/css/styles.css",array("foo"=>"bar"));
        $this->assertEquals("/assets/css/styles.css?testHashString&foo=bar",$str);

    }
}