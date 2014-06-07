<?php defined('BASEPATH') OR exit('No direct script access allowed');



// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Rest_Server extends REST_Controller
{
	protected $builtInMethods;
	
	public function __construct()
	{
		parent::__construct();
		$this->__getMyMethods();
	}
	

	private function __getMyMethods()
	{
		$reflection = new ReflectionClass($this);
		
		//get all methods
		$methods = $reflection->getMethods();
		$this->builtInMethods = array();
		
		//get properties for each method
		if(!empty($methods))
		{
			foreach ($methods as $method) {
				if(!empty($method->name))
				{
					$methodProp = new ReflectionMethod($this, $method->name);
					
					//saves all methods names found
					$this->builtInMethods['all'][] = $method->name;
					
					//saves all private methods names found
					if($methodProp->isPrivate()) 
					{
						$this->builtInMethods['private'][] = $method->name;
					}
					
					//saves all private methods names found					
					if($methodProp->isPublic()) 
					{
						$this->builtInMethods['public'][] = $method->name;
						
						// gets info about the method and saves them. These info will be used for the xmlrpc server configuration.
						// (only for public methods => avoids also all the public methods starting with '_')
						if(!preg_match('/^_/', $method->name, $matches))
						{
							//consider only the methods having "_" inside their name
							if(preg_match('/_/', $method->name, $matches))
							{	
								//don't consider the methods get_instance and validation_errors
								if($method->name != 'get_instance' AND $method->name != 'validation_errors')
								{
									// -method name: user_get becomes [GET] user
									$name_split = explode("_", $method->name);
									$this->builtInMethods['functions'][$method->name]['function'] = $name_split['0'].' [method: '.$name_split['1'].']';
									
									// -method DocString
									$this->builtInMethods['functions'][$method->name]['docstring'] =  $this->__extractDocString($methodProp->getDocComment());
								}
							}
						}
					}
				}
			}
		} else {
			return false;
		}
		return true;
	}	
	

	private function __extractDocString($DocComment)
	{
		$split = preg_split("/\r\n|\n|\r/", $DocComment);
		$_tmp = array();
		foreach ($split as $id => $row)
		{
			//clean up: removes useless chars like new-lines, tabs and *
			$_tmp[] = trim($row, "* /\n\t\r");
		}			
		return trim(implode("\n",$_tmp));
	}

	public function API_get()
	{
		$this->response($this->builtInMethods, 200); // 200 being the HTTP response code
	}
	

	function register_post() { 

			$data = array( 	'level' => $this->post('level'), 
						   	'nama' => $this->post('nama'), 
						   	'username' => $this->post('username'), 
						   	'password' => $this->post('password'),
						   	'status' => $this->post('status')
						);   

			if($this->get('svaha')==1){ 
				$query = $this->model_user->insert_user($data); 
			} 
			if($query) { $this->response($query, 200); 
			} 
			else 
				{ 
					$this->response($query, 404); // 200 being the HTTP response code 
				} 
		}

		


		function login_post()
    	{
    	$username = $this->input->post('username');
       	$password = $this->input->post('password');
        $result = $this->model_user->ambilPengguna($username, $password, 1/*, $level*/);
        if($result->num_rows() <> 0) {
			
	         
	        if($result) 
	        	{ 
	        		
	        		$this->response($query, 200); 
				} 
				else 
					{ 
						$this->response($query, 404); // 200 being the HTTP response code 
					} 
         
    	}

		}


		function alluser_get() {  
			
			$query = $this->model_user->get_alluser();   
			if($query) { $this->response($query, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		} 


function matkul_get() {  
			
			$query = $this->model_matkul->tampil_matkul();   
			if($query) { $this->response($query, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		} 
		
	




	/**
		Dibawah contoh semua
	**/
	public function helloWorld_get()
	{
		$words = array('Hello', 'World', 'and', 'everybody else');
		$this->response($words, 200); // 200 being the HTTP response code
	}
	
	/**
	 * 
	 * Test method meant to be used by developers to test the REST client side.
	 * Returns a multiple array as response. It's interesting to see how the response must be wrapped into several arrays as
	 * described in the CI2 documentation http://codeigniter.com/user_guide/libraries/xmlrpc.html.
	 * Requires authentication.
	 * @return array	Array with 2 items each one composed by 4 items
	 */	
	public function contacts_get()
	{
		$contacts[] = array(
				'first_name' => 'John',
				'last_name' => 'Doe',
				'member_id' => '123435');
		
		$contacts[] = array(
				'first_name' => 'Robert',
				'last_name' => 'Doe',
				'member_id' => '123435');
		
		$this->response($contacts, 200); // 200 being the HTTP response code		
	}
	
	/**
	 * 
	 * Returns user's data
	 * @param int id	User ID
	 * @return array
	 */
	public function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        $user = $this->model_user->get_alluser_detail( $this->get('id') );
    	
    	/*
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!'),
		);
		
    	$user = @$users[$this->get('id')];

    	*/
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
	/**
	 * 
	 * Returns user's data
	 * @param int id	User ID
	 * @return array
	 */
    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    /**
     * 
     * Performs fake user deletion
     * @param int id	User ID
     * @return string
     */
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
	/**
	 * 
	 * Returns users' data
	 * @return array
	 */
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com'),
		);
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
}