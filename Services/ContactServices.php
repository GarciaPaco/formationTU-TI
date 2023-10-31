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
        $contact->setNom($nom);
        $contact->setPrenom($prenom);
        $contact->setEmail($email);
        $inserToDatabase = $contactRepository->add($contact);
        return $inserToDatabase;
    }



    public function deleteContact(int $id)
    {
        $contactRepository = new ContactRepository();
        $deleteToDatabase = $contactRepository->delete($id);
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

    public function findOneById(int $id)
    {
        $contactRepository = new ContactRepository();
        $contact = $contactRepository->getContactById($id);
        return $contact;
    }
}
