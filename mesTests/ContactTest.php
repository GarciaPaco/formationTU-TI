<?php

require_once "Services/ContactServices.php";
require_once "Entity/Contact.php";
use Services\ContactServices;
use PHPUnit\Framework\TestCase;
class ContactTest extends TestCase
{
    public function testCreateContact()

    {
        $contactService = new ContactServices;
        $result = $contactService->createContact("Doe", "John", "johndoe@mail.com");
        $this->assertTrue($result);
    }




}