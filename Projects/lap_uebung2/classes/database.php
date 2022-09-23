<?php
require_once('../modules/config.php');
require_once('../classes/user.php');
require_once('../classes/product.php');
require_once('../classes/role.php');
require_once('../classes/activity.php');
class Database
{
    // variable for connection, that can only be called inside the class and it's child objects
    private $mysqli;

    // the constructor gets called when a new Database-Object gets created
    public function __construct($host, $dbuser, $dbpass, $dbname)
    {
        // create a new MySQLi-Connection
        $this->mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
        if ($this->mysqli->connect_errno) {
            // error message, if the connection is unsuccessful
            die("Verbindung fehlgeschlagen: " . $this->mysqli->connect_error);
        }
    }

    // Getter
    public function getDatabase()
    {
        return $this->mysqli;
    }

    // get user object by the users email address
    public function getUserByMail($email)
    {
        // SQL-statement
        $sql = "SELECT * FROM users where email = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('s', $email);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_assoc();

        // create new user object
        $user = new User();
        // if a result was fetched from the database, fill user object with data
        if ($result) {
            $user->id = $result['id'];
            $user->firstName = $result['first_name'];
            $user->lastName = $result['last_name'];
            $user->dateOfBirth = $result['date_of_birth'];
            $user->email = $result['email'];
            $user->password = $result['password'];
            $user->street = $result['street'];
            $user->postalcode = $result['postalcode'];
            $user->houseNumber = $result['house_number'];
            $user->city = $result['city'];
            $user->roleId = $result['role_id'];
        }
        // return the user object
        return $user;
    }

    // get all products where the name includes a search string
    public function getProducts($search)
    {
        // add wildcard % at the beginning and the end of the search string
        $name = "%" . $search . "%";
        // SQL-statement
        $sql = "SELECT * FROM products WHERE lower(name) like lower(?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('s', $name);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        // create an arry that will be filled with products
        $products = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $dbProduct) {
                // create a new product object and fill it with the fetched data
                $product = new Product();
                $product->id = $dbProduct['id'];
                $product->name = $dbProduct['name'];
                $product->price = $dbProduct['price'];
                $product->userId = $dbProduct['user_id'];
                // push the product object to the products array
                array_push($products, $product);
            }
            // return the products array
            return $products;
        }
    }

    // get a product with a specific id
    public function getProductById($id)
    {
        // SQL-statement
        $sql = "SELECT * from products WHERE id in (?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('i', $id);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_assoc();

        // create a new product object
        $product = new Product();
        // // if a result was fetched from the database, fill the product object with data
        if ($result) {
            $product->id = $result['id'];
            $product->name = $result['name'];
            $product->price = $result['price'];
            $product->userId = $result['user_id'];
        }
        // return the product object
        return $product;
    }

    // update a specific product
    public function updateProductInfo($id, $name, $price, $userId)
    {
        // SQL-statement
        $sql = "UPDATE products SET name = ?, price = ?, user_id = ? where id = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('ssii', $name, $price, $userId, $id);
        // execute statement
        $query->execute();
    }

    // delete a specific product
    public function deleteProduct($id)
    {
        // SQL-statement
        $sql = "DELETE FROM products where id = ?";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('i', $id);
        // execute statement
        $query->execute();
    }

    // create a new product
    public function createProduct($name, $price, $userId)
    {
        // SQL-statement
        $sql = "INSERT INTO products (name, price, user_id) values (?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('ssi', $name, $price, $userId);
        // execute statement
        $query->execute();
    }

    // get all users
    public function getAllUsers()
    {
        // SQL-statement
        $sql = "SELECT * FROM users";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        // create a new array which will be filled with users
        $users = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $element) {
                // create a new user object and fill it with the fetched data
                $user = new User();
                $user->id = $element['id'];
                $user->firstName = $element['first_name'];
                $user->lastName = $element['last_name'];
                $user->dateOfBirth = $element['date_of_birth'];
                $user->email = $element['email'];
                $user->password = $element['password'];
                $user->street = $element['street'];
                $user->postalcode = $element['postalcode'];
                $user->houseNumber = $element['house_number'];
                $user->city = $element['city'];
                $user->roleId = $element['role_id'];
                // push the user object to the users array
                array_push($users, $user);
            }
        }
        // return the users array
        return $users;
    }

    // create a new user
    public function createUser($firstName, $lastName, $email, $dateOfBirth, $street,
        $postalcode, $houseNumber, $city, $roleId, $password) {
        // hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL-statement
        $sql = "INSERT INTO users (first_name, last_name, email, date_of_birth, street, 
            postalcode, house_number, city, role_id, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('ssssssssis', $firstName, $lastName, $email, $dateOfBirth,
            $street, $postalcode, $houseNumber, $city, $roleId, $hashedPassword);
        // execute statement
        $query->execute();
    }

    // get all roles
    public function getRoles(){
        // SQL-statement
        $sql = "SELECT * FROM roles order by id DESC";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        // create a new array which will be filled with roles
        $roles = array();
        // if the number or fetched rows is greater than 0
        if (count($result) > 0) {
            // loop through every row
            foreach ($result as $element) {
                // create a new role object and fill it with the fetched data
                $role = new Role();
                $role->id = $element['id'];
                $role->name = $element['name'];
                // push the role object to the riles array
                array_push($roles, $role);
            }
        }
        // return the roles array
        return $roles;
    }

    public function getLastActivityByType($type, $userId){
        // SQL-statement
        $sql = "SELECT * FROM activities WHERE type = ? and user_id = ? ORDER BY time_stamp DESC LIMIT 1";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
         // bind parameters to statement
         $query->bind_param('ii', $type, $userId);
        // execute statement
        $query->execute();
        // get the result of the query
        $result = $query->get_result()->fetch_assoc();

        // create a new activity object and fill it with the fetched data
        $activity = new Activity();
        if($result){
            $activity->id = $result['id'];
            $activity->type = $result['type'];
            $activity->description = $result['description'];
            $activity->timeStamp = $result['time_stamp'];
            $activity->userId = $result['user_id'];
            // return activity object
            return $activity;
        }else{
            // if no data found return false
            return false;
        }
        
    }

    public function createActivity($type, $description, $userId){
        // SQL-statement
        $sql = "INSERT INTO activities (type, description, user_id) VALUES (?, ?, ?)";
        // prepared statement
        $query = $this->mysqli->prepare($sql);
        // bind parameters to statement
        $query->bind_param('isi', $type, $description, $userId);
        // execute statement
        $query->execute();
    }
}
