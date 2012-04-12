<?php

require_once(dirname(__FILE__) . '/../Tabbable.class.php');

class TabbableTest extends PHPUnit_Framework_TestCase
{

    public function testSettingPages()
    {
        $tabs = new Tabbable();
        $tabs->add('Tab1');
        $tabs->setTemplate("{{> tab1 }}");

        $a = (array)$pg;
        //$this->assertArrayHasKey('name',  $sa);
        //$this->assertEquals(true, $sa['active']);
    }
    

    
}
?>