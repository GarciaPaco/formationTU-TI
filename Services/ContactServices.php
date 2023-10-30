<?php

namespace Services;
require_once "Repository/ContactRepository.php";
require_once "Entity/Contact.php";

use Entity\Contact;
use Exception\CountErrorException;
use Repository\ContactRepository;

class ContactServices
{


    public function createContact(string $nom, string $prenom, string $email)
    {
        $contact = new Contact();
        $contactRepository = new ContactRepository();
        $firstCount = $contactRepository->count();
        $contact->setNom($nom);
        $contact->setPrenom($prenom);
        $contact->setEmail($email);
        $secondCount = $contactRepository->count();
        $countFinal = $contactRepository->compareCount($firstCount, $secondCount);
        $inserToDatabase = $contactRepository->add($contact);
        return $inserToDatabase & $countFinal;
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
