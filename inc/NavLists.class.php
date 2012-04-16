<?php

namespace tbcomponents;

class NavLists extends ComponentBase
{
    public $sections = array();
    public $template = "{{> navlists }}";
    
    public function addSection($list_header=null, $list_items=array(), $divider=false)
    {
        $this->sections[] = array('list_header'=>$list_header, 'list_items'=>$list_items, 'divider'=>$divider);
        return $this;
    }
    
    public function addListHeader($name) 
    {
        $c = $this->lastSection();
        $this->sections[$c]['list_header'] = $name;
        return $this;
    }
    
    public function addListItem($name, $url=null, $icon=null)
    {
        $c = $this->lastSection();
        
        if ($icon)
            $icon = 'icon-'.$icon;
            
        $this->sections[$c]['list_items'][] = array('name'=>$name, 'url'=>$url, 'icon'=>$icon, 'active'=>false);
        return $this;
    }
    
    public function addDivider()
    {
        $this->addSection(null, array(), true);
        return $this;
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
        return $this;
    }

    private function lastSection()
    {
        return count($this->sections) - 1;
    }

}