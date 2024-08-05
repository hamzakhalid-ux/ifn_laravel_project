<?php
namespace App\Services;

/**
*
*/
class Utility {

	public function __construct() {
		//
	}

	/*
	* Class function to get appropriate headers
	*
	*
	*/
	public function error_response($msg = null) {
        $response = array();
        $response['success'] = false;
        $response['message'] = $msg;
        return $response;
    }

    public function success_response($msg = null) {
        $response = array();
        $response['success'] = true;
        $response['message'] = $msg;
        return $response;
    }

    public function success_response_with_data($msg = null, $data = null) {
        $response = array();
        $response['success'] = true;
        $response['message'] = $msg;
        $response['data'] = $data;
        return $response;
    }

    public function error_response_with_data($msg = null, $data = null) {
        $response = array();
        $response['success'] = false;
        $response['message'] = $msg;
        $response['data'] = $data;
        return $response;
    }

    public function generateErrorHtml($message) {

        $mod = "danger";
        if (strstr($message, "=")) {
            $msg = explode("=", $message);
            $mod = $msg[0];
            $message = $msg[1];
        }
        $title = "";
        $class = "";
        switch ($mod) {
            case 'danger':
                $title = "Error!";
                $class = "error";
                break;
            case 'success':
                $title = "Success!";
                $class = "success";
                break;
        }


        $html = '<div class="alertMsg"><div class="container hideMe" >
                <div class="row">
                  <div class="col-lg-12">
                    <div class="alert alert-dismissible alert-' . $mod . '">
                    <button type="button" class="close ' . $class . '" data-dismiss="alert">&times;</button>
                    <h4>' . $title . '</h4>
                    <p>' . $message . '</p>
                  </div>
                  </div>
                </div>
              </div></div>';
        echo $html;
    }

    public function generatePanel($message) {
        $mod = "danger";
        if (strstr($message, "=")) {
            $msg = explode("=", $message);
            $mod = $msg[0];
            $message = $msg[1];
        }
        $title = "";
        $class = "";
        $icon = "";
        switch ($mod) {
            case 'danger':
                $title = "Error!";
                $class = "alert-danger"; // Bootstrap 3 danger class
                $icon = "glyphicon glyphicon-exclamation-sign"; // Bootstrap 3 error icon
                break;
            case 'success':
                $title = "Success!";
                $class = "alert-success"; // Bootstrap 3 success class
                $icon = "glyphicon glyphicon-ok-sign"; // Bootstrap 3 success icon
                break;
        }
        $html='<div class="col-12 alert bg-rgba-' . $mod . $class . ' alert-dismissible mb-2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center">
                        <i class="' . $icon . '"></i>
                        <span>
                            ' . $message . '
                        </span>
                    </div>
              </div>';
        echo $html;
        session()->forget('message');
    }
}
