<?php

   namespace Grayl\Gateway\PDO\Entity;

   use Grayl\Gateway\Common\Entity\RequestDataAbstract;
   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Class PDOQueryRequestData
    * The entity for a query request to PDO
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryRequestData extends RequestDataAbstract
   {

      /**
       * The full SQL query with named placeholders
       *
       * @var string
       */
      private string $sql_query;

      /**
       * An array of named placeholders and their values
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $placeholders;


      /**
       * Class constructor
       *
       * @param string $action       The action performed in this request (send, etc.)
       * @param string $sql_query    The full SQL query with named placeholders
       * @param array  $placeholders An array of named placeholders and their values for the PDO statement
       */
      public function __construct ( string $action,
                                    string $sql_query,
                                    array $placeholders )
      {

         // Call the parent constructor
         parent::__construct( $action );

         // Create the placeholder bag
         $this->placeholders = new KeyedDataBag();

         // Set the entity data
         $this->setSQLQuery( $sql_query );
         $this->setPlaceholders( $placeholders );
      }


      /**
       * Gets the SQL query
       *
       * @return string
       */
      public function getSQLQuery (): string
      {

         // Return the SQL query
         return $this->sql_query;
      }


      /**
       * Sets the SQL query
       *
       * @param string $sql_query The full SQL query with named placeholders
       */
      public function setSQLQuery ( string $sql_query ): void
      {

         // Set the SQL query
         $this->sql_query = $sql_query;
      }


      /**
       * Retrieves the entire array of PDO placeholders
       *
       * @return array
       */
      public function getPlaceholders (): array
      {

         // Return all placeholder fields
         return $this->placeholders->getVariables();
      }


      /**
       * Sets a single PDO placeholder
       *
       * @param string $key   The key name for the field
       * @param mixed  $value The value of the field
       */
      public function setPlaceholder ( string $key,
                                       ?string $value ): void
      {

         // Set the field
         $this->placeholders->setVariable( $key,
                                           $value );
      }


      /**
       * Sets multiple placeholders using a passed array
       *
       * @param string[] $placeholders The associative array of fields to set ( key => value )
       */
      public function setPlaceholders ( array $placeholders ): void
      {

         // Set the fields
         $this->placeholders->setVariables( $placeholders );
      }

   }