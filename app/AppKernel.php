<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Endroid\QrCode\Bundle\QrCodeBundle\EndroidQrCodeBundle(),
            new Http\HttplugBundle\HttplugBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new c975L\ContactFormBundle\c975LContactFormBundle(),
            new c975L\EmailBundle\c975LEmailBundle(),
            new c975L\EventsBundle\c975LEventsBundle(),
            new c975L\GiftVoucherBundle\c975LGiftVoucherBundle(),
            new c975L\IncludeLibraryBundle\c975LIncludeLibraryBundle(),
            new c975L\PageEditBundle\c975LPageEditBundle(),
            new c975L\PaymentBundle\c975LPaymentBundle(),
            new c975L\PurchaseCreditsBundle\c975LPurchaseCreditsBundle(),
            new c975L\ShareButtonsBundle\c975LShareButtonsBundle(),
            new c975L\SiteBundle\c975LSiteBundle(),
            new c975L\ToolbarBundle\c975LToolbarBundle(),
            new c975L\UserBundle\c975LUserBundle(),
            new AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new c975L\CountLinesCodeBundle\c975LCountLinesCodeBundle();
            $bundles[] = new c975L\XliffBundle\c975LXliffBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
