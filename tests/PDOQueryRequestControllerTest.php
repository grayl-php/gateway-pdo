<?php

   namespace Grayl\Test\Gateway\PDO;

   use Grayl\Gateway\PDO\Controller\PDOQueryRequestController;
   use Grayl\Gateway\PDO\Controller\PDOQueryResponseController;
   use Grayl\Gateway\PDO\Entity\PDOGatewayData;
   use Grayl\Gateway\PDO\PDOPorter;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the PDO package
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryRequestControllerTest extends TestCase
   {

      /**
       * Test setup for sandbox environment
       */
      public static function setUpBeforeClass (): void
      {

         // Change the PDO API to sandbox mode
         PDOPorter::getInstance()
                  ->setEnvironment( 'sandbox' );
      }


      /**
       * Tests the creation of a PDOGatewayData object
       *
       * @return PDOGatewayData
       * @throws \Exception
       */
      public function testCreatePDOGatewayData (): PDOGatewayData
      {

         // Create the object
         $gateway = PDOPorter::getInstance()
                             ->getSavedGatewayDataEntity( 'default' );

         // Check the type of object returned
         $this->assertInstanceOf( PDOGatewayData::class,
                                  $gateway );

         // Return the object
         return $gateway;
      }


      /**
       * Tests the creation of a PDOQueryRequestController object
       *
       * @return PDOQueryRequestController
       * @throws \Exception
       */
      public function testCreatePDOQueryRequestController (): PDOQueryRequestController
      {

         // Create the object
         $request = PDOPorter::getInstance()
                             ->newPDOQueryRequestController( 'default',
                                                             'select',
                                                             'SELECT * FROM `pdo_test_table` WHERE `value`=:value',
                                                             [ 'value' => 'yes' ] );

         // Check the type of object returned
         $this->assertInstanceOf( PDOQueryRequestController::class,
                                  $request );

         // Return the object
         return $request;
      }


      /**
       * Tests the sending of a PDOQueryRequestData through a PDOQueryRequestController
       *
       * @param PDOQueryRequestController $request A configured PDOQueryRequestController entity to send
       *
       * @depends testCreatePDOQueryRequestController
       * @return PDOQueryResponseController
       * @throws \Exception
       */
      public function testSendPDOQueryRequestController ( PDOQueryRequestController $request ): PDOQueryResponseController
      {

         // Send the request using the gateway
         $response = $request->sendRequest();

         // Check the type of object returned
         $this->assertInstanceOf( PDOQueryResponseController::class,
                                  $response );

         // Return the response
         return $response;
      }


      /**
       * Checks a PDOQueryResponseController for data and errors
       *
       * @param PDOQueryResponseController $response A PDOQueryResponseController returned from the gateway
       *
       * @depends testSendPDOQueryRequestController
       */
      public function testPDOQueryResponseController ( PDOQueryResponseController $response ): void
      {

         // Test the data
         $this->assertTrue( $response->isSuccessful() );

         // Test the result count
         $this->assertGreaterThan( 0,
                                   $response->countRows() );

         // Get a row as an array
         $row = $response->fetchNextRowAsArray();

         // Test the data
         $this->assertNotNull( $row[ 'value' ] );

         // Fetch the next row as an object
         $row = $response->fetchNextRowAsObject();

         // Test the data
         $this->assertNotNull( $row->value );
      }

   }