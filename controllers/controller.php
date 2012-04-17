<?php

require_once("models/model.php");
require ("sphinxapi.php");

class Controller {

    public $model;

    /*
      public __construct(){
      $this->model= new Model();
      }
     */

    public function invoke() {
        $question = $_REQUEST['question'];
        $task = $_REQUEST['task'];
        $tags = $_REQUEST['tags'];
        $detail = $_REQUEST['detail'];
        $id = $_REQUEST['id'];

        if (!isset($question) && !isset($task)) {
            include 'views/questionsearch.html';
            include 'views/footer.html';
        } else {
            switch ($task) {
                case "search":
                    $cl = new SphinxClient();
                    $cl->SetServer("localhost", 9312);
                    $cl->SetMatchMode(SPH_MATCH_ANY);
                    //$cl->SetArrayResult(true);
                    $result = $cl->Query($question, 'sof');
                    if ($result === false) {
                        echo "Query failed: " . $cl->GetLastError() . ".\n";
                    } else {
                        $this->model = new Model($result['matches']);
                        $this->model->connect_db();
                        global $questionList;
                        $questionList = $this->model->getQuestionList();
                        include 'views/questionsearch.html';
                        include 'views/questionlist.html';
                        include 'views/footer.html';
                    }
                    break;
                case "view":
                    $this->model = new Model();
                    global $question;
                    $question = $this->model->getQuestion($id);
                    $question->display();
                    echo "View answer for this question.";
                    break;
            }
        }
    }

}

?>