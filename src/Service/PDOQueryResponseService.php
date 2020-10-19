<?php

   namespace Grayl\Gateway\PDO\Service;

   use Grayl\Gateway\Common\Service\ResponseServiceInterface;
   use Grayl\Gateway\PDO\Entity\PDOQueryResponseData;

   /**
    * Class PDOQueryResponseService
    * The service for working with PDO API query responses
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOQueryResponseService implements ResponseServiceInterface
   {

      /**
       * Returns a true / false value based on a gateway API response
       *
       * @param PDOQueryResponseData $response_data The response object to check
       *
       * @return bool
       */
      public function isSuccessful ( $response_data ): bool
      {

         // Success by default if a response was created
         return true;
      }


      /**
       * Returns the reference ID from a gateway API response
       *
       * @param PDOQueryResponseData $response_data The response object to pull the reference ID from
       *
       * @return string
       */
      public function getReferenceID ( $response_data ): ?string
      {

         // Return the last insert ID
         return $response_data->getLastInsertID();
      }


      /**
       * Returns the status message from a gateway API response
       *
       * @param PDOQueryResponseData $response_data The response object to get the message from
       *
       * @return string
       */
      public function getMessage ( $response_data ): ?string
      {

         // Get the PDOStatement error info
         $error_info = $response_data->getAPIResponse()
                                     ->errorInfo();

         // If there is an error
         if ( ! empty( $error_info[ 0 ] ) && ! empty( $error_info[ 2 ] ) ) {
            // Return the error message
            return $error_info[ 2 ];
         }

         // No message
         return null;
      }


      /**
       * Returns the raw data from a gateway API response
       *
       * @param PDOQueryResponseData $response_data The response object to get the data from
       *
       * @return string
       */
      public function getData ( $response_data )
      {

         // Not used
         return null;
      }


      /**
       * Fetches the next result of a PDOQueryResponseData as an associative array
       *
       * @param PDOQueryResponseData $response_data The response object to fetch rows from
       *
       * @return array
       * @throws \PDOException
       */
      public function fetchNextRowAsArray ( $response_data ): ?array
      {

         // Fetch the row
         $row = $response_data->getAPIResponse()
                              ->fetch( \PDO::FETCH_ASSOC );

         // If the row wasn't empty, return it
         if ( ! empty ( $row ) ) {
            // Return the row
            return $row;
         }

         // Nothing found (PDO service returns boolean false)
         return null;
      }


      /**
       * Fetches all results of a PDOQueryResponseData as an array of associative arrays
       *
       * @param PDOQueryResponseData $response_data The response object to fetch rows from
       *
       * @return array[]
       * @throws \PDOException
       */
      public function fetchAllRowsAsArray ( $response_data ): ?array
      {

         // Fetch the rows
         $rows = $response_data->getAPIResponse()
                               ->fetchAll( \PDO::FETCH_ASSOC );

         // If the rows weren't empty, return them
         if ( ! empty ( $rows ) ) {
            // Return the row
            return $rows;
         }

         // Nothing found (PDO service returns boolean false)
         return null;
      }


      /**
       * Fetches the next result of a PDOQueryResponseData as an object
       *
       * @param PDOQueryResponseData $response_data The response object to fetch rows from
       *
       * @return \stdClass
       * @throws \PDOException
       */
      public function fetchNextRowAsObject ( $response_data ): ?\stdClass
      {

         // Fetch the row
         $row = $response_data->getAPIResponse()
                              ->fetchObject();

         // If the row wasn't empty, return it
         if ( ! empty ( $row ) ) {
            // Return the row
            return $row;
         }

         // Nothing found (PDO service returns boolean false)
         return null;
      }


      /**
       * Fetches all results of a PDOQueryResponseData as an array of objects
       *
       * @param PDOQueryResponseData $response_data The response object to fetch rows from
       *
       * @return \stdClass[]
       * @throws \PDOException
       */
      public function fetchAllRowsAsObject ( $response_data ): ?array
      {

         // Fetch the rows
         $rows = $response_data->getAPIResponse()
                               ->fetchAll( \PDO::FETCH_OBJ );

         // If the rows weren't empty, return them
         if ( ! empty ( $rows ) ) {
            // Return the row
            return $rows;
         }

         // Nothing found (PDO service returns boolean false)
         return null;
      }


      /**
       * Returns the number of rows affected by the SQL statement
       *
       * @param PDOQueryResponseData $response_data The response object to count rows from
       *
       * @return int
       * @throws \PDOException
       */
      public function countRows ( $response_data ): int
      {

         // Return the count
         return $response_data->getAPIResponse()
                              ->rowCount();
      }

   }