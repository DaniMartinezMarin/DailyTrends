<?php

    class news{

        private $title, $link, $description, $date, $image;

        public function __construct($_title, $_link, $_description, $_date, $_image){
            
            $this->title = $_title;
            $this->link = $_link;
            $this->description = $_description;
            $this->date = $_date;
            $this->image = $_image;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getLink()
        {
            return $this->link;
        }
        
        public function getDescription()
        {
            return $this->description;
        }
        
        public function getDate()
        {
            return $this->date;
        }
        
        public function getImage()
        {
            return $this->image;
        }
    }

?>