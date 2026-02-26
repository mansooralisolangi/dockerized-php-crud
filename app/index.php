<?php

header("Content-Type: application/json");

$conn = pg_connect("host=postgres dbname=crud_db user=mansoor password=secret");

if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // GET ALL OR SINGLE
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = pg_query_params($conn, "SELECT * FROM user_table WHERE id = $1", [$id]);
            $data = pg_fetch_assoc($result);
            echo json_encode($data);
        } else {
            $result = pg_query($conn, "SELECT * FROM user_table ORDER BY id DESC");
            $users = [];
            while ($row = pg_fetch_assoc($result)) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
        break;

    // CREATE
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);

        $name = $input['name'] ?? '';
        $email = $input['email'] ?? '';
        $phone_number = $input['phone_number'] ?? '';

        $query = "INSERT INTO user_table (name, email, phone_number) VALUES ($1, $2, $3)";
        $result = pg_query_params($conn, $query, [$name, $email, $phone_number]);

        if ($result) {
            echo json_encode(["message" => "User created successfully"]);
        } else {
            echo json_encode(["error" => "Insert failed"]);
        }
        break;

    // UPDATE
    case 'PUT':
        if (!isset($_GET['id'])) {
            echo json_encode(["error" => "ID required"]);
            exit;
        }

        $id = $_GET['id'];
        $input = json_decode(file_get_contents("php://input"), true);

        $name = $input['name'] ?? '';
        $email = $input['email'] ?? '';
        $phone_number = $input['phone_number'] ?? '';

        $query = "UPDATE user_table SET name=$1, email=$2, phone_number=$3 WHERE id=$4";
        $result = pg_query_params($conn, $query, [$name, $email, $phone_number, $id]);

        if ($result) {
            echo json_encode(["message" => "User updated"]);
        } else {
            echo json_encode(["error" => "Update failed"]);
        }
        break;

    // DELETE
    case 'DELETE':
        if (!isset($_GET['id'])) {
            echo json_encode(["error" => "ID required"]);
            exit;
        }

        $id = $_GET['id'];
        $result = pg_query_params($conn, "DELETE FROM user_table WHERE id=$1", [$id]);

        if ($result) {
            echo json_encode(["message" => "User deleted"]);
        } else {
            echo json_encode(["error" => "Delete failed"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request"]);
        break;
}