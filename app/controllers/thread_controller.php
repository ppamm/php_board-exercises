<?php

/**
* class ThreadController
**/
class ThreadController extends AppController
{
    /**
    *   To view all threads with limits through Pagination.
    **/
    public function index()
    {
        check_if_logged_out();
        $thread_count = Thread::getNumRows();
        $pagination = pagination($thread_count, '');

        $threads = Thread::getAll($pagination['max']);
        $this->set(get_defined_vars());
    }

    /**
    *  @property username
    *       set as the $_SESSION['username']
    **/
    public function write()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next', 'write');

        switch ($page) {
            case 'write':
                break;
            case 'write_end':
                $comment->username = $_SESSION['username'];
                $comment->body = Param::get('body');
                try {
                    $thread->write($comment);
                } catch (ValidationException $e) {
                    $page='write';
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");
                break;      
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    /**
    * To create new thread with comment.
    **/
    public function create()
    {
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next', 'create');
        $username = $_SESSION['username'];

        switch ($page) {
            case 'create':
                break;
            case 'create_end';
                $thread->title = Param::get('title');
                $comment->username = $username;
                $comment->body = Param::Get('body');
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $page = 'create';
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    /**
    * To destroy user session
    * 
    **/
    function logout()
    {
        session_destroy();
        redirect('user', 'index');
    }
}