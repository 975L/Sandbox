<?php
namespace App\Command;

use c975L\ConfigBundle\Service\ConfigServiceInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;

class SitemapCreateCommand extends ContainerAwareCommand
{
    protected $baseUrl = 'https://sandbox.975l.com';
    private $configService;
    private $sitemapFolder;
    private $environment;

    public function __construct(
        ConfigServiceInterface $configService,
        Environment $environment
    )
    {
        parent::__construct();
        $this->configService = $configService;
        $this->environment = $environment;
        $this->sitemapFolder = $this->configService->getContainerParameter('kernel.root_dir') . '/../public';
    }

    protected function configure()
    {
        $this
            ->setName('sitemap:create')
            ->setDescription('Creates the sitemaps')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createSitemapIndex();
        $this->createSitemapSite();
        $this->createSitemapPages($output);

        //Ouputs message
        $output->writeln('Sitemaps created!');
    }

    //Create sitemap index
    public function createSitemapIndex()
    {
        //Defines sitemaps
        $sitemaps = array(
            $this->baseUrl . '/sitemap-site.xml',
            $this->baseUrl . '/sitemap-pages.xml',
        );

        //Writes file
        $sitemapIndexContent = $this->environment->render('@c975LPageEdit/sitemap-index.xml.twig', array('sitemaps' => $sitemaps));
        $sitemapIndexFile = $this->sitemapFolder . '/sitemap-index.xml';
        file_put_contents($sitemapIndexFile, $sitemapIndexContent);
    }

    //Creates the sitemap for pages managed by PageEdit
    public function createSitemapPages($output)
    {
        $command = $this->getApplication()->find('pageedit:createSitemap');
        $inputArray = new ArrayInput(array());
        $command->run($inputArray, $output);
    }

    //Creates the sitemap for pages specific to site
    public function createSitemapSite()
    {
        $languages = array('en', 'fr', 'es');

        //Defines main pages
        $pagesList = array(
            '' => 'weekly, 1.0',
            'contact' => 'monthly, 0.4',
            );
        foreach ($languages as $language) {
            foreach ($pagesList as $key => $value) {
                //Extracts values
                $values = explode(',', $value);

                //Defines data
                $url = $this->baseUrl . '/' . $language;
                $url .= $key != '' ? '/' . $key : '';
                $pages[]= array(
                    'url' => $url,
                    'lastModified' => null,
                    'changeFrequency' => trim($values[0]),
                    'priority' => trim($values[1]),
                );
            }
        }

        //Writes file
        $sitemapContent = $this->environment->render('@c975LPageEdit/sitemap.xml.twig', array('pages' => $pages));
        $sitemapFile = $this->sitemapFolder . '/sitemap-site.xml';
        file_put_contents($sitemapFile, $sitemapContent);
    }
}