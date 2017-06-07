<?php

namespace Masha\Controller;

use Masha\Exception\SimpleException;
use Masha\Model\Admin;
use Masha\Model\Task;
use JasonGrimes\Paginator;

class TaskController extends AbstractController
{
    public function indexAction()
    {
        $task = new Task();

        $totalItems = $task->count();

        $itemsPerPage = 3;
        $currentPage = !empty($_GET['p']) ?  $_GET['p'] : 1;
        $sort = !empty($_GET['sort']) ? $_GET['sort'] : null;
        $urlPattern = '/?p=(:num)';
        $this->getSmarty()->assign([
            'tasks' => $task->getList($itemsPerPage, 0, $sort, 'ASC'),
            'paginator' => new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern),
            'sort' => $sort
        ]);
        $this->getSmarty()->display('list.tpl');

    }

    public function createAction()
    {
        $this->getSmarty()->display('create.tpl');
    }

    /**
     * @throws SimpleException
     */
    public function editAction()
    {
        $task = new Task();
        $admin = new Admin();
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            throw new SimpleException('Id is absent');
        }

        if (!$admin->isLogged()) {
            throw new SimpleException('Not logged');
        }

        $this->getSmarty()->display('edit.tpl', [
            'task' => $task->get($id)
        ]);
    }

    public function editPostAction()
    {
        $task = new Task();

        $task->update(
            isset($_GET['id']) ? $_GET['id'] : null,
            isset($_POST['content']) ? $_POST['content'] : ''
        );

        $this->redirect('/');
    }

    public function createPostAction()
    {
        $task = new Task();

        $task->create(
            !empty($_POST['username']) ? $_POST['username'] : '',
            !empty($_POST['email']) ? $_POST['email'] : '',
            !empty($_POST['content']) ? $_POST['content'] : '',
            !empty($_FILES['images']) ? $_FILES['images'] : []
        );

        $this->redirect('/');
    }

    public function markAction()
    {
        $task = new Task();
        $id =  isset($_GET['id']) ? $_GET['id'] : null;
        if(!$id){
            throw new SimpleException('Id not found');
        }
        $task->mark($id);

        $this->redirect('/');
    }
}
