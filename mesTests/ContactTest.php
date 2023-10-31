<?php

require_once "Services/ContactServices.php";
require_once "Entity/Contact.php";
require_once "Repository/ContactRepository.php";
require_once "mesClass/CountErrorException.php";

use Services\ContactServices;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testCreateContact()
    {
        $contactService = new ContactServices;
        // $this->expectException(\Exception\CountErrorException::class);
        $result = $contactService->createContact("Doe", "John", "johndoe@mail.com");
        $this->assertTrue($result);
    }


    public function testDeleteContact()
    {
        $contactService = new ContactServices;
        $result = $contactService->deleteContact();
        $this->assertTrue($result);
    }

    public function testGetLastRow()
    {
        $contactService = new ContactServices;
        $result = $contactService->getLastRow();
        $this->assertIsArray($result);
    }

    public function testDisplayAllContact()
    {
        $contactServices = new ContactServices;
        $result = $contactServices->findAll();
        $this->assertIsArray($result);
    }


}
