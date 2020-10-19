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
         $this->assertGreaterThan( 1,
                                   $response->countRows() );

         // Get a row as an array
         $row = $response->fetchNextRowAsArray();

         // Test the data
         $this->assertNotNull( $row[ 'value' ] );

         // Fetch the next row as an object
         $row = $response->fetchNextRowAsObject();

         // Test the data
         $this->assertInstanceOf( \StdClass::class,
                                  $row );
         $this->assertNotNull( $row->value );

      }


      /**
       * Checks a PDOQueryResponseController when pulled as an array of associative arrays
       *
       * @param PDOQueryRequestController $request A PDOQueryRequestController to send to the gateway
       *
       * @depends testCreatePDOQueryRequestController
       * @throws \Exception
       */
      public function testPDOQueryResponseControllerFetchAllAsArray ( PDOQueryRequestController $request ): void
      {

         // Send the request using the gateway
         $response = $request->sendRequest();

         // Test the data
         $this->assertTrue( $response->isSuccessful() );

         // Test the result count
         $this->assertGreaterThan( 1,
                                   $response->countRows() );

         // Fetch all rows as an array
         $array_rows = $response->fetchAllRowsAsArray();

         // Test the data
         $this->assertIsArray( $array_rows[ 0 ] );
         $this->assertNotNull( $array_rows[ 0 ][ 'value' ] );
         $this->assertNotNull( $array_rows[ 1 ][ 'value' ] );

      }


      /**
       * Checks a PDOQueryResponseController when pulled as an array of objects
       *
       * @param PDOQueryRequestController $request A PDOQueryRequestController to send to the gateway
       *
       * @depends testCreatePDOQueryRequestController
       * @throws \Exception
       */
      public function testPDOQueryResponseControllerFetchAllAsObject ( PDOQueryRequestController $request ): void
      {

         // Send the request using the gateway
         $response = $request->sendRequest();

         // Test the data
         $this->assertTrue( $response->isSuccessful() );

         // Test the result count
         $this->assertGreaterThan( 1,
                                   $response->countRows() );

         // Fetch all rows as an object
         $obj_rows = $response->fetchAllRowsAsObject();

         // Test the data
         $this->assertInstanceOf( \StdClass::class,
                                  $obj_rows[ 0 ] );
         $this->assertNotNull( $obj_rows[ 0 ]->value );
         $this->assertNotNull( $obj_rows[ 1 ]->value );

      }

   }