<?php

   namespace Grayl\Gateway\PDO\Config;

   use Grayl\Gateway\Common\Config\GatewayAPIEndpointAbstract;

   /**
    * Class PDOAPIEndpoint
    * The class of a single PDO API endpoint
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOAPIEndpoint extends GatewayAPIEndpointAbstract
   {

      /**
       * The database name
       *
       * @var string
       */
      protected string $database;

      /**
       * The host address
       *
       * @var string
       */
      protected string $host;

      /**
       * The host port
       *
       * @var int
       */
      protected int $port;

      /**
       * The database username
       *
       * @var string
       */
      protected string $username;

      /**
       * The database password
       *
       * @var string
       */
      protected string $password;

      /**
       * The connection charset
       *
       * @var string
       */
      protected string $charset;

      /**
       * The connection collation
       *
       * @var string
       */
      protected string $collation;


      /**
       * Class constructor
       *
       * @param string $api_endpoint_id The ID of this API endpoint (default, provision, etc.)
       * @param string $database        The database name
       * @param string $host            The host address
       * @param int    $port            The host port
       * @param string $username        The database username
       * @param string $password        The database password
       * @param string $charset         The connection charset
       * @param string $collation       The connection collation
       */
      public function __construct ( string $api_endpoint_id,
                                    string $database,
                                    string $host,
                                    int $port,
                                    string $username,
                                    string $password,
                                    string $charset,
                                    string $collation )
      {

         // Call the parent constructor
         parent::__construct( $api_endpoint_id );

         // Set the class data
         $this->setDatabase( $database );
         $this->setHost( $host );
         $this->setPort( $port );
         $this->setUsername( $username );
         $this->setPassword( $password );
         $this->setCharset( $charset );
         $this->setCollation( $collation );
      }


      /**
       * Gets the database
       *
       * @return string
       */
      public function getDatabase (): string
      {

         // Return it
         return $this->database;
      }


      /**
       * Sets the database
       *
       * @param string $database The database name
       */
      public function setDatabase ( string $database ): void
      {

         // Set the database
         $this->database = $database;
      }


      /**
       * Gets the host
       *
       * @return string
       */
      public function getHost (): string
      {

         // Return it
         return $this->host;
      }


      /**
       * Sets the host
       *
       * @param string $host The host address
       */
      public function setHost ( string $host ): void
      {

         // Set the host
         $this->host = $host;
      }


      /**
       * Gets the port
       *
       * @return int
       */
      public function getPort (): int
      {

         // Return it
         return $this->port;
      }


      /**
       * Sets the port
       *
       * @param int $port The host port
       */
      public function setPort ( int $port ): void
      {

         // Set the port
         $this->port = $port;
      }


      /**
       * Gets the username
       *
       * @return string
       */
      public function getUsername (): string
      {

         // Return it
         return $this->username;
      }


      /**
       * Sets the username
       *
       * @param string $username The database username
       */
      public function setUsername ( string $username ): void
      {

         // Set the username
         $this->username = $username;
      }


      /**
       * Gets the password
       *
       * @return string
       */
      public function getPassword (): string
      {

         // Return it
         return $this->password;
      }


      /**
       * Sets the password
       *
       * @param string $password The database password
       */
      public function setPassword ( string $password ): void
      {

         // Set the password
         $this->password = $password;
      }


      /**
       * Gets the charset
       *
       * @return string
       */
      public function getCharset (): string
      {

         // Return it
         return $this->charset;
      }


      /**
       * Sets the charset
       *
       * @param string $charset The connection charset
       */
      public function setCharset ( string $charset ): void
      {

         // Set the charset
         $this->charset = $charset;
      }


      /**
       * Gets the collation
       *
       * @return string
       */
      public function getCollation (): string
      {

         // Return it
         return $this->collation;
      }


      /**
       * Sets the collation
       *
       * @param string $collation The connection collation
       */
      public function setCollation ( string $collation ): void
      {

         // Set the collation
         $this->collation = $collation;
      }

   }