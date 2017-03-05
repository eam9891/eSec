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

        public function __construct(Authenticate &$auth, Article &$obj) {
            if ($auth) {
                $this->write($obj);
            }
        }

        public function write(Article $obj) {

            $date = date('M jS Y', strtotime($obj->date));
            $time = date('h:i A', strtotime($obj->date));
            echo <<<blogMainUI
        
                <tr>
                    <td>$obj->title</td>
                    <td>$obj->date</td>
                    <td>
                        <button type="btn btn-warning" id="editPost"> Edit </button>
                        <a href="editPost.php?id=$obj->id">Edit</a>&nbsp
                        <a href="javascript:delpost($obj->id,$obj->title)"> Delete </a>
                    </td>
                </tr>
             
blogMainUI;



        }
    }
}