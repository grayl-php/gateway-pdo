<?php

   namespace Grayl\Gateway\PDO;

   use Grayl\Gateway\Common\GatewayPorterAbstract;
   use Grayl\Gateway\PDO\Controller\PDOQueryRequestController;
   use Grayl\Gateway\PDO\Entity\PDOGatewayData;
   use Grayl\Gateway\PDO\Entity\PDOQueryRequestData;
   use Grayl\Gateway\PDO\Service\PDOGatewayService;
   use Grayl\Gateway\PDO\Service\PDOQueryRequestService;
   use Grayl\Gateway\PDO\Service\PDOQueryResponseService;
   use Grayl\Mixin\Common\Traits\StaticTrait;

   /**
    * Front-end for the PDO package
    * @method PDOGatewayData getSavedGatewayDataEntity ( string $endpoint_id )
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOPorter extends GatewayPorterAbstract
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * The name of the config file for the PDO package
       *
       * @var string
       */
      protected string $config_file = 'gateway.pdo.php';


      /**
       * Creates a new PDO object for use in a PDOGatewayData entity
       *
       * @param array $credentials An array containing all of the credentials needed to create the gateway API
       *
       * @return \PDO
       * @throws \Exception
       * @throws \PDOException
       */
      public function newGatewayAPI ( array $credentials ): object
      {

         // PDO connection options
         $options = [ \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                      \PDO::ATTR_EMULATE_PREPARES   => false, ];

         // Create the DSN connection string
         $dsn = "mysql:host=" . $credentials[ 'host' ] . ";port=" . $credentials[ 'port' ] . ";dbname=" . $credentials[ 'database' ] . ";charset=" . $credentials[ 'charset' ];

         // Return the new API entity
         return new \PDO( $dsn,
                          $credentials[ 'username' ],
                          $credentials[ 'password' ],
                          $options );
      }


      /**
       * Creates a new PDOGatewayData entity
       *
       * @param string $endpoint_id The API endpoint ID to use (typically "default" is there is only one API gateway)
       *
       * @return PDOGatewayData
       * @throws \Exception
       */
      public function newGatewayDataEntity ( string $endpoint_id ): object
      {

         // Grab the gateway service
         $service = new PDOGatewayService();

         // Get an API
         $api = $this->newGatewayAPI( $service->getAPICredentials( $this->config,
                                                                   $this->environment,
                                                                   $endpoint_id ) );

         // Configure the API as needed using the service
         $service->configureAPI( $api,
                                 $this->environment );

         // Return the gateway
         return new PDOGatewayData( $api,
                                    $this->config->getConfig( 'name' ),
                                    $this->environment );
      }


      /**
       * Creates a new PDOQueryRequestController entity
       *
       * @param string $database_id  The database ID (API endpoint ID) to use (typically "default" is there is only one API gateway)
       * @param string $action       The action performed in this response (send, etc.)
       * @param string $sql_query    The full SQL query with named placeholders
       * @param array  $placeholders An array of named placeholders aand their values for the PDO statement
       *
       * @return PDOQueryRequestController
       * @throws \Exception
       */
      public function newPDOQueryRequestController ( string $database_id,
                                                     string $action,
                                                     string $sql_query,
                                                     array $placeholders ): PDOQueryRequestController
      {

         // Create the PDOQueryRequestData entity
         $request_data = new PDOQueryRequestData( $action,
                                                  $sql_query,
                                                  $placeholders );

         // Return a new PDOQueryRequestController entity
         return new PDOQueryRequestController( $this->getSavedGatewayDataEntity( $database_id ),
                                               $request_data,
                                               new PDOQueryRequestService(),
                                               new PDOQueryResponseService() );
      }

   }