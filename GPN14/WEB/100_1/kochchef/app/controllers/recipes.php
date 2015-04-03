<?php

//var_dump(debug_backtrace());
class Recipes extends Controller {

	private $_recipe;

	public function __construct(){
		parent::__construct();

		$this->_recipes = $this->loadModel('recipe_model');

		if(Session::get('loggin') == false){
			url::redirect('user/login');
		}
	}

	public function rlist(){

		$data['title'] = 'recipes';
		$data['recipes'] = $this->_recipes->get_recipes();

		$this->view->rendertemplate('header',$data);
		$this->view->render('recipes/list',$data);
		$this->view->rendertemplate('footer',$data);
	}

	public function add(){

		if(isset($_POST['submit'])){

			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];

			if(empty($firstName)){
				$error[] = 'Please enter the first name';
			}

			if(empty($lastName)){
				$error[] = 'Please enter the last name';
			}

			if(!isset($error)){

				$postdata = array(
					'firstName' => $firstName,
					'lastName' => $lastName
				);
				$this->_recipes->insert($postdata);
				Url::redirect('recipes');

			}
		}

		$data['title'] = 'Add Conntact';

		$this->view->rendertemplate('header',$data);
		$this->view->render('recipes/add',$data,$error);
		$this->view->rendertemplate('footer',$data);
	}

	function edit($id){

		if(isset($_POST['submit'])){

			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];

			if(empty($firstName)){
				$error[] = 'Please enter the first name';
			}

			if(empty($lastName)){
				$error[] = 'Please enter the last name';
			}

			if(!isset($error)){

				$postdata = array(
					'firstName' => $firstName,
					'lastName' => $lastName
				);
				$where = array('id' => $id);
				$this->_recipes->update($postdata, $where);
				Url::redirect('recipes');

			}
		}

		$data['title'] = 'Edit';
		$data['row'] = $this->_recipes->get_contact($id);

		$this->view->rendertemplate('header',$data);
		$this->view->render('recipes/edit',$data,$error);
		$this->view->rendertemplate('footer',$data);
	}

	function delete($id){

		$this->_recipes->delete($id);
		Url::redirect('recipes');

	}

}
?>