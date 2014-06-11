<?php
class Rezepte extends Controller {

	public function __construct(){
		parent::__construct();
        $this->model= $this->loadModel('rezept_model');
	}

	public function index(){
        $data['title'] = 'Rezepte ';
        $data['recipes'] = $this->model->get_recipes();

        $this->view->rendertemplate('header',$data);
        $this->view->render('recipes/list',$data);
        $this->view->rendertemplate('footer',$data);
	}
    public function add(){

        if(isset($_POST['submit'])){

            $name = $_POST['name'];
            $beschreibung = $_POST['beschreibung'];
            $zutaten = $_POST['zutaten'];

            if(empty($name)){
                $error[] = 'Please enter thename';
            }

            if(empty($beschreibung)){
                $error[] = 'Please enter the description';
            }


            if(!isset($error)){

                $postdata = array(
                    'name' => $name,
                    'beschreibung' => $beschreibung,
                    'zutaten' => $zutaten
                );
                $this->model->insert($postdata);

                $error[] = 'The admin will be activate your awesome recipe soon';
            }
        }
        $data['title'] = 'Add Conntact';

        $this->view->rendertemplate('header',$data);
        $this->view->render('recipes/add',$data,$error);
        $this->view->rendertemplate('footer',$data);
    }
}