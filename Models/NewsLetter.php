<?php
namespace Models;
include_once "ModelBase.php";

class NewsLetter extends ModelBase
{
    public $uid;
	public $breaking;	// SCMP Today and Breaking News Alerts
	public $internation;	// SCMP Today International
	public $tech;	// Tech Wrap
	public $china;	// China at a glance
	public $lifestyle;	// Life Style
	public $luxe;	// LuxeHomes
	public $chns;	// SCMP Chinese - Simplified
	public $chnt;	// SCMP Chinese - Traditional
}