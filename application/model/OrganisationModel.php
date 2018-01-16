<?php

/**
 * OrganisationModel
 * Handles all the Organisation stuff. It's to add/delete domain of the organisation the admin wants in his application.
 * after a domain is added you can invite new people with that domain.
 */

class OrganisationModel
{

  public static function getAllDomainNames()
  {
    $database = DatabaseFactory::getFactory()->getConnection();

    $sql = "SELECT * FROM organisation";
    $query = $database->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  public static function addDomainName()
  {
    $domain_name = strip_tags(Request::post('domain_name'));

    $validation_result = self::validateDomainName($domain_name);
		if (!$validation_result) {
			return false;
		}

    if (self::doesDomainNameAlreadyExist($domain_name)) {
        Session::add('feedback_negative', Text::get('FEEDBACK_DOMAIN_ALREADY_TAKEN'));
        return fasle;
    }

    if (!self::writeNewDomainToDatabase($domain_name)) {
        Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_CREATION_FAILED'));
      return false; // no reason not to return false here
    } else {
        Session::add('feedback_positive', Text::get('FEEDBACK_DOMAIN_ADDED_SUCCESSFULLY'));
    }
  }


  public static function writeNewDomainToDatabase($domain_name)
  {
    $database = DatabaseFactory::getFactory()->getConnection();

    // write new domain data into database
    $sql = "INSERT INTO organisation (org_name)
                    VALUES (:org_name)";
    $query = $database->prepare($sql);
    $query->execute(array(':org_name' => $domain_name));
    $count =  $query->rowCount();

    if ($count == 1) {
      return true;
    }

    return false;
  }


  public static function validateDomainName($domain_name)
  {
    if (empty($domain_name)) {
        Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
        return false;
    }

    // if (!preg_match('@', $domain_name)) {
    //   Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
    //   return false;
    // }
    return true;
  }

  public static function doesDomainNameAlreadyExist($domain_name)
  {
      $database = DatabaseFactory::getFactory()->getConnection();

      $query = $database->prepare("SELECT org_id FROM organisation WHERE org_name = :org_name LIMIT 1");
      $query->execute(array(':org_name' => $domain_name));
      if ($query->rowCount() == 0) {
          return false;
      }
      return true;
  }
}
