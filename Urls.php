<?php

$site = new ToroApplication(array(
    array('/', 'MainHandler'),
    array('test/([a-z]+)', 'TestHandler'),
    array('form', 'FormHandler'),
    array('wysiwyg', 'WysiwygHandler'),
    array('gallery', 'GalleryHandler'),
));  