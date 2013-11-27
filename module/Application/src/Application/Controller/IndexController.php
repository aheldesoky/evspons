<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Zend\Session\Storage\ArrayStorage;
use Zend\Session\SessionManager;


class IndexController extends AbstractActionController
{
	protected $em;
	
	public function setEntityManager(EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function getEntityManager()
	{
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}
		return $this->em;
	}
	
	public function indexAction()
    {
    	$viewModel = new ViewModel();
    	$viewModel->setTerminal(true);
    	return $viewModel;
    }
    
    public function userAction()
    {
    	return new ViewModel();
    }
    
    public function signupAction()
    {    	
    	$objectManager = $this->getEntityManager();
    	
    	$user = new \Application\Entity\User();
    	$user->populate($_POST);
    	
    	//\Zend\Debug\Debug::dump($user);die;
    	
    	$objectManager->persist($user);
    	$objectManager->flush();
    	
    	return new ViewModel();
    }
    
    public function signinAction()
    {
    	$manager = new SessionManager();
    	$qb = $this->getEntityManager()->createQueryBuilder();
    	
    	$params = new ArrayCollection(array(
    			new Parameter('email', $_POST['email']),
    			new Parameter('password', $_POST['password'])
    	));
    	
    	$qb ->select('u.u_id, u.u_email, u.u_fname, u.u_lname, u.u_regdate')
    		->from('Application\Entity\User' , 'u')
    		->where('u.u_email=:email AND u.u_password=:password')
    		->setParameters($params);
    	
    	$query = $qb->getQuery();
    	
    	$user = $query->getResult();
    	
    	if(count($user)){
    		//$this->view->user = $user;
    		
    		$storage = new ArrayStorage($user);
    		$manager->setStorage($storage);
    		
    	} else {
    		
    	}
    	
    	/*
    	$serviceLocator = $this->getServiceLocator();
    	$adapter = $serviceLocator->get('doctrine.authenticationadapter.orm_default');
    	$adapter->setIdentityValue($_POST['email']);
    	$adapter->setCredentialValue($_POST['password']);
    	$authService = new \Zend\Authentication\AuthenticationService();
    	$result = $authService->authenticate($adapter);
    	*/
    	\Zend\Debug\Debug::dump($manager->getStorage()->toArray());die;
    	
    }
    
    public function profileAction(){
    	$viewModel = new ViewModel();
    	$viewModel->setTemplate("layout/profile");
    	
    	return $viewModel;
    }
    
}
