<?php

require_once "Services/ContactServices.php";
require_once "Entity/Contact.php";
require_once "Repository/ContactRepository.php";
require_once "mesClass/CountErrorException.php";

use Services\ContactServices;
use PHPUnit\Framework\TestCase;
use Repository\ContactRepository;

class ContactTest extends TestCase
{
    private ContactServices $contactServices;
    private ContactRepository $contactRepository;
    public function setUp(): void
    {
        $this->contactServices = new ContactServices();
        $this->contactRepository = new ContactRepository();
    }
    public function testCreateContact()
    {
        $firstCount = $this->contactRepository->count();
        $result = $this->contactServices->createContact("Doe", "John", "johndoe@mail.com");
        $secondCount = $this->contactRepository->count();
        $this->assertTrue($result);
        $this->assertEquals($firstCount + 1, $secondCount);
    }


    public function testDeleteContact()
    {
        $result = $this->contactServices->deleteContact();
        $this->assertTrue($result);
    }

    public function testGetLastRow()
    {
        $result = $this->contactServices->getLastRow();
        $this->assertIsArray($result);
    }

    public function testDisplayAllContact()
    {
        $result = $this->contactServices->findAll();
        $this->assertIsArray($result);
    }



}
