<?php

   namespace Grayl\Gateway\PDO\Service;

   use Grayl\Gateway\Common\Service\RequestServiceInterface;
   use Grayl\Gateway\PDO\Entity\PDOGatewayData;
   use Grayl\Gateway\PDO\Entity\PDOQueryRequestData;
   use Grayl\Gateway\PDO\Entity\PDOQueryResponseData;

   /**
    * Class PDOQueryRequestService
    * The service for working with PDO API query requests
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryRequestService implements RequestServiceInterface
   {

      /**
       * Sends a PDOQueryRequestData object to the PDO gateway and returns a response
       *
       * @param PDOGatewayData      $gateway_data A configured PDOGatewayData entity to send the request through
       * @param PDOQueryRequestData $request_data The PDOQueryRequestData entity to send
       *
       * @return PDOQueryResponseData
       * @throws \Exception
       */
      public function sendRequestDataEntity ( $gateway_data,
                                              $request_data ): object
      {

         // Build the request
         $api_request = $gateway_data->getAPI();

         // Send the request
         $response = $api_request->prepare( $request_data->getSQLQuery() );

         // Execute
         $successful = $response->execute( $request_data->getPlaceholders() );

         // If there was a problem
         if ( ! $successful ) {
            // Error, no user data returned
            throw new \Exception( "Database query error" );
         }

         // Return a new response entity with the action specified
         return $this->newResponseDataEntity( $response,
                                              $gateway_data->getGatewayName(),
                                              $request_data->getAction(),
                                              [ 'last_insert_id' => $this->getLastInsertID( $gateway_data ) ] );
      }


      /**
       * Creates a new PDOQueryResponseData object to handle data returned from the gateway
       *
       * @param \PDOStatement $api_response The response array received directly from a gateway
       * @param string        $gateway_name The name of the gateway
       * @param string        $action       The action performed in this response (send, sendTemplate, etc.)
       * @param string[]      $metadata     Extra data associated with this response
       *
       * @return PDOQueryResponseData
       */
      public function newResponseDataEntity ( $api_response,
                                              string $gateway_name,
                                              string $action,
                                              array $metadata ): object
      {

         // Return a new PDOQueryResponseData entity
         return new PDOQueryResponseData( $api_response,
                                          $gateway_name,
                                          $action,
                                          $metadata[ 'last_insert_id' ] );
      }


      /**
       * Returns the last insert ID from the PDO gateway
       *
       * @param PDOGatewayData $gateway A configured PDOGatewayData entity
       *
       * @return int
       * @throws \Exception
       */
      public function getLastInsertID ( PDOGatewayData $gateway ): ?int
      {

         // Return the last insert ID
         return $gateway->getAPI()
                        ->lastInsertId();
      }

   }