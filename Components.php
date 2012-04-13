<?php

namespace tbcomponents;
use Settings;

class Components {

    public static function subnav() 
    {
        $subnav = new NavLists();
        $subnav->addSection();
        $subnav->addListHeader('List Header');
        $subnav->addListItem('Home', Settings::HOME, 'home');
        $subnav->addListItem('Library', 'library', 'book');
            
        $subnav->addSection();
        $subnav->addListHeader('Another list header');
        $subnav->addListItem('Profile', 'profile', 'user');
        $subnav->addListItem('Settings', 'settings', 'cog');
        
        $subnav->addDivider();
        
        $subnav->addSection();
        $subnav->addListItem('Help', 'help', 'flag');
        
        return $subnav;
    }
    
    public static function navigation()
    {
    
        $nav = new Navbar();
        
        $nav->addBrandname('Toro!');
        
        $nav->addNavList();
        $nav->addListItem('Home', Settings::HOME);
        $nav->addListItem('Test Something', 'test/something');
        $nav->addListItem('Test Nothing', 'test/nothing');
        $nav->addListItem('Form', 'form');
        $nav->addListItem('WYSIWYG', 'wysiwyg');
        $nav->addListItem('Gallery', 'gallery');
        $nav->addListItem('Sign Up', 'signup');
        
        $nav->addNavForm(Navbar::SEARCH, 'search', Navbar::PULL_RIGHT);
    
        return $nav;   
    
    }
    
    public static function breadcrumbs()
    {
        $bc = new Breadcrumbs();
        $bc->add('Home',Settings::HOME);
        return $bc;
    }

}