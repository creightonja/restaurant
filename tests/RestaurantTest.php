<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Restaurant::deleteAll();
            //Cuisine::deleteAll();
        }

        function test_getName() {
            //Arrange
            $restaurant_name = "Joe's Burgers";
            $test_Restaurant = new Restaurant($restaurant_name);

            //Act
            $result = $test_Restaurant->getRestaurantName();

            //Assert
            $this->assertEquals($restaurant_name, $result);

        }

        function test_getId() {
            //Arrange
            $restaurant_name = "Joe's Burgers";
            $id = 1;
            $test_Restaurant = new Restaurant($restaurant_name, $id);

            //Act
            $result = $test_Restaurant->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save() {
            //Arrange
            $restaurant_name = "Joes Burgers";
            $test_Restaurant = new Restaurant($restaurant_name);
            $test_Restaurant->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($test_Restaurant, $result[0]);

        }

        function test_getAll() {
            //Arrange
            $restaurant_name = "Joes Burgers";
            $restaurant_name2 = "McDonalds";
            $test_Restaurant = new Restaurant($restaurant_name);
            $test_Restaurant->save();
            $test_Restaurant2 = new Restaurant($restaurant_name2);
            $test_Restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_Restaurant, $test_Restaurant2], $result);
        }

        function test_deleteAll() {
            //Arrange
            $restaurant_name = "Joes Burgers";
            $restaurant_name2 = "McDonalds";
            $test_Restaurant = new Restaurant($restaurant_name);
            $test_Restaurant->save();
            $test_Restaurant2 = new Restaurant($restaurant_name2);
            $test_Restaurant2->save();

            //Act
            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        function test_find() {
            //Arrange
            $restaurant_name = "Joes Burgers";
            $restaurant_name2 = "McDonalds";
            $test_Restaurant = new Restaurant($restaurant_name);
            $test_Restaurant->save();
            $test_Restaurant2 = new Restaurant($restaurant_name2);
            $test_Restaurant2->save();

            //Act
            $result = Restaurant::find($test_Restaurant->getId());

            //Assert
            $this->assertEquals($test_Restaurant, $result);
        }
    }

?>
