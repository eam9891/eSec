<?php
/**
 * Created by PhpStorm.
 * User: Ethan
 * Date: 3/7/2017
 * Time: 2:14 AM
 */

namespace framework\libs;


class AjaxHandler {
    private $url, $divID;
    private $dataString = [];

    // $dataString is a two dimensional array that must have the following format:
    //      $dataString = array(
    //           "request" => xxx,
    //           "method"  => xxx,
    //           "params"  => array(
    //               xxx => xxx,
    //               xxx => xxx
    //           )
    //       );


    /** Generates an Ajax Request Button
     * @param string $url
     * @param string $divID
     * @param array  $dataString
     *
     * @return string
     */
    public function ajaxButton(string $url, string $divID, array $dataString) : string {

        $this->url = $url;
        $this->divID = $divID;
        $this->dataString = json_encode($dataString);

        $ajaxRequest = <<<ajax
            
            $('#$this->divID').on('click' , function(){
                loader();
             
                $.ajax({
                    type: "POST",
                    url: "$this->url",
                    data: $this->dataString,
                    cache: false,
                    success : function(data) {
                        $("#blog").html(data);
                    }
                });
                return false;
            });
        
ajax;
        return (string) $ajaxRequest;
    }



    /** Generates an Ajax Request
     * @param string $url
     * @param array  $dataString
     *
     * @return string
     */
    public function ajaxRequest(string $url, array $dataString) : string {

        $this->url = $url;
        $this->dataString = json_encode($dataString);

        $ajaxRequest = <<<ajax
            
            loader();
         
            $.ajax({
                type: "POST",
                url: "$this->url",
                data: $this->dataString,
                cache: false,
                success : function(data) {
                    $("#blog").html(data);
                }
            });
            return false;
       
ajax;
        return (string) $ajaxRequest;
    }
}