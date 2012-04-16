<?php

require_once(dirname(__FILE__) . '/deps.php');
require_once(dirname(__FILE__) . '/../Alert.class.php');

use tbcomponents\Alert;

class AlertTest extends PHPUnit_Framework_TestCase
{
    public function testDefaults()
    {
        $alert = new Alert($heading="Heading", $template="Hey, something's wrong!");
        $a = (array)$alert;
        
        $this->assertArrayHasKey('type',  $a);
        $this->assertArrayHasKey('content',  $a);
        $this->assertArrayHasKey('closeable',  $a);
        $this->assertArrayHasKey('heading',  $a);
        $this->assertArrayHasKey('block',  $a);
        
        $this->assertEquals('', $a['type']);
        $this->assertEquals('Heading', $a['heading']);
        $this->assertEquals("Hey, something's wrong!", (string)$a['content']);
        $this->assertEquals(false, $a['closeable']);
        $this->assertEquals(false, $a['block']);    
    }
    

    public function testWarningAlert()
    {
        // Alert($heading, $template, $type=null /*WARNING*/, $closeable=false, $block=false);
        
        /* Structure
            array(
                'type'=> '' | 'alert-error' | 'alert-success' | 'alert-info',
                'template'=> 'My Content, plus {{>partials}}',
                'closeable'=> true | false,
                'heading'=> 'Some heading text' (optional),
                'block'=> true | false
            )
        */ 
        $alert = new Alert($heading="Warning!", $template="Hey, something's wrong!", $type=Alert::WARNING, $closeable=true, $block=true);
        $a = (array)$alert;
        
        $this->assertArrayHasKey('type',  $a);
        $this->assertArrayHasKey('content',  $a);
        $this->assertArrayHasKey('closeable',  $a);
        $this->assertArrayHasKey('heading',  $a);
        $this->assertArrayHasKey('block',  $a);
        
        $this->assertEquals('', $a['type']);
        $this->assertEquals('Warning!', $a['heading']);
        $this->assertEquals("Hey, something's wrong!", (string)$a['content']);
        $this->assertEquals(true, $a['closeable']);
        $this->assertEquals(true, $a['block']);
    }
    
    public function testErrorAlert()
    {
        $alert = new Alert($heading="Warning!", $template="Hey, something's wrong!", $type=Alert::ERROR, $closeable=true, $block=true);
        $a = (array)$alert;
        $this->assertEquals('alert-error', $a['type']);
    }    

    public function testSuccessAlert()
    {
        $alert = new Alert($heading="Warning!", $template="Hey, something's wrong!", $type=Alert::SUCCESS, $closeable=true, $block=true);
        $a = (array)$alert;
        $this->assertEquals('alert-success', $a['type']);
    } 

    public function testInformationAlert()
    {
        $alert = new Alert($heading="Warning!", $template="Hey, something's wrong!", $type=Alert::INFORMATION, $closeable=true, $block=true);
        $a = (array)$alert;
        $this->assertEquals('alert-info', $a['type']);
    }
    
    public function testInvalidType()
    {
        $this->setExpectedException('tbcomponents\InvalidAlertTypeException');
        $alert = new Alert($heading="Warning!", $template="Hey, something's wrong!", $type='foo', $closeable=true, $block=true);
    }
    
}
?>