<?php

   namespace Grayl\Gateway\PDO\Entity;

   use Grayl\Gateway\Common\Entity\ResponseDataAbstract;

   /**
    * Class PDOQueryResponseData
    * The class for working with a query response from the PDO gateway
    * @method void setAPIResponse( \PDOStatement $api_response )
    * @method \PDOStatement getAPIResponse()
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryResponseData extends ResponseDataAbstract
   {

      /**
       * The raw API response entity from the gateway
       *
       * @var \PDOStatement
       */
      protected $api_response;

      /**
       * The last insert ID from the PDO gateway
       *
       * @var ?int
       */
      private ?int $last_insert_id;


      /**
       * Class constructor
       *
       * @param \PDOStatement $api_response   The raw response received from a gateway
       * @param string        $gateway_name   The name of the gateway
       * @param string        $action         The action performed in this response (send, etc.)
       * @param ?int          $last_insert_id The last insert ID from the PDO gateway
       */
      public function __construct ( $api_response,
                                    string $gateway_name,
                                    string $action,
                                    ?int $last_insert_id )
      {

         // Call the parent constructor
         parent::__construct( $api_response,
                              $gateway_name,
                              $action );

         // Set the class data
         $this->setLastInsertID( $last_insert_id );
      }


      /**
       * Sets the last insert ID
       *
       * @param ?int $last_insert_id The last insert ID from the PDO gateway
       */
      public function setLastInsertID ( ?int $last_insert_id ): void
      {

         // Set the last insert ID
         $this->last_insert_id = $last_insert_id;
      }


      /**
       * Returns the last insert ID
       *
       * @return ?int
       */
      public function getLastInsertID (): ?int
      {

         // Return the last insert ID
         return $this->last_insert_id;
      }

   }