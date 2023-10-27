<?php
require $_SERVER["DOCUMENT_ROOT"] . '/factory/php/usersRetrieval.php';

// interface
abstract class User {
    public $id;
    public $contactNumber;
    public $address;

    public function __construct($id, $contactNumber, $address) {
        $this->id = $id;
        $this->contactNumber = $contactNumber;
        $this->address = $address;
    }

    public function getID() {
        return $this->id;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function getAddress() {
        return $this->address;
    }
}

// concrete class A
class Customer extends User {
    public $firstName;
    public $lastName;

    public function __construct($id, $contactNumber, $address, $firstName, $lastName) {
        parent::__construct($id, $contactNumber, $address);

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }
}

// concrete class B
class Supplier extends User {
    public $companyName;

    public function __construct($id, $contactNumber, $address, $companyName) {
        parent::__construct($id, $contactNumber, $address);

        $this->companyName = $companyName;
    }

    public function getCompanyName() {
        return $this->companyName;
    }
}

// creator
class UserFactory {
    public static function getDetails(string $type) {
        $userDataRetriever = new UserDataRetriever($type);
        $userData = $userDataRetriever->getData();

        // concrete products
        if ($type === "customer" && !empty($userData)) {
            return new Customer($userData[0]['id'], $userData[0]['contact_number'], $userData[0]['address'], $userData[0]['first_name'], $userData[0]['last_name']);
        } elseif ($type === "supplier" && !empty($userData)) {
            return new Supplier($userData[0]['id'], $userData[0]['contact_number'], $userData[0]['address'], $userData[0]['company_name']);
        }
    }
}


