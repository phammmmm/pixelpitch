<?php
require_once 'DBController.php';
class CustomerController extends DBController{

  //Customer Functions
  function getCustomerById($id){
    $sql = "SELECT * FROM customers WHERE id = '".$id."'";
    return $this->singleResult($sql);
  }
	function getCustomerByUsername($username){
		$sql = "SELECT * FROM customers WHERE username = '".$username."'";
		return $this->singleResult($sql);
	}
	function getCustomerByEmail($email){
		$sql = "SELECT * FROM customers WHERE username = '".$email."'";
		return $this->singleResult($sql);
	}
	function createNewCustomer($firstName,$lastName,$contact, $email,$address,$username,$hashed_password){
		$sql = "INSERT INTO customers (firstName, lastName, contact , email, address, username, password) VALUES ('".$firstName."','".$lastName."','".$contact."','".$email."','".$address."','".$username."','".$hashed_password."')";
		return $this->executeUpdate($sql);
  }
  function updateCustomerDetails($firstName,$lastName,$contact,$email,$address,$customerId){
		$sql = "update customers set firstName='".$firstName."', lastName='".$lastName."', contact='".$contact."', email='".$email."', address='".$address."' where id=".$customerId;
		return $this->executeUpdate($sql);
	}
	
	function updateCustomerPassword($username,$password){
		$sql = "UPDATE customers set password='".$password."' where username = '".$username."'";
		return $this->executeUpdate($sql);
	}
}