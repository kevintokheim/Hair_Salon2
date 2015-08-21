<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));



    //renders the front page (index) where the user can view and add stylists
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });



    //renders the clients page where the user can see the list of clients
    $app->get("/clients", function() use ($app) {
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });



    //page that is rendered when the user adds a stylist
    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });


    //Finds a stylist's specific id so the user can add clients
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });



    // $app->get("/clients", function() use ($app) {
    //     $client = new Client($_POST['client_name']);
    //     $client->save();
    //     return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    // });


    //Allows the user to add clients to a stylist's client list
    $app->post("/clients", function() use ($app) {
        $client_name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($client_name, $id = null, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });



    //Allows the user to add stylists to the list on the front page
    $app->post("/stylists", function() use ($app){
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });


    //Allows the user to delete the list of stylists on the front page
    //Error: Variable 'stylists' does not exist in 'stylists.html.twig' at line 11
    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('stylists.html.twig');
    });


    //route which allows the user to edit one stylist
    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });



    //allows the user to use the update method
    $app->patch("/stylists/{id}", function($id) use ($app) {
        $stylist_name = $_POST['stylist_name'];
        $stylist = Stylist::find($id);
        $stylist->update($stylist_name);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });



    //allows the user to delete a stylist
    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });


    //allows the user to find a client's id
    $app->get("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client.html.twig', array('client' => $client));
    });



    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client.html.twig', array('client' => $client));
    });


    //Allows the user to update the client
    $app->patch("/clients/{id}", function($id) use ($app) {
        $client_name = $_POST['client_name'];
        $client = Client::find($id);
        $stylist = Stylist::find($id);
        $client->update($client_name);
        return $app['twig']->render('client.html.twig', array('client' => $client));
    });


    //Allows a user to delete a client
    //Getting error: Impossible to access attribute getStylistName
    //on null variable in stylist.html.twig at 8.
    $app->delete("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $stylist = Stylist::find($client->getStylistId());
        $client->delete();
        $clients = Client::getAll();

        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });





















    return $app;
?>
