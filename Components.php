<?php

namespace tbcomponents;

class Components {

    public static function subnav() 
    {
        $subnav = new NavLists();
        $subnav->addSection();
        $subnav->addListHeader('List Header');
        $subnav->addListItem('Home', ' ', 'home');
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
    
        return array(
            array('name'=>'Home', 'url'=>''),
            array('name'=>'Test Something', 'url'=>'test/something'),
            array('name'=>'Test Nothing', 'url'=>'test/nothing'),
            array('name'=>'Form', 'url'=>'form'),
            array('name'=>'WYSIWYG', 'url'=>'wysiwyg'),
            array('name'=>'Gallery', 'url'=>'gallery'),
        );    
    
    }
    
    public static function breadcrumbs()
    {
        $bc = new Breadcrumbs();
        $bc->add('Home',' ');
        return $bc;
    }

}