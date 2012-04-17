<?php

require_once(dirname(__FILE__) . '/deps.php');
require_once(dirname(__FILE__) . '/../Tabbable.class.php');

use tbcomponents\Tabbable;

/* Structure
    array(
        'type'=> '' | tabs-below | tabs-left | tabs-right;
        'tabs'=>
            array(
                array('name'=>'Tab Title', 'content'=><ComponentBase Instance>, 'anchor'=>'tab_title', 'active'=>true | false)
            )
        )
*/

class TabbableTest extends PHPUnit_Framework_TestCase
{

    public function testTabs()
    {
        $tabs = new Tabbable();
        $tabs->add('Tab1', 'My Tab1 Content');
        $tabs->add('Tab2', 'My Tab2 Content');
        $tabs->makeActive('Tab2');

        $a = (array)$tabs;
        
        $this->assertArrayHasKey('type',  $a);
        $this->assertArrayHasKey('tabs',  $a);
        
        $this->assertEquals(2, count($a['tabs']));
        
        $this->assertArrayHasKey('name',  $a['tabs'][0]);
        $this->assertArrayHasKey('content',  $a['tabs'][0]);
        $this->assertArrayHasKey('anchor',  $a['tabs'][0]);
        $this->assertArrayHasKey('active',  $a['tabs'][0]);
        
        $this->assertEquals('Tab1', $a['tabs'][0]['name']);
        $this->assertEquals('My Tab1 Content', (string)$a['tabs'][0]['content']);
        $this->assertEquals('tab1', $a['tabs'][0]['anchor']);
        $this->assertEquals(true, $a['tabs'][1]['active']);
    }
    
}
?>