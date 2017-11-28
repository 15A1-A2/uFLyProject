<?php

/**
 * Class InviteModel
 *
 * Everything invatation-related happens here.
 */

class InviteModel
{
  public static function inviteNewUser()
  {
    $user_email = strip_tags(Request::post('invite_email'));

		$validation_result = self::validateUserEmail($user_email);
		if (!$validation_result) {
			return false;
		}

    if (UserModel::doesEmailAlreadyExist($user_email)) {
      Session::add('feedback_negative', Text::get('FEEDBACK_USER_EMAIL_ALREADY_TAKEN'));
      return fasle;
    }

    // generate random hash for email verification (40 char string)
    $user_activation_hash = sha1(uniqid(mt_rand(), true));

    if (!self::writeNewUserToDatabase($user_email, time(), $user_activation_hash)) {
      Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_CREATION_FAILED'));
      return false; // no reason not to return false here
  }

    // get user_id of the user that has been created, to keep things clean we DON'T use lastInsertId() here
		$user_id = UserModel::getUserIdByEmail($user_email);

		if (!$user_id) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

    // send verification email
		if (RegistrationModel::sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
			Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED'));
			return true;
		}

		// if verification email sending failed: instantly delete the user
		RegistrationModel::rollbackRegistrationByUserId($user_id);
		Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_FAILED'));
		return false;
    }

  /**
   * Validates the email
   *
   * @param $user_email
   * @param $first_name
   * @param $last_name
   * @return bool
   */

  public static function completeRegistation()
 	{
    $user_password_new = Request::post('user_password_new');
    $user_password_repeat = Request::post('user_password_repeat');
    $user_id = Request::post('user_id');
    $user_activation_verification_code = Request::post('user_activation_verification_code');

    $validation_result = self::validateUserPassword($user_password_new, $user_password_repeat);

    if (!$validation_result) {
    	return false;
    }

    $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT);

    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "UPDATE users SET user_active = 1, user_activation_hash = NULL, user_password_hash = :user_password_hash
               WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash LIMIT 1";
    $query = $database->prepare($sql);
    $query->execute(array(':user_id' => $user_id, ':user_activation_hash' => $user_activation_verification_code, ':user_password_hash' => $user_password_hash));

    if ($query->rowCount() == 1) {
    	Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL'));
    	return true;
    }

    Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_ACTIVATION_FAILED'));
    return false;
 	}

  public static function validateUserEmail($user_email)

  {
    if (empty($user_email)) {
        Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
        return false;
    }

    // validate the email with PHP's internal filter
    // side-fact: Max length seems to be 254 chars
    // @see http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
        return false;
    }
    return true;
  }

  public static function validateUserPassword($user_password_new, $user_password_repeat)
	{
      if (empty($user_password_new) OR empty($user_password_repeat)) {
          Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_FIELD_EMPTY'));
          return false;
      }

      if ($user_password_new !== $user_password_repeat) {
          Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_REPEAT_WRONG'));
          return false;
      }

      if (strlen($user_password_new) < 6) {
          Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_TOO_SHORT'));
          return false;
      }

      return true;
  }

    /**
  * checks the email/verification code combination and set the user's activation status to true in the database
  *
  * @param int $user_id user id
  * @param string $user_activation_verification_code verification token
  *
  * @return bool success status
  */

  public static function verifyNewUser($user_id, $user_activation_verification_code)
  {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "UPDATE users SET user_active = 1, user_activation_hash = NULL
                WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash LIMIT 1";
    $query = $database->prepare($sql);
    $query->execute(array(':user_id' => $user_id, ':user_activation_hash' => $user_activation_verification_code));

    if ($query->rowCount() == 1) {
      Session::add('feedback_positive', Text::get('FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL'));
      return true;
    }

    Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_ACTIVATION_FAILED'));
    return false;
  }

  /**
	 * Sends the verification email (to confirm the account).
	 * The construction of the mail $body looks weird at first, but it's really just a simple string.
	 *
	 * @param int $user_id user's id
	 * @param string $user_email user's email
	 * @param string $user_activation_hash user's mail verification hash string
	 *
	 * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
	 */
	public static function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
	{
		$body = Config::get('EMAIL_VERIFICATION_CONTENT') . Config::get('URL') . Config::get('EMAIL_VERIFICATION_URL')
		        . '/' . urlencode($user_id) . '/' . urlencode($user_activation_hash);

		$mail = new Mail;
		$mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_VERIFICATION_FROM_EMAIL'),
			Config::get('EMAIL_VERIFICATION_FROM_NAME'), Config::get('EMAIL_VERIFICATION_SUBJECT'), $body
		);

		if ($mail_sent) {
			Session::add('feedback_positive', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL'));
			return true;
		} else {
			Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR') . $mail->getError() );
			return false;
		}
	}

  /**
 * Writes the new user's data to the database
 *
 * @param $user_email
 * @param $user_creation_timestamp
 * @param $user_activation_hash
 *
 * @return bool
 */
 public static function writeNewUserToDatabase($user_email, $user_creation_timestamp, $user_activation_hash)
 {
   $database = DatabaseFactory::getFactory()->getConnection();

   // write new users data into database
   $sql = "INSERT INTO users (user_email, user_name, user_creation_timestamp, user_activation_hash, user_provider_type)
                   VALUES (:user_email, :user_name, :user_creation_timestamp, :user_activation_hash, :user_provider_type)";
   $query = $database->prepare($sql);
   $query->execute(array(':user_email' => $user_email,
                         'user_name' => $user_email,
                         ':user_creation_timestamp' => $user_creation_timestamp,
                         ':user_activation_hash' => $user_activation_hash,
                         ':user_provider_type' => 'DEFAULT'));
   $count =  $query->rowCount();

   if ($count == 1) {
     return true;
   }

   return false;
 }

 /**
  * Deletes the user from users table. Currently used to rollback a registration when verification mail sending
  * was not successful.
  *
  * @param $user_id
  */
 public static function rollbackRegistrationByUserId($user_id)
 {
   $database = DatabaseFactory::getFactory()->getConnection();

   $query = $database->prepare("DELETE FROM users WHERE user_id = :user_id");
   $query->execute(array(':user_id' => $user_id));
 }

}