<?php

require_once(dirname(__FILE__) . '/deps.php');
require_once(dirname(__FILE__) . '/../Navbar.class.php');

use tbcomponents\Navbar;

/* Structure

array(
    brandname => "Toro!",
    
    sections => array(
        array(
            type=>array(navlist=>true),
            pull=>"pull-left",
            
            list_items=>array(
                array(name=>'Home',url=>'/',active=>false) 
            )
        ),   
        
        array(
            type=>array(text=>true),
            pull=>"pull-right",
            content=>"SOME CONTENT HERE"
        ),
        
        array(
            type=>array('search'=>true),
            pull=>"pull-left",
            action=>'/search/'
        
        )
    );
);

*/

class NavbarTest extends PHPUnit_Framework_TestCase
{
    public function testAddBrandname()
    {
        $navbar = new Navbar();
        $navbar->addBrandname('Toro Micro Framwork');
                
        $a = (array)$navbar;
        $this->assertArrayHasKey('brandname',  $a);
        $this->assertEquals('Toro Micro Framwork', $a['brandname']);
    }
    
    public function testAddLinks()
    {
        $navbar = new Navbar();
        
        $navbar->addNavList();
        $navbar->addListItem('Home', ' ');
        $navbar->addListItem('Gallery', 'gallery');

        $a = (array)$navbar;
        $this->assertEquals(1, count($a['sections']));
        
        $this->assertArrayHasKey('type', $a['sections'][0]);
        $this->assertArrayHasKey('navlist', $a['sections'][0]['type']);
        $this->assertEquals(true, $a['sections'][0]['type']['navlist']);
        
        $this->assertArrayHasKey('pull', $a['sections'][0]);
        $this->assertEquals('pull-left', $a['sections'][0]['pull']);
        
        $this->assertArrayHasKey('list_items', $a['sections'][0]);
        $this->assertEquals(2, count($a['sections'][0]['list_items']));
        
        $this->assertArrayHasKey('name', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('url', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('active', $a['sections'][0]['list_items'][0]);
        
        $this->assertEquals('Home', $a['sections'][0]['list_items'][0]['name']);
        $this->assertEquals(' ', $a['sections'][0]['list_items'][0]['url']);
        $this->assertEquals(false, $a['sections'][0]['list_items'][0]['active']);   
    
    }
    
    public function testMakeActive() 
    {
        $navbar = new Navbar();
        
        $navbar->addNavList();
        $navbar->addListItem('Home', ' ');
        $navbar->addListItem('Gallery', 'gallery');
        $navbar->makeActive('Home');
        
        $a = (array)$navbar;
        $this->assertEquals(true, $a['sections'][0]['list_items'][0]['active']);
        $this->assertEquals(false, $a['sections'][0]['list_items'][1]['active']);

        $navbar->makeActive('Gallery');
        $a = (array)$navbar;
        $this->assertEquals(true, $a['sections'][0]['list_items'][1]['active']);
        $this->assertEquals(false, $a['sections'][0]['list_items'][0]['active']);            
    }
    
    public function testAddSearch()
    {
        $navbar = new Navbar();        
        $navbar->addNavForm(Navbar::SEARCH, 'form/action');    
    
        $a = (array)$navbar;
        $this->assertEquals(1, count($a['sections']));

        $this->assertArrayHasKey('type', $a['sections'][0]);
        $this->assertArrayHasKey('search', $a['sections'][0]['type']);
        $this->assertEquals(true, $a['sections'][0]['type']['search']);
 
        $this->assertArrayHasKey('pull', $a['sections'][0]);
        $this->assertEquals('pull-left', $a['sections'][0]['pull']);
        
        $this->assertArrayHasKey('action', $a['sections'][0]);
        $this->assertEquals('form/action', $a['sections'][0]['action']);
    }
    
    public function testAddText()
    {
        $navbar = new Navbar();
        $navbar->addNavText('Some Text');
        
        $a = (array)$navbar;
        $this->assertEquals(1, count($a['sections']));            

        $this->assertArrayHasKey('type', $a['sections'][0]);
        $this->assertArrayHasKey('text', $a['sections'][0]['type']);
        $this->assertEquals(true, $a['sections'][0]['type']['text']);

        $this->assertArrayHasKey('pull', $a['sections'][0]);
        $this->assertEquals('pull-left', $a['sections'][0]['pull']);        
        
        $this->assertArrayHasKey('content', $a['sections'][0]);
        $this->assertEquals('Some Text', $a['sections'][0]['content']);  
    }
    
    public function testPullChanges()
    {

        $navbar = new Navbar();
        $navbar->addNavText('Some Text', Navbar::PULL_RIGHT);
        
        $navbar->addNavList(Navbar::PULL_RIGHT);
        $navbar->addListItem('Home', ' ');
        $navbar->addListItem('Gallery', 'gallery'); 
        
        $navbar->addNavForm(Navbar::SEARCH, 'form/action', Navbar::PULL_RIGHT); 
        
        $navbar->addNavText('Some Text', Navbar::PULL_LEFT);
        
        $a = (array)$navbar;
        $this->assertEquals(4, count($a['sections']));
        $this->assertEquals('pull-right', $a['sections'][0]['pull']);
        $this->assertEquals('pull-right', $a['sections'][1]['pull']);
        $this->assertEquals('pull-right', $a['sections'][2]['pull']);
        $this->assertEquals('pull-left', $a['sections'][3]['pull']);
    }
    
    public function testErrorOnNonLinkAddLink()
    {
        $this->setExpectedException('tbcomponents\InvalidListItemAssignmentException');        
        
        $navbar = new Navbar();
        $navbar->addNavText('Some Text');    
        $navbar->addListItem('Home', ' ');
    }
    
    public function testErrorOnInvalidPullType() 
    {
        $this->setExpectedException('tbcomponents\InvalidPullTypeException');
        $navbar = new Navbar();
        $navbar->addNavText('Some Text', 'foo');        
    }
    
    public function testShorterSyntax()
    {
        $navbar = new Navbar();
        
        $navbar
            ->addBrandname('Toro Micro Framwork')
            ->addNavList()
                ->addListItem('Home', ' ')
                ->addListItem('Gallery', 'gallery')     
            ->addNavForm(Navbar::SEARCH, 'form/action')
            ->addNavText('Some Text');  

        $a = (array)$navbar;

        $this->assertEquals(3, count($a['sections']));
        
        $this->assertArrayHasKey('brandname',  $a);
        $this->assertEquals('Toro Micro Framwork', $a['brandname']);        
        
        $this->assertArrayHasKey('type', $a['sections'][0]);
        $this->assertArrayHasKey('navlist', $a['sections'][0]['type']);
        $this->assertEquals(true, $a['sections'][0]['type']['navlist']);
        
        $this->assertArrayHasKey('pull', $a['sections'][0]);
        $this->assertEquals('pull-left', $a['sections'][0]['pull']);
        
        $this->assertArrayHasKey('list_items', $a['sections'][0]);
        $this->assertEquals(2, count($a['sections'][0]['list_items']));
        
        $this->assertArrayHasKey('name', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('url', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('active', $a['sections'][0]['list_items'][0]);
        
        $this->assertEquals('Home', $a['sections'][0]['list_items'][0]['name']);
        $this->assertEquals(' ', $a['sections'][0]['list_items'][0]['url']);
        $this->assertEquals(false, $a['sections'][0]['list_items'][0]['active']);   

        $this->assertArrayHasKey('type', $a['sections'][1]);
        $this->assertArrayHasKey('search', $a['sections'][1]['type']);
        $this->assertEquals(true, $a['sections'][1]['type']['search']);
 
        $this->assertArrayHasKey('pull', $a['sections'][1]);
        $this->assertEquals('pull-left', $a['sections'][1]['pull']);
        
        $this->assertArrayHasKey('action', $a['sections'][1]);
        $this->assertEquals('form/action', $a['sections'][1]['action']);           

        $this->assertArrayHasKey('type', $a['sections'][2]);
        $this->assertArrayHasKey('text', $a['sections'][2]['type']);
        $this->assertEquals(true, $a['sections'][2]['type']['text']);

        $this->assertArrayHasKey('pull', $a['sections'][2]);
        $this->assertEquals('pull-left', $a['sections'][2]['pull']);        
        
        $this->assertArrayHasKey('content', $a['sections'][2]);
        $this->assertEquals('Some Text', $a['sections'][2]['content']); 
    
    }

    
}
?>