<?php

namespace PhpKansai\TodoManager\Controller;


use PhpKansai\TodoManager\Model\TodoEntity;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoController
{
    use TodoAppAwareTrait;

    /**
     * GET:"index"
     *
     * @return string
     */
    public function indexAction()
    {
        return $this->getTwig()->render('index.html.twig', [
            'entities' => $this->getTodoRepository()->findAll(),
        ]);
    }

    /**
     * POST:"todo"
     *
     * @param Request $request
     * @return string|Response
     */
    public function appendAction(Request $request)
    {
        $content = $request->request->get('content');
        if (!is_null($content)) {
            $this->getTodoRepository()->append(TodoEntity::create($content));
            return $this->app->redirect('/');
        } else {
            return $this->getTwig()->render('index.html.twig', [
                'error' => "正しく入力して下さい",
                'entities' => $this->getTodoRepository()->findAll(),
            ]);
       }
    }

    /**
     * PATCH:"todo/{id}/check"
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function checkAjaxAction($id, Request $request)
    {
        $checked = $request->get('checked');
        if (is_null($checked)) {
            $this->app->abort(400, "パラメーターエラー");
        }

        $todo = $this->getTodoRepository()->findById($id);
        if (is_null($todo)) {
            $this->app->abort(404, "TODOはありません");
        }
        if ($checked) {
            $todo->check();
        } else {
            $todo->uncheck();
        }
        $this->getTodoRepository()->syncCheckStatus($todo);

        return $this->app->json($todo);
    }

    /**
     * DELETE:"todo/{id}"
     * @param int $id
     * @return Response
     */
    public function removeAction($id)
    {
        $todo = $this->getTodoRepository()->findById($id);
        if (is_null($todo)) {
            $this->app->abort(404, "TODOはありません");
        }
        $this->getTodoRepository()->remove($todo);
        return $this->app->redirect('/');
    }
}