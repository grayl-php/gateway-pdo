<?php

   namespace Grayl\Gateway\PDO\Entity;

   use Grayl\Gateway\Common\Entity\GatewayDataAbstract;

   /**
    * Class PDOGatewayData
    * The entity for the PDO API
    * @method void __construct( \PDO $api, string $gateway_name, string $environment )
    * @method void setAPI( \PDO $api )
    * @method \PDO getAPI()
    *
    * @package Grayl\Gateway\PDO
    */
   class PDOGatewayData extends GatewayDataAbstract
   {

      /**
       * Fully configured PDO entity
       *
       * @var \PDO
       */
      protected $api;

   }