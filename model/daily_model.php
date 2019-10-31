<?php

class daily_model{
    private $feed;

    public function __construct(){
        $this->feed=array();
    }

    public function get_feed(){
        $xml_pais = simplexml_load_file("https://elpais.com/rss/elpais/portada.xml");
        $xml_mundo = simplexml_load_file("https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml");

        $pais = array();
        $mundo = array();

        $iteraciones = 5;
        foreach($xml_pais->channel->item as $news)
        {
            if($iteraciones <= 0)
                break;

            $pais['title'] = $news->title;
            $pais['link'] = $news->link;
            $pais['description'] = $news->description;
            $pais['date'] = $news->pubDate;
            $pais['image'] = $news->enclosure->attributes()->url;

            $this->feed['pais'][] = $pais;
            $iteraciones--;
        }

        $iteraciones = 5;
        foreach($xml_mundo->channel->item as $news)
        {
            if($iteraciones <= 0)
                break;

            $namespaces = $news->getNameSpaces(true);
            $media = $news->children($namespaces['media']);
            $imagen = $media->content->attributes()->url;

            if(!empty($imagen))
            {
                $mundo['title'] = $news->title;
                $mundo['link'] = $news->link;                
                $mundo['description'] = $media->description;
                $mundo['date'] = $news->pubDate;
                $mundo['image'] = $imagen;
                
                $this->feed['mundo'][] = $mundo;
                $iteraciones--;
            }    
        }

        return $this->feed;
    }

}

?>