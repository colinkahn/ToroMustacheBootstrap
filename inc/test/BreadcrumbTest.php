<?php

require_once(dirname(__FILE__) . '/deps.php');
require_once(dirname(__FILE__) . '/../Breadcrumbs.class.php');

use tbcomponents\Breadcrumbs;

class BreadcrumbTest extends PHPUnit_Framework_TestCase
{
    public function testAddingBreadcrumb()
    {
        // Add a single item to the class and return the array
        $bc = new Breadcrumbs();
        $bc->add('Home', '/');
        
        /* should return:
        'list_items'=>array(
            array('name'=>'Home', 'url'=>'/', 'divider'=>false),
        )
        */
        
        $a = (array)$bc;
        $this->assertArrayHasKey('list_items', $a);
        $this->assertEquals(1, count($a['list_items']));
        $sa = $a['list_items'][0];
        $this->assertArrayHasKey('name',  $sa);
        $this->assertArrayHasKey('url',  $sa);
        $this->assertArrayHasKey('divider',  $sa);
        $this->assertArrayHasKey('active',  $sa);
        $this->assertEquals('Home', $sa['name']);
        $this->assertEquals('/', $sa['url']);
        $this->assertEquals(false, $sa['divider']);
        $this->assertEquals(true, $sa['active']);
    }

    public function testAddingAnotherBreadcrumbAddsDivider()
    {
       $bc = new Breadcrumbs();
       $bc->add('Home', '/');
       
       $bc->add('Gallery', 'gallery');
       $a = (array)$bc;
       $sa = $a['list_items'][0];
       $this->assertEquals('Home', $sa['name']);
       $this->assertEquals(true, $sa['divider']);
       $this->assertEquals(false, $sa['active']);
    
       $sa = $a['list_items'][1];
       $this->assertEquals('Gallery', $sa['name']);
       $this->assertEquals(false, $sa['divider']);
       $this->assertEquals(true, $sa['active']);       
    }
    
    public function testShorterSyntax()
    {
       $bc = new Breadcrumbs();
       $bc
            ->add('Home', '/')
            ->add('Gallery', 'gallery');
            
       $a = (array)$bc;
       $sa = $a['list_items'][0];
       $this->assertEquals('Home', $sa['name']);
       $this->assertEquals(true, $sa['divider']);
       $this->assertEquals(false, $sa['active']);
    
       $sa = $a['list_items'][1];
       $this->assertEquals('Gallery', $sa['name']);
       $this->assertEquals(false, $sa['divider']);
       $this->assertEquals(true, $sa['active']);        
    
    }
    
}
?>