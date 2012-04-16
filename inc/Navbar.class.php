<?php

namespace tbcomponents;
use Exception;

class InvalidPullTypeException extends Exception { }
class InvalidListItemAssignmentException extends Exception { }

class Navbar extends ComponentBase {

    public $template = "{{> navbar }}";
    public $brandname = null;
    public $sections = array();
    
    const PULL_LEFT = 'pull-left';
    const PULL_RIGHT = 'pull-right';
    
    const SEARCH = 'search';

    public function addBrandname($name) 
    {
        $this->brandname = $name;
        return $this;
    }
    
    public function addNavList($pull=null)
    {
        $this->sections[] = array(
            'type' => array('navlist'=>true),
            'pull' => $this->checkPull($pull),
            'list_items' => array()
        );
        return $this;
    }
    
    public function addListItem($name, $url=null)
    {
        $c = $this->lastSection();
        
        if ($c < 0) {
            throw new InvalidListItemAssignmentException('No Section To Add List Item To');
        } else if (! array_key_exists('list_items',$this->sections[$c]) ) {
            throw new InvalidListItemAssignmentException('Invalid Section To Add List Item To');
        }
        
        $this->sections[$c]['list_items'][] = array('name'=>$name, 'url'=>$url, 'active'=>false);
        return $this;
    }
    
    public function makeActive($name)
    {
        foreach($this->sections as &$section)
        {
            if ( array_key_exists('list_items', $section) ) 
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
        return $this;
    }    
    
    public function addNavForm($type, $action=null, $pull=null)
    {
        $this->sections[] = array(
            'type' => array($type => true),
            'action' => $action,
            'pull' => $this->checkPull($pull)
        );
        return $this;
    }
    
    public function addNavText($content, $pull=null)
    {
        $this->sections[] = array(
            'type' => array('text' => true),
            'content' => $content,
            'pull' => $this->checkPull($pull)
        );
        return $this;        
    }
    

    private function checkPull($pull)
    {
        if (is_null($pull)) {
            return self::PULL_LEFT;
        } else if ($pull != self::PULL_LEFT && $pull != self::PULL_RIGHT) {
            throw new InvalidPullTypeException('Invalid Pull Type: '. (string)$pull);
        } else {
            return $pull;        
        }
    }
    
    private function lastSection()
    {
        return count($this->sections) - 1;
    }    

    

}