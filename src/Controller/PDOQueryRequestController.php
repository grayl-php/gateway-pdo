<?php

   namespace Grayl\Gateway\PDO\Controller;

   use Grayl\Gateway\Common\Controller\RequestControllerAbstract;
   use Grayl\Gateway\PDO\Entity\PDOQueryRequestData;
   use Grayl\Gateway\PDO\Entity\PDOQueryResponseData;

   /**
    * Class PDOQueryRequestController
    * The controller for working with PDOQueryRequestData entities
    * @method PDOQueryRequestData getRequestData()
    * @method PDOQueryResponseController sendRequest()
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryRequestController extends RequestControllerAbstract
   {

      /**
       * Creates a new PDOQueryResponseController to handle data returned from the gateway
       *
       * @param PDOQueryResponseData $response_data The PDOQueryResponseData entity received from the gateway
       *
       * @return PDOQueryResponseController
       */
      public function newResponseController ( $response_data ): object
      {

         // Return a new PDOQueryResponseController entity
         return new PDOQueryResponseController( $response_data,
                                                $this->response_service );
      }

   }