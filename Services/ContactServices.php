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
        $contactRepository = new ContactRepository();
        $contact = new Contact();
        $firstCount = $contactRepository->count();
        var_dump($firstCount);
        $contact->setNom($nom);
        $contact->setPrenom($prenom);
        $contact->setEmail($email);
        $inserToDatabase = $contactRepository->add($contact);
        $secondCount = $contactRepository->count();
        var_dump($secondCount);
        $countFinal = $contactRepository->compareCount($firstCount, $secondCount);
        return $inserToDatabase & $countFinal;
    }



    public function deleteContact()
    {
        $contactRepository = new ContactRepository();
        $deleteToDatabase = $contactRepository->delete(7);
        return $deleteToDatabase;
    }
//
//    public function updateContact(string $nom, string $prenom, string $email)
//    {
//
//    }

    public function getLastRow()
    {
        $contactRepository = new ContactRepository();
        $lastRow = $contactRepository->getLastRow();
        return $lastRow;
    }

    public function findAll()
    {
        $contactRepository = new ContactRepository();
        $allContact = $contactRepository->findAll();
        return $allContact;
    }
}
