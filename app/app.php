<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Restaurant.php";
  require_once __DIR__."/../src/Cuisine.php";


  $app = new Silex\Application();
  $app['debug'] = true;


  $server = 'mysql:host=localhost;dbname=restaurants';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);


  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));



  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
  });

  $app->get("/cuisine", function() use ($app) {
      return $app['twig']->render('cuisine.html.twig', array('cuisine' => Cuisine::getAll(), 'restaurants' => Restaurant::getAll()));
  });

  $app->get("/restaurants", function() use ($app) {
      Cuisine::deleteAll();
      return $app['twig']->render('restaurants.html.twig', array('restaurants' => Restaurant::getAll()));
  });

  $app->post("/restaurants", function() use ($app) {
      $restaurant = new Restaurant($_POST['restaurant_name']);
      $restaurant->save();
      return $app['twig']->render('restaurants.html.twig', array('restaurants' => Restaurant::getAll()));
  });

  $app->post("/cuisine", function () use ($app) {
      $id = null;
      $restaurant_id = intval($_POST['restaurant_id']);
      $restaurant_name = Restaurant::find($restaurant_id);
      $cuisine = new Cuisine($_POST['cuisine_name'], $id, $restaurant_id);
      $cuisine->save();
      return $app['twig']->render('cuisine.html.twig', array('cuisine' => Cuisine::getAll(), 'restaurants' => Restaurant::getAll()));
  });

  $app->post("/delete_cuisine", function() use ($app) {
      Cuisine::deleteAll();
      return $app['twig']->render('index.html.twig');
  });

  $app->post("/delete_restaurants", function() use ($app) {
      Restaurant::deleteAll();
      return $app['twig']->render('index.html.twig');
  });

  $app->get("/restaurants/{id}/edit", function($id) use($app) {
      $restaurant = Restaurant::find($id);
      return $app['twig']->render('restaurant_edit.html.twig', array('restaurant' => $restaurant));
  });

  $app->post("/restaurants/{id}", function($id) use($app) {
      $restaurant_name = $_POST['restaurant_name'];
      $restaurant = Restaurant::find($id);
      $restaurant->update($restaurant_name);
      $restaurants = Restaurant::getAll();
      return $app['twig']->render('restaurants.html.twig', array('restaurants' => $restaurants));
  });

  $app->get("/cuisine/{id}/edit", function($id) use($app) {
      $cuisine = Cuisine::find($id);
      return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
  });

  $app->post("/cuisine/{id}", function($id) use($app) {
      $cuisine_name = $_POST['cuisine_name'];
      $cuisine = Cuisine::find($id);
      $cuisine->update($cuisine_name);
      $cuisines = Cuisine::getAll();
      return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisines, 'restaurants' => Restaurant::getAll()));
  });

  return $app;
?>
