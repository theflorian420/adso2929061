<?php
$title = "02- Construct";
$description = " Construct: Special method that initializes a new object upon creation.";

include 'template/header.php';
echo "<section>";
class PlayList{
    public $name;
    public $artist;
    public $album;
    public $genre;
    public $image;
    public $year;

    public function __construct($name) {
        $this->name = $name;
    }
    public function setPlayListDetails($artist, $album, $genre, $image, $year){
        $this->artist = $artist;
        $this->album = $album;
        $this->genre = $genre;
        $this->image = $image;
        $this->year = $year;
    }
    public function getPlaylist() {
        echo "<ul>
                <li> $this->name </li>
                <ol>";
                for($i = 0; $i < count($this->artist); $i++) {
                    echo "<li> $this->artist[$i]</li>";
                    
                
                
                
                
                }
    }
   







}


include 'template/footer.php';
