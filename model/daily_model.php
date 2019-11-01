<?php

require_once("news.php");
require_once("feed.php");

class daily_model{
    private $feed;

    public function __construct(){
        $this->feed= new feed();
    }

    public function get_feed(){
        $xml_pais = simplexml_load_file("https://elpais.com/rss/elpais/portada.xml");
        $xml_mundo = simplexml_load_file("https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml");

        $pais = array();
        $mundo = array();

        $iteraciones = 5;
        foreach($xml_pais->channel->item as $item)
        {
            if($iteraciones <= 0)
                break;

            $pais[] =  new news($item->title, $item->link, $item->description, $item->pubDate, $item->enclosure->attributes()->url);
            $iteraciones--;
        }

        $this->feed->insertNews('pais' , $pais);

        $iteraciones = 5;
        foreach($xml_mundo->channel->item as $item)
        {
            if($iteraciones <= 0)
                break;

            $namespaces = $item->getNameSpaces(true);
            $media = $item->children($namespaces['media']);
            $imagen = $media->content->attributes()->url;

            if(!empty($imagen))
            {                
                $mundo[] = new news($item->title, $item->link, $media->description, $item->pubDate, $imagen);
                $iteraciones--;
            }    
        }

        $this->feed->insertNews('mundo' , $mundo);

        return $this->feed->getFeed();
    }

}

?>