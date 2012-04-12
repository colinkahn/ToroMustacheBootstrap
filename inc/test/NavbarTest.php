<?php

require_once(dirname(__FILE__) . '/../Navbar.class.php');

class NavbarTest extends PHPUnit_Framework_TestCase
{
    public function testAddingBreadcrumb()
    {

        $navbar = new Navbar();
        $navbar->addBrandname('Toro Micro Framwork', ' ');
        
        $navbar->addNavLinks(/* Navbar::PULL_LEFT */);
        $navbar->addListItem('Home', ' ');
        
        $navbar->addNavForm(Navbar::SEARCH, 'form/action');
        $navbar->addNavText('Some Text', Navbar::PULL_RIGHT);
        
            
        $a = (array)$navbar;
        $this->assertArrayHasKey('name',  $sa);
        $this->assertEquals(true, $sa['active']);
    }

    
}
?>