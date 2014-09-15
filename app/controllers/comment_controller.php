<?php
 
class CommentController extends AppController
{
    /**
    * To view all comments on a particular thread.
    **/
    public function view()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comments = $thread->getComments();
        $user_name = $_SESSION['username'];
        $this->set(get_defined_vars());
    }

    /**
    * To edit logged-in user's posts/comments
    * IN PROGRESS (Working)
    **/
    public function update()
    {
        $id = Param::get('id');
        $new_body = Param::get('body');
        $task = Param::get('task');
        switch ($task) {
            case 'edit':
                Comment::changeComment($id, $new_body);
                break;
            case 'delete':
                Comment::deleteComment($id);
                redirect(url('thread/index'));
                break;
            default:
                redirect(url('thread/index'));
                break;
        }
    }
}