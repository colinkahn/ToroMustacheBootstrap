<?php

class NavLists extends MustacheBase
{
    public $sections = array();
    
    public function __construct()
    {
        $fixtures = Fixtures::getInstance();
        parent::__construct($template = "{{> navlists }}", null, $partials = $fixtures->partials, null);
    }
    
    public function addSection($list_header=null, $list_items=array(), $divider=false)
    {
        $this->sections[] = array('list_header'=>$list_header, 'list_items'=>$list_items, 'divider'=>$divider);
    }
    
    public function addListHeader($name) 
    {
        $c = $this->lastSection();
        $this->sections[$c]['list_header'] = $name;
    }
    
    public function addListItem($name, $url=null, $icon=null)
    {
        $c = $this->lastSection();
        
        if ($icon)
            $icon = 'icon-'.$icon;
            
        $this->sections[$c]['list_items'][] = array('name'=>$name, 'url'=>$url, 'icon'=>$icon, 'active'=>false);
    }
    
    public function addDivider()
    {
        $this->addSection(null, array(), true);
    }

    public function makeActive($name)
    {
        foreach($this->sections as &$section)
        {
            foreach($section['list_items'] as &$item)
            {
                if ($item['name'] == $name) 
                {
                    $item['active'] = true;
                } 
                else
                {
                    $item['active'] = false;
                } 
            }
        }
    
    }

    private function lastSection()
    {
        return count($this->sections) - 1;
    }
    
    public function __toString()
    {
        return $this->render();
    }

}