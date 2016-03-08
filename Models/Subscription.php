<?php
namespace Models;
include_once "ModelBase.php";

class Subscription extends ModelBase
{
	public $uid;
    public $plan; // 0 = Digital Subscription, 1 = Print Subscription, 2 = Corporate Subscription
	public $refer; // -1 = No Refer, UID = Paid by Referal
	public $paymentDate;
	public $expireDate;
	public $promoCode;
	public $price;
	public $paymentMethod; // 0 = VISA, 1 = MasterCard, 2 = American Express, 3 = Cheques
	public $invoiceID; // Invoice ID from 3rd Party Payment Platform (Preserved)
}