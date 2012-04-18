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
            // Chua có câu hỏi và cũng chưa có yêu cầu=> Chỉ hiển thị Form question
            include 'views/searchQuestion.php';
            include 'views/footer.php';
        } else {
            // Đã có câu hỏi và có câu yêu cầu. Bắt đầu tìm kiếm câu hỏi
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
                        $this->model->close_db();
                        include 'views/searchQuestion.php';
                        include 'views/viewList.php';
                        include 'views/footer.php';
                    }
                    break;
                case "viewquestion":
                    $this->model = new Model;
                    $this->model->connect_db();
                    $question=$this->model->getQuestion($id);
                    $question->display_full();
                    $this->model->close_db();
                    break;
            }
        }
    }

}
?>