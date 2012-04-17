<?php

include_once("models/question.class.php");
include_once("models/answer.class.php");

class Model {

    public $questionIds;
    public $answerIds;

    public function __construct($result) {
        if (is_array($result)) {
            $this->questionIds = array_keys($result);
            foreach ($this->questionIds as $parId) {
                $this->answerIds[$parId] = $this->getAnswerIdByParentIdByParentId($parentId);
            }
        }
        else
        //$this->questionIds="Has no question appropiate";
            $this->questionIds = array($result);
    }

    public function connect_db() {
        $connect = mysql_connect('localhost', 'root', 'abc123');
        mysql_select_db('stackoverflow', $connect);
    }

    public function close_db() {
        mysql_close(); // ??? $connect
    }

    public function getQuestionList() {
        $arrayQuestionList = array();
        $index = 0;
        foreach ($this->questionIds as $value) {
            $arrayQuestionList[$index] = $this->getQuestion($value);
            $index++;
        }
        return $arrayQuestionList;
    }

    public function getQuestion($id) {
        $sql = "SELECT id, title, tags, body FROM posts WHERE id='$id'";
        $result = mysql_fetch_array(mysql_query($sql));
        $question = new Question($result['id'], $result['title'], $result['tags'], $result['body']);
        //$question->display();
        return $question;
    }

    public function getAnswer($id) {
        $sql = "SELECT id,body FROM posts WHERE id='$id'";
        $result = mysql_fetch_array(mysql_query($sql));
        $answer = new Answer($result['id'], $body['body']);
        return $answer;
    }

    public function getAnswerIdByParentId($parentId) {
        return array($parentId);
    }

}

?>