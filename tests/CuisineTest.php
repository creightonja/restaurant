<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    class CuisineTest extends PHPUnit_Framework_TestCase {


        protected function tearDown() {
            Cuisine::deleteAll();
        }

        function test_getId() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();


            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getRestaurantId() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            //Act
            $result = $test_cuisine->getRestaurantId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineName() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            //Act
            $result = $test_cuisine->getCuisineName();

            //Assert
            $this->assertEquals($cuisine_name, $result);
        }

        function test_save() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            $cuisine_name2 = "Tacos2";
            $restaurant_id2 = $test_restaurant->getId();
            $test_cuisine2 = new Cuisine($cuisine_name2, $id, $restaurant_id2);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);

        }

        function test_getAll() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            $cuisine_name2 = "Tacos2";
            $restaurant_id2 = $test_restaurant->getId();
            $test_cuisine2 = new Cuisine($cuisine_name2, $id, $restaurant_id2);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);


        }

        function test_deleteAll() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            $cuisine_name2 = "Tacos2";
            $restaurant_id2 = $test_restaurant->getId();
            $test_cuisine2 = new Cuisine($cuisine_name2, $id, $restaurant_id2);
            $test_cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        function test_find() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            $cuisine_name2 = "Tacos2";
            $restaurant_id2 = $test_restaurant->getId();
            $test_cuisine2 = new Cuisine($cuisine_name2, $id, $restaurant_id2);
            $test_cuisine2->save();

            //Act
            $id = $test_cuisine->getId();
            $result = Cuisine::find($id);

            //Assert
            $this->assertEquals($test_cuisine, $result);

        }

        function test_sort() {
            //Arrange
            $restaurant_name = "McDonalds";
            $id = null;
            $test_restaurant = new Restaurant($restaurant_name, $id);
            $test_restaurant->save();

            $cuisine_name2 = "Tacos2";
            $restaurant_id2 = $test_restaurant->getId();
            $test_cuisine2 = new Cuisine($cuisine_name2, $id, $restaurant_id2);
            $test_cuisine2->save();

            $cuisine_name = "Tacos";
            $restaurant_id = $test_restaurant->getId();
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            //Act
            $id = $test_cuisine->getId();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);

            }

        function test_update() {
            //Arrange
            $cuisine_name = "tacos";
            $id = null;
            $restaurant_id = 2;
            $test_cuisine = new Cuisine($cuisine_name, $id, $restaurant_id);
            $test_cuisine->save();

            $new_cuisine_name = "burgers";

            //Act
            $test_cuisine->update($new_cuisine_name);

            //Assert
            $this->assertEquals("burgers", $test_cuisine->getCuisineName());

        }

    }


?>
