<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contacts.php";

    //this creates and checks for cookies
    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    ////////////These are the routes//////////////////
    //////////////////Landing Page////////////////////

    $app->get("/", function() use ($app) {

        return $app['twig']->render('contacts.html.twig', array('list_of_contacts' => Contact::getAll()));
    });

    /////////////////Create Contact Page//////////////////////
    $app->post("/create_contact", function() use ($app) {
        $contact = new Contact($_POST['name'], $_POST['phone_number'], $_POST['address']);
        $contact->save();

        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact));
    });

    /////////////////Clear all Contacts Page//////////////////
    $app->post("/delete_contacts", function() use ($app) {
        Contact::deleteAll();
        return $app['twig']->render('delete_contacts.html.twig');
    });

    return $app;
?>
