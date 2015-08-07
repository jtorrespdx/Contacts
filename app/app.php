<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contacts.php";
    session_start();
    /* Perhaps add contacts here? Unclear on instructions whether they should be a few already save here. */

    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array('');
    }
    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
    
    $app->get("/", function() use ($app) {

        return $app['twig']->render('contacts.html.twig', array('list_of_contacts' => Contacts::getAll()));
    });

    $app->post("/create_contact", function() use ($app) {
        $contact = new Contacts($_POST['name'], $_POST['phone_number'], $_POST['address']);
        $contact->save();

        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact));
    });

    $app->post("/delete_contacts", function() use ($app) {
        Contacts::deleteAll();
        return $app['twig']->render('delete_contacts.html.twig');
    });

    return $app;
?>
