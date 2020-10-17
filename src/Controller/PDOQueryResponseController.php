<?php

   namespace Grayl\Gateway\PDO\Controller;

   use Grayl\Gateway\Common\Controller\ResponseControllerAbstract;
   use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
   use Grayl\Gateway\Common\Service\ResponseServiceInterface;
   use Grayl\Gateway\PDO\Entity\PDOQueryResponseData;
   use Grayl\Gateway\PDO\Service\PDOQueryResponseService;

   /**
    * Class PDOQueryResponseController
    * The controller for working with PDOQueryResponseData entities
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryResponseController extends ResponseControllerAbstract
   {

      /**
       * The PDOQueryResponseData object that holds the gateway API response
       *
       * @var PDOQueryResponseData
       */
      protected ResponseDataAbstract $response_data;

      /**
       * The PDOQueryResponseService entity to use
       *
       * @var PDOQueryResponseService
       */
      protected ResponseServiceInterface $response_service;


      /**
       * Fetches the next result of a PDOQueryResponseData as an array
       *
       * @return array
       * @throws \PDOException
       */
      public function fetchNextRowAsArray (): ?array
      {

         // Return the next row as an array
         return $this->response_service->fetchNextRowAsArray( $this->response_data );
      }


      /**
       * Fetches the next result of a PDOQueryResponseData as an object
       *
       * @return \stdClass
       * @throws \PDOException
       */
      public function fetchNextRowAsObject (): ?\stdClass
      {

         // Return the next row as an object
         return $this->response_service->fetchNextRowAsObject( $this->response_data );
      }


      /**
       * Fetches all results of a PDOQueryResponseData as an array
       *
       * @return array
       * @throws \PDOException
       */
      public function fetchAllAsArray (): ?array
      {

         // Return all results as an array
         return $this->response_service->fetchAllAsArray( $this->response_data );
      }


      /**
       * Returns the number of rows affected by the SQL statement
       *
       * @return int
       * @throws \PDOException
       */
      public function countRows (): int
      {

         // Return the count
         return $this->response_service->countRows( $this->response_data );
      }

   }