<?php
define('REST_SERVER', 'http://backend.local');
define('REST_PORT', $_SERVER['SERVER_PORT']);

class Menu extends MY_Model {

	// constructor
	function __construct()
	{
		parent::__construct();
                
                //load REST Lib
                $this->load->library(['curl', 'format', 'rest']);
	}
        
        // Return all records in an array
        function all() 
        {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            return $this->rest->get('/maintenance');
        }
        
        // Retrieve an existing dB record
        function get($key, $key2 = null)
        {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            return $this->rest->get('/maintenance/item/id/' . $key);
        }
        
        // Create new empty object that then can be populated
        function create()
        {
            $names = ['id', 'name', 'description', 'price', 'picture', 'category'];
            $object = new StdClass;
            foreach ($names as $name) {
                $object->$name = "";
            }
            return $object;
        }
        
        // Delete record from the dB
        function delete($key, $key2 = null) 
        {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            return $this->rest->delete('/maintenance/item/id/' . $key);
        }
        
        // Determine if key exists
        function exists($key, $key2 = null)
        {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $result = $this->rest->get('/maintenance/item/id/' . $key);
            return ! empty($result);
        }
        
        // Update a record in dB
        function update($record)
        {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $retrieved = $this->rest->put('/maintenance/item/id/'. $record['code'], $record);
        }
        
        // Add a recod to the dB
        function add($record)
        {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $retrieved = $this->rest->post('/maintenance/item/id/'. $record['code'], $record);
        }

}
