<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class User {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $u_id;
	
	/** @ORM\Column(type="string") */
	protected $u_email;
	
	/** @ORM\Column(type="string") */
	protected $u_password;
	
	/** @ORM\Column(type="string") */
	protected $u_fname;
	
	/** @ORM\Column(type="string") */
	protected $u_lname;
	
	/** @ORM\Column(type="datetime") */
	protected $u_regdate;

	// getters/setters
	
	/**
	 * Magic getter to expose protected properties.
	 *
	 * @param string $property
	 * @return mixed
	 */
	public function __get($property)
	{
		return $this->$property;
	}
	
	/**
	 * Magic setter to save protected properties.
	 *
	 * @param string $property
	 * @param mixed $value
	 */
	public function __set($property, $value)
	{
		$this->$property = $value;
	}
	
	/**
	 * Convert the object to an array.
	 *
	 * @return array
	 */
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	/**
	 * Populate from an array.
	 *
	 * @param array $data
	 */
	public function populate($data = array())
	{
		$this->u_id = $data['id'];
		$this->u_fname = $data['fname'];
		$this->u_lname = $data['lname'];
		$this->u_email = $data['email'];
		$this->u_password = $data['password'];
		$this->u_regdate = $data['regdate'];
	}
	
}