<?php

namespace Services;
require_once "Repository/ContactRepository.php";
require_once "Entity/Contact.php";

use Entity\Contact;
use Repository\ContactRepository;
class ContactServices
{

    public function createContact(string $nom, string $prenom, string $email)
    {
    $contact = new Contact();
    $contact->setNom($nom);
    $contact->setPrenom($prenom);
    $contact->setEmail($email);
    $contactRepository = new ContactRepository();
    return $contactRepository->add($contact);
    }

//    public function deleteContact(string $nom, string $prenom, string $email)
//    {
//
//    }
//
//    public function updateContact(string $nom, string $prenom, string $email)
//    {
//
//    }

}
