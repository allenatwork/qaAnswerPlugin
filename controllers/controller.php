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
		
		public function invoke(){
			$question = $_REQUEST['question'];
			$task = $_REQUEST['task'];
			$tags=$_REQUEST['tags'];
			$detail=$_REQUEST['detail'];
			
			if(!isset($question)&&!isset($task)) {
			// Chua cÃ³ cÃ¢u há»�i vÃ  cÅ©ng chÆ°a cÃ³ yÃªu cáº§u=> Chá»‰ hiá»ƒn thá»‹ Form question
				include 'views/questionsearch.html';
				include 'views/footer.html';
			}
			else { 
			// Ä�Ã£ cÃ³ cÃ¢u há»�i vÃ  cÃ³ cÃ¢u yÃªu cáº§u. Báº¯t Ä‘áº§u tÃ¬m kiáº¿m cÃ¢u há»�i           
				$cl = new SphinxClient();
				$cl->SetServer( "localhost", 9312 );
				$cl->SetMatchMode( SPH_MATCH_ANY  );
				//$cl->SetArrayResult(true);
				$result = $cl->Query($question,'sof');
				if ( $result === false ) {
					echo "Query failed: " . $cl->GetLastError() . ".\n";
				}
				else {
					$this->model = new Model($result['matches']);
					$this->model->connect_db();
					global $questionList;
					$questionList = $this->model->getQuestionList();
					echo "<pre>";
					//print_r($questionList);
					echo "</pre>";
					include 'views/questionsearch.html';
					include 'views/questionlist.html';
					include 'views/footer.html';
				}
			}
		}
	}
?>