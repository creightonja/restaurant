<?php


    class Cuisine {

        private $cuisine_name;
        private $id;
        private $restaurant_id;


        function __construct($cuisine_name, $id = null, $restaurant_id) {
            $this->cuisine_name = $cuisine_name;
            $this->id = $id;
            $this->restaurant_id = $restaurant_id;

        }

        function setCuisineName($new_cuisine_name) {
            $this->cuisine_name = (string) $new_cuisine_name;
        }

        function getCuisineName(){
            return $this->cuisine_name;
        }

        function getId() {
            return $this->id;
        }

        function getRestaurantId(){
            return $this->restaurant_id;
        }

        function save() {
            $statement = $GLOBALS['DB']->exec("INSERT INTO cuisine (cuisine_name, restaurant_id)
                            VALUES ('{$this->getCuisineName()}', {$this->getRestaurantId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_cuisine_name) {
            $GLOBALS['DB']->exec("UPDATE cuisine SET cuisine_name = '{$new_cuisine_name}'
                    WHERE id = {$this->getId()};");
            $this->setCuisineName($new_cuisine_name);
        }

        function deleteOne() {

            $GLOBALS['DB']->exec("DELETE FROM cuisine WHERE id = {$this->getId()};");
        //    $GLOBALS['DB']->exec("DELETE FROM 'restaurants'.'cuisine' WHERE id = {$this->getId()};");
        //    $GLOBALS['DB']->exec("DELETE FROM cuisine WHERE {$this->getId()} IS NULL;");
        }

        static function getAll() {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine ORDER BY cuisine_name;");
            $cuisines = array();
            foreach ($returned_cuisines as $cuisine) {
                $cuisine_name = $cuisine['cuisine_name'];
                $id = $cuisine['id'];
                $restaurant_id = $cuisine['restaurant_id'];
                $new_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM cuisine;");
        }

        static function find($search_id) {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
    }




?>
