<?php

namespace Config;

/**
 * PHPAuth Config class
 */

class Auth extends \Arifrh\Auth\Config\Auth
{
	/**
	 * Site Language
	 *
	 * @var string $siteLang
	 */
	public $siteLang = 'id';

	/**
	 * Use validation for password strengh?
	 *
	 * @var boolean $validatePasswordStrength
	 */
	public $validatePasswordStrength = false;

	/**
	 * If use validatePasswordStrength, then set passwordMinScore
	 *
	 * @var int $passwordMinScore
	 */
	public $passwordMinScore = 3;

	/**
	 * Minimal Password length
	 *
	 * @var int $passwordMinLength
	 */
	public $passwordMinLength = 3;

	/**
	 * Cost used in Bcript
	 *
	 * @var int $bcryptCost
	 */
	public $bcryptCost = 10;

	/**
	 * By default, login is using email address
	 * This setting will allow to login using LoginID
	 *
	 * @var boolean $enableLoginID
	 */
	public $enableLoginID = true;

	/**
	 * If $enableLoginID set to true, then must set this loginID
	 * the real loginID can be username, loginID, userID, etc.
	 *
	 * @var string $loginID
	 */
	public $loginID = 'username';
}