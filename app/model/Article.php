<?php

class Article
{
    private $db;

    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Connexion à la base de donnée impossible');
        }
    }

    public function getAllArticles() {
        $sql = "SELECT * FROM cdi_article";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteArticle($articleId) {
        $sql = "DELETE FROM cdi_article WHERE id = :articleId";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);
        $query->execute($parameters);
    }

    // public function addSong($artist, $track, $link)
    // {
    //     $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
    //     $query = $this->db->prepare($sql);
    //     $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);
    //     $query->execute($parameters);
    // }

    // public function getSong($song_id) {
    //     $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
    //     $query = $this->db->prepare($sql);
    //     $parameters = array(':song_id' => $song_id);
    //     $query->execute($parameters);
    //     return $query->fetch();
    // }

    // public function updateSong($artist, $track, $link, $song_id) {
    //     $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
    //     $query = $this->db->prepare($sql);
    //     $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);
    //     $query->execute($parameters);
    // }

    // public function getAmountOfSongs() {
    //     $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
    //     $query = $this->db->prepare($sql);
    //     $query->execute();
    //     return $query->fetch()->amount_of_songs;
    // }
}
