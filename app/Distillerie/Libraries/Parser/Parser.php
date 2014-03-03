<?php namespace Distillerie\Libraries\Parser;

use Symfony\Component\DomCrawler\Crawler;
use Link;

class Parser
{
    protected $content = '';
    protected $crawler = null;
    protected $tabsLinks = array();
    protected $domaine = null;
    protected $status = 0;


    public function __construct($domaine)
    {

        if (!empty($domaine)) {
            $this->domaine = Link::domaine($domaine);
        }

        $this->init();
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getLinks()
    {
        return $this->tabsLinks;
    }

    public function crawlLinks()
    {
        foreach ($this->crawler->filter('a') as $value) {
            $link = $value->getAttribute('href');

            if (!in_array($link, $this->tabsLinks)) {

                $this->tabsLinks[] = Link::generate($link, $this->domaine);
            }

        }

    }

    public function crawlImages()
    {
        foreach ($this->crawler->filter('img') as $value) {
            $link = $value->getAttribute('src');

            if (!in_array($link, $this->tabsLinks)) {
                $this->tabsLinks[] = Link::generate($link, $this->domaine);

            }
        }
    }

    protected function init()
    {
        $this->initContent();

        if(Link::isFile((string)$this->domaine)){
            return false;
        }

        $this->initCrawler();
        $this->crawlLinks();
        $this->crawlImages();
    }

    protected function initContent()
    {
        $cu = curl_init();

        curl_setopt($cu, CURLOPT_URL, (string)$this->domaine);
        curl_setopt($cu,CURLOPT_HEADER,true);
        curl_setopt($cu,CURLOPT_RETURNTRANSFER,true);

        $this->content = curl_exec($cu);
        $this->status = curl_getinfo($cu, CURLINFO_HTTP_CODE);

        curl_close($cu);

    }

    protected function initCrawler()
    {
        $this->crawler = new Crawler();
        $this->crawler->addContent($this->content);
    }

}