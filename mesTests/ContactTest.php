<?php

require_once "ContactServices/ContactServices.php";
require_once "Entity/Contact.php";
require_once "Repository/ContactRepository.php";
require_once "mesClass/CountErrorException.php";
require_once "EmailServices/Email.php";
use EmailServices\EmailServices;
use ContactServices\ContactServices;
use PHPUnit\Framework\TestCase;
use Repository\ContactRepository;
use Entity\Contact;

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

//    public function testCreateSendMail()
//    {
//        $firstCount = $this->contactRepository->count();
//        $result = $this->contactServices->createContact("test", "mock", "mocktest@mail.com");
//        $secondCount = $this->contactRepository->count();
//        $this->assertTrue($result);
//        $this->assertEquals($firstCount + 1, $secondCount);
//        $stub = $this->createStub(EmailServices::class);
//        // Configure the stub.
//        $stub->method('sendEmail')
//            ->willReturn('foo');
//        // Calling $stub->sendEmail() will now return
//        // 'foo'.
//        $this->assertSame('foo', $stub->sendEmail());
//    }

    public function testEnvoiMail()
    {
        $contactService = new ContactServices();
        $contact = new Contact();
        $contact->setNom('Garcia');
        $contact->setPrenom('Paco');
        $contact->setEmail('pacogarcia@mail.com');

        $mock = $this->createMock(EmailServices::class);
        $mock->expects($this->once())
            ->method('sendEmail')
            ->with($this->equalTo('Jimmy'));

        $contactService->setMailService($mock);
        $contactService->createContact($contact,'Jimmy');

    }


//    public function testDeleteContact()
//    {
//        $result = $this->contactServices->deleteContact(1);
//        $this->assertTrue($result);
//    }

//    public function testDeleteCheckById()
//    {
//        $idBeforeDeletion = $this->contactServices->findOneById(8);
//        $result = $this->contactServices->deleteContact(8);
//        $idAfterDeletion = $this->contactServices->findOneById(8);
//        $this->assertTrue($result);
//        $this->assertNotEquals($idBeforeDeletion, $idAfterDeletion);
//    }

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

    public function testFindOneById()
    {
        $result = $this->contactServices->findOneById(10);
        $this->assertInstanceOf(Contact::class, $result);
    }

    public function testUpdateContact()
    {
        $contactBeforeUpdate = $this->contactServices->findOneById(1);
        $result = $this->contactServices->updateContact(1, "Bidule", "Truc", "trucbidule@mail.com");
        $contactAfterUpdate = $this->contactServices->findOneById(1);
        $this->assertTrue($result);
        if ($contactBeforeUpdate !== $contactAfterUpdate) {
            $this->assertNotEquals($contactBeforeUpdate, $contactAfterUpdate);
        }

    }

}
