<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 6:15 PM
 */

namespace framework\blog {

    use framework\libs\Authenticate;
    use framework\User;

    class NewPost {
        private $user, $role;
        public function __construct(Authenticate $auth, User &$USER) {
            if ($auth) {
                $this->showUI($USER);
            }
        }

        private function showUI(User &$USER) {
            $this->user = $USER->getUsername();
            $this->role = $USER->getRole();

            echo <<<newPost

                
                
                
                <h2>Add Post</h2>
                
                <form action='' method='post'>
                
                    <p><label>Title</label><br />
                        <input type='text' name='postTitle' value=''></p>
                
                    <p><label>Description</label><br />
                        <textarea name='postDesc' cols='60' rows='10'></textarea></p>
                
                    <p><label>Content</label><br />
                        <textarea name='postCont' cols='60' rows='10'></textarea></p>
                    <input type="hidden" name="user" value=$this->user>
                    <input type="hidden" name="role" value=$this->role>
                    <p><input id='submitPost' type='submit' name='submit' value='Submit'></p>
                
                </form>
            
newPost;
        }

    }
}