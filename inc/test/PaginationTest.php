<?php

require_once(dirname(__FILE__) . '/../Pagination.class.php');

class PaginationTest extends PHPUnit_Framework_TestCase
{

    public function testSettingPages()
    {
        $pg = new Pagination();
        $pg->set(3);

        $a = (array)$pg;
        //$this->assertArrayHasKey('name',  $sa);
        //$this->assertEquals(true, $sa['active']);
    }
    
    public function testSettingActive()
    {
        $pg = new Pagination();
        $pg->set(3);
        $pg->active(2);
    
        $a = (array)$pg;
        //$this->assertArrayHasKey('name',  $sa);
        //$this->assertEquals(true, $sa['active']);    
    }
    
}
?>