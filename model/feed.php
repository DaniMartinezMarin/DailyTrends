<?php 

class feed{

    private $feed;

    public function __construct(){
        $this->feed=array();
    }

    public function insertNews($_nombre, $_news)
    {
        $this->feed[$_nombre] = $_news;
    }

    public function getFeed()
    {
        return $this->feed;
    }
}

?>