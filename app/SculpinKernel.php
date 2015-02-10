<?php

class SculpinKernel extends \Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    protected function getAdditionalSculpinBundles()
    {
        return array(
            'Zgphp\Sculpin\Bundle\ZgphpSculpinAdditionsBundle\ZgphpSculpinAdditionsBundle',
            'Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle'
        );
    }
}
