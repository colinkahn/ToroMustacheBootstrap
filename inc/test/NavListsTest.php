<?php

/* Structure
    public $subnav = array(
        'sections' => array(
            array(
                'list_header'=>'List Header',
                'list_items'=> array(
                    array( 'name'=>'<i class="icon-white icon-home"></i> Home', 'url'=>'#', 'active'=>true ),
                    array( 'name'=>'<i class="icon-book"></i> Library', 'url'=>'#' ),
                    array( 'name'=>'<i class="icon-pencil"></i> Applications', 'url'=>'#' ),
                )
            ),
            array(
                'list_header'=>'Another list header',
                'list_items'=>array(
                    array( 'name'=>'<i class="icon-user"></i> Profile', 'url'=>'#' ),
                    array( 'name'=>'<i class="icon-cog"></i> Settings', 'url'=>'#' )
                )
            ),
            array (
                'divider'=>true
            ),
            array(
                'list_items'=>array(
                    array( 'name'=>'<i class="icon-flag"></i> Help', 'url'=>'#' )
                )
            )
        )
    );
*/

require_once(dirname(__FILE__) . '/deps.php');
require_once(dirname(__FILE__) . '/../NavLists.class.php');

use tbcomponents\NavLists;

class NavListsTest extends PHPUnit_Framework_TestCase
{
    public function testAddingASection()
    {
        $subnav = new NavLists();
        $subnav->addSection();
        
        $a = (array)$subnav;
        $this->assertEquals(1, count($a['sections']));
    }
    
    public function testAddingAFewLinksToASection()
    {
        $subnav = new NavLists();
        $subnav->addSection();
        $subnav->addListHeader('List Header');
        $subnav->addListItem('Home', '/', 'home');
        $subnav->addListItem('Library', 'library', 'book');
        
        $a = (array)$subnav;
        $this->assertEquals(1, count($a['sections']));
        $this->assertEquals('List Header', $a['sections'][0]['list_header']);
        $this->assertEquals(2, count($a['sections'][0]['list_items'])); 
        
        $this->assertArrayHasKey('name', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('url', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('icon', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('active', $a['sections'][0]['list_items'][0]);
        
        $this->assertEquals('Home', $a['sections'][0]['list_items'][0]['name']);
        $this->assertEquals('/', $a['sections'][0]['list_items'][0]['url']);
        // Auto adds 'icon-'
        $this->assertEquals('icon-home', $a['sections'][0]['list_items'][0]['icon']);
        $this->assertEquals(false, $a['sections'][0]['list_items'][0]['active']);
    }
    
    public function testMakingAnItemActive()
    {
        $subnav = new NavLists();
        $subnav->addSection();
        $subnav->addListHeader('List Header');
        $subnav->addListItem('Home', '/', 'home');
        $subnav->addListItem('Library', 'library', 'book');
        $subnav->makeActive('Home');
        
        $a = (array)$subnav;
        $this->assertEquals(true, $a['sections'][0]['list_items'][0]['active']);
        
        $subnav->makeActive('Library');
        $a = (array)$subnav;
        $this->assertEquals(false, $a['sections'][0]['list_items'][0]['active']);
        $this->assertEquals(true, $a['sections'][0]['list_items'][1]['active']);
    
    }
    
    public function testAddingTwoSectionsWithItems() 
    {
        $subnav = new NavLists();
        $subnav->addSection();
        $subnav->addListHeader('List Header');
        $subnav->addListItem('Home', '/', 'home');
        $subnav->addListItem('Library', 'library', 'book');
        
        $subnav->addSection();
        $subnav->addListHeader('Another list header');
        $subnav->addListItem('Profile', 'profile', 'user');
        $subnav->addListItem('Settings', 'settings', 'cog');
        
        $subnav->makeActive('Profile');
        
        $a = (array)$subnav;
        $this->assertEquals(2, count($a['sections']));
        $this->assertEquals(true, $a['sections'][1]['list_items'][0]['active']);
            
    }
    
    public function testAddingADivider() 
    {
        $subnav = new NavLists();
        $subnav->addSection();
        $subnav->addListHeader('List Header');
        $subnav->addListItem('Home', '/', 'home');
        $subnav->addListItem('Library', 'library', 'book');
        
        $subnav->addDivider();
        
        $subnav->addSection();
        $subnav->addListHeader('Another list header');
        $subnav->addListItem('Profile', 'profile', 'user');
        $subnav->addListItem('Settings', 'settings', 'cog');
        
        $subnav->makeActive('Home');
        
        $a = (array)$subnav;
        $this->assertEquals(3, count($a['sections']));
        $this->assertEquals(true, $a['sections'][1]['divider']);
    }  
    
    public function testShorterSyntax()
    {
        $subnav = new NavLists();
        $subnav
            ->addSection()
                ->addListHeader('List Header')
                ->addListItem('Home', '/', 'home')
                ->addListItem('Library', 'library', 'book')
            ->addDivider()
            ->addSection()
                ->addListHeader('Another list header')
                ->addListItem('Profile', 'profile', 'user')
                ->addListItem('Settings', 'settings', 'cog') 
            ->makeActive('Profile');     
        
        $a = (array)$subnav;
        $this->assertEquals(3, count($a['sections']));
        $this->assertEquals('List Header', $a['sections'][0]['list_header']);
        $this->assertEquals(2, count($a['sections'][0]['list_items'])); 
        
        $this->assertArrayHasKey('name', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('url', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('icon', $a['sections'][0]['list_items'][0]);
        $this->assertArrayHasKey('active', $a['sections'][0]['list_items'][0]);
        
        $this->assertEquals('Home', $a['sections'][0]['list_items'][0]['name']);
        $this->assertEquals('/', $a['sections'][0]['list_items'][0]['url']);
        // Auto adds 'icon-'
        $this->assertEquals('icon-home', $a['sections'][0]['list_items'][0]['icon']);
        $this->assertEquals(false, $a['sections'][0]['list_items'][0]['active']);    
        $this->assertEquals(true, $a['sections'][2]['list_items'][0]['active']);
        
        $this->assertEquals(true, $a['sections'][1]['divider']);
    
    } 
}