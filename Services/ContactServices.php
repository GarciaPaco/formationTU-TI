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

    public function updateContact(
        int     $id,
        string  $nom,
        string  $prenom,
        string  $email
    )
    {
        if (!$contact = $this->findOneById($id)) {
            throw new CountErrorException();
        }
//        $oldContact = clone $contact;
        if ($nom) {
            $contact->setNom($nom);
        }
        if ($prenom) {
            $contact->setPrenom($prenom);
        }
        if ($email && !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )) {
            throw new \InvalidArgumentException("Email invalide");
        }
        if ($email) {
            $contact->setEmail($email);
        }
//        if ($oldContact == $contact) {
//            throw new \InvalidArgumentException("Aucune modification n'a été effectuée");
//        }
        $contactRepository = new ContactRepository();
        return $contactRepository->updateContact($contact);
    }

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
