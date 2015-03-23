<?php

class UserController extends ControllerSecureLib
{
    
    public function __construct($public_views = array())
    {
        $public_views[] = 'login';
        $public_views[] = 'create';
        parent::__construct($public_views);
    }


    public function index() {
			$this->errors = array();
    }

    public function login($type = null) {
			$this->errors = array();

			if(RoutingLib::isPost()) {
					$coll = new UsersModel();
					$post = RoutingLib::cleanPost();
					$db = DbLib::getInstance();
					$q = sprintf('SELECT * FROM %s WHERE username LIKE ? AND password IS NOT NULL LIMIT 1', $coll->tbl()); 
					$stmt = $db->prepare($q);
					$stmt->execute(array($post['username']));
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
					if($user) { 
							if(password_verify($post['password'],$user['password']))
							{
									$this->user = $coll->create($user);
									$this->setUser($this->user);

									return $this->redirect(url('user','index'));
							}
					}
					$this->errors = array('Could not find user/password ');					
        }
			$this->user = $this->getUser();
    }

    public function create() {
			if(RoutingLib::isPost()) {
					$coll = new UsersModel();
					$values = $_POST;            
					if(count($this->errors = $coll->validate($values)) == 0)
					{            
							$post = RoutingLib::cleanPost();
							$db = DbLib::getInstance();                
							$q = sprintf('SELECT * FROM %s WHERE username LIKE ? AND password IS NOT NULL LIMIT 1', $coll->tbl()); 
							$stmt = $db->prepare($q);
							$stmt->execute(array($post['username']));
							$user = $stmt->fetch(PDO::FETCH_ASSOC);
							if($user)
							{
									$this->errors = array('Cet utilisateur est déjà enregistré');
							}    
							else
							{
									$post['password'] = password_hash($post['password']);
									if(preg_match('/^(.+)@/', $post['email'], $matches)) { $post['name'] = $matches[1]; }
									//$post['site'] = '';
									$this->user = $coll->create($post);
									$this->user->save();
									$this->setUser($this->user);
									return $this->redirect(url('user','index'));
							}
					}
			}        
			//return $this->redirect(url('user','login','challenge'));
    }
    
    public function logout() {
			if(RoutingLib::isPost()) {
					$this->setUser(null);
			}
    }
    
    
}
