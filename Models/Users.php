<?php
namespace Models;
include_once "ModelBase.php";

class Users extends ModelBase
{
	public $username;
	public $password; // Protected with SHA256(SHA256($password).$salt)."*".$salt (32L SALT)
	public $salutation; // Mr. Mrs. Ms. etc
	public $displayname;
	public $email;
	public $address;
	public $fullname;
	public $phone;
	public $country; // ISO Country Code, Reference: https://www.iso.org/obp/ui/#search
	public $creationDate;
	public $openid;
	public $isAdmin; // 0 = Normal Users, 1 = Editor, 255 = Site Admin etc
	public $valid;
}