<?php

class SculpinKernel extends \Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    protected function getAdditionalSculpinBundles()
    {
        return array(
            'Lmuzinic\Sculpin\Bundle\MeetupNextEventBundle\MeetupNextEventBundle',
        );
    }
}
