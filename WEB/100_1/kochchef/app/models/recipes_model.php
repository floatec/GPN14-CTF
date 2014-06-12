<?php
class Recipes_Model extends Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_recipes(){
        return $this->_db->select("SELECT * FROM ".PREFIX."rezepte WHERE sichtbar=1 ORDER BY id");
    }
    public function get_recipesByuser($userid){
        return $this->_db->select("SELECT * FROM ".PREFIX."rezepte WHERE user =:userid ORDER BY id",array(':userid' => $userid));
    }

    public function get_recipe($id){
        return $this->_db->select("SELECT * FROM ".PREFIX."rezepte WHERE id =:id",array(':id' => $id));
    }

    public function insert($data){
        $this->_db->insert(PREFIX."rezepte",$data);
    }

    public function update($data,$where){
        $this->_db->update(PREFIX."rezepte",$data,$where);
    }

    public function delete($id){
        $this->_db->delete(PREFIX."rezepte", array('id' => $id));
    }
}