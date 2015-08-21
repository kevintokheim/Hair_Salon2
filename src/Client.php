<?php

    class Client
    {
        private $client_name;
        private $id;
        private $stylist_id;

        //Constructor
        function __construct($client_name, $id, $stylist_id)
        {
            $this->client_name = $client_name;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
        }

        //Setter
        function setClientName($new_client_name)
        {
            $this->client_name = (string) $new_client_name;
        }

        //Getter
        function getClientName()
        {
            return $this->client_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        //Save Function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO client (client_name, stylist_id)
            VALUES ('{$this->getClientName()}', {$this->getStylistId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //Static getAll Function
        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client;");
            $clients = array();
            foreach ($returned_clients as $client) {
                $client_name = $client['client_name'];
                $id = $client['id'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($client_name, $id, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        //Static deleteAll function
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM client;");
        }

        //Static Find function
        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach ($clients as $client) {
                $client_id = $client->getId();
                if ($client_id == $search_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        //Update function
        function update($new_client_name)
        {
            $GLOBALS['DB']->exec("UPDATE client
                SET client_name = '{$new_client_name}'
                WHERE id = {$this->getId()};
                ");
                $this->setClientName($new_client_name);
        }

        //Delete function
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM client WHERE id = {$this->getId()};");
        }
    }

?>
