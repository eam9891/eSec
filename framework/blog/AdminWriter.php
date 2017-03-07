<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/4/2017
 * Time: 2:46 PM
 */

namespace framework\blog {

    use framework\libs\Authenticate;

    class AdminWriter implements IBlogWriter {

        public function __construct(Article &$obj) {
            $auth = new Authenticate("admin");
            if ($auth) {
                $this->write($obj);
            }
        }

        public function write(Article $obj) {

            $date = date('M jS Y', strtotime($obj->date));
            $time = date('h:i A', strtotime($obj->date));

            if ($obj->published) {
                $publishButton = <<<publishButton
                    <button type='button' class='btn btn-default disabled'> Published </button>
                    <button type='button' class='btn btn-default btn-info publishPost' value='$obj->id'> Revert </button>
                
publishButton;
            } else {
                $publishButton = <<<revertButtons

                    
                    <button type='button' class='btn btn-info revertPublished' value='$obj->id'> Publish </button>
                
revertButtons;
            }


            echo <<<blogMainUI
        
                <tr>
                    <td>$obj->title</td>
                    <td>$date $time</td>
                    <td>$obj->author</td>
                    <td>
                        
                        <button value="$obj->id" class="btn btn-default btn-warning editPost"> Edit </button>
                        <button value="$obj->id" class="btn btn-default btn-danger deletePost"> Delete </button>
                        <input type="hidden" class="postPublished" name="postPublished" value="$obj->published">
                        $publishButton
                    </td>
                </tr>
             
blogMainUI;



        }
    }
}