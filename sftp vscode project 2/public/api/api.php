<?php
    session_start();

    if (empty($_SESSION['user_id'])) {
        header('Location: ../signin.php');
        exit;
    }

    require_once '../../config/database.php';
    require_once '../../app/User.php';
    require_once '../../app/Category.php';
    require_once '../../app/Operation.php';

    $method = $_SERVER['REQUEST_METHOD'] ?? '';
    $action = $_GET['action'] ?? '';

    if ($method === 'GET') {
        if ($action === 'username') {
            echo json_encode($user->getName());
        }

        elseif ($action === 'categories') {
            echo json_encode($category->getAll());
        }

        elseif ($action === 'operations') {
            echo json_encode(array_reverse($operation->getAll()));
        }

        elseif ($action === 'operation') {
            $id = $_GET['id'];
            echo json_encode($operation->getById($id));
        }

        elseif ($action === 'operation-by-category') {
            $category_id = $_GET['category-id'];
            echo json_encode($operation->getByCategory($category_id));
        }

        elseif ($action === 'operation-delete') {
            $id = $_GET['id'];
            echo json_encode($operation->delete($id));
        }

        else if ($action === 'total-amount') {
            $type = $_GET['type'];
            echo $operation->totalAmount($type);
        }

        else if ($action === 'test-total-amount') {
            $type = $_GET['type'];
            $category_id = $_GET['category-id'];
            echo json_encode($operation->test_TotalAmount($type, $category_id));
        }

        else if ($action === 'categories-count') {
            echo json_encode($category->getCategoriesCount());
        }

        else if ($action === 'operations-count') {
            echo json_encode($operation->getOperationsCount());
        }
    }

    if ($method === 'POST') {
        if ($action === 'log-out') {
            echo $user->logout();
        } 
        
        else if ($action === 'create-operation') {
            $data = json_decode(file_get_contents('php://input'), true);

            echo json_encode($operation->create($data));
        }
    }
?>