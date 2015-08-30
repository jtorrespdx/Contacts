<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contacts.php";

    //this creates and checks for cookies
    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    //////////instantiate Silex and Twig/////////////
    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


    ////////////These are the routes//////////////////

    //////////////////Landing Page////////////////////
    $app->get("/", function() use ($app) {
        ///$app uses twig to render contacts page and passes through Contact class to build its array of contacts
        return $app['twig']->render('contacts.html.twig', array('list_of_contacts' => Contact::getAll()));
    });

    /////////////////Create Contact Page//////////////////////
    $app->post("/create_contact", function() use ($app) {
        ///////pushes new contacts to session array
        $contact = new Contact($_POST['name'], $_POST['phone_number'], $_POST['address']);
        ////saves to session array
        $contact->save();
        //////twig uses $app to render contacts page with the newly instatiated contacts
        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact));
    });

    /////////////////Clear all Contacts Page//////////////////
    $app->post("/delete_contacts", function() use ($app) {
        //////////delete all function writes blank array to clear contacts
        Contact::deleteAll();
        //////////twig uses app to render contacts delete page.
        return $app['twig']->render('delete_contacts.html.twig');
    });

    return $app;
?>
