<?php

namespace tbcomponents;
use Settings;

class Components {

    public static function subnav() 
    {
        $subnav = new NavLists();
        $subnav
            ->addSection()
                ->addListHeader('List Header')
                ->addListItem('Home', Settings::HOME, 'home')
                ->addListItem('Library', 'library', 'book')
            ->addSection()
                ->addListHeader('Another list header')
                ->addListItem('Profile', 'profile', 'user')
                ->addListItem('Settings', 'settings', 'cog')       
            ->addDivider()
            ->addSection()
                ->addListItem('Help', 'help', 'flag');
        
        return $subnav;
    }
    
    public static function navigation()
    {    
        $navigation = new Navbar();
        $navigation
            ->addBrandname('Toro!')
            ->addNavList()
                ->addListItem('Home', Settings::HOME)
                ->addListItem('Test Something', 'test/something')
                ->addListItem('Test Nothing', 'test/nothing')
                ->addListItem('Form', 'form')
                ->addListItem('WYSIWYG', 'wysiwyg')
                ->addListItem('Gallery', 'gallery')
                ->addListItem('Sign Up', 'signup')
            ->addNavForm(Navbar::SEARCH, 'search', Navbar::PULL_RIGHT);
    
        return $navigation;   
    }
    
    public static function breadcrumbs()
    {
        $bc = new Breadcrumbs();
        $bc->add('Home',Settings::HOME);
        
        return $bc;
    }

}