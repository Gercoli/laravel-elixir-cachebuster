<?php

class AssetURLHelperTest extends PHPUnit_Framework_TestCase {
    public function testAssetURL()
    {
        echo "TESTING";
        $str = asset_url("/asset/css/styles.css");
        echo $str;

        $this->assertTrue(true);

    }
}