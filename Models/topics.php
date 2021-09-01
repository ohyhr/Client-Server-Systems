<?php

require_once ('Database.php');
require_once ('UsersData.php');

class topics
{
//Constructors for class post.
    protected $_topic_id, $_content, $_date_posted, $_title, $_author, $_category_id, $_subcategory_id;
    public function __construct($dbRow) {
        $this-> _topic_id = $dbRow['topic_id'];
        $this-> _content = $dbRow['content'];
        $this-> _date_posted = $dbRow['date_posted'];
        $this-> _title = $dbRow['title'];
        $this-> _author = $dbRow['author'];
        $this-> _category_id = $dbRow['category_id'];
        $this-> _subcategory_id = $dbRow['subcategory_id'];
    }

    //Get methods for the post table.
    public function getTopicID() {
        return $this->_topic_id;
    }

    public function getContent() {
        return $this->_content;
    }

    public function getDatePosted() {
        return $this->_date_posted;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function getAuthor() {
        return $this->_author;
    }

    public function getCatID()
    {
        return $this->_category_id;
    }

    public function getSubCatID()
    {
        return $this->_subcategory_id;
    }

    //Following is needed for the search bar function.
    public function addPost ($a, $searchValue, $sort) {

        //This will select everything from the posts database where it is matching the search value which is what the user types.
        if (!($searchValue == NULL)) {
            $sqlQuery = "SELECT * FROM topics WHERE title LIKE '%searchValue%' limit".$a;
        }
        //elseif ($sort == "ASC") {
        //$sqlQuery = "SELECT * FROM posts ORDER BY subject ASC limit $no";
        //}
        //elseif ($sort == "DESC") {
        //$sqlQuery = "SELECT * FROM posts ORDER BY subject DESC limit $no";
        //}
        //elseif ($sort == "ASC") {
        //$sqlQuery = "SELECT * FROM posts ORDER BY subject ASC limit $no";
        //}
        //else {
        //$sqlQuery = "SELECT * FROM posts limit $no";
        //}
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $postData = [];
        while ($row = $statement->fetch())
        {
            $postData[] = new PostData($row);
        }
        return $postData;
    }
}