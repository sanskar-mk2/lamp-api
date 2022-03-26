<?php

class UserController extends BaseController
{
    public function listAction()
    {
        $strerrordesc = "";
        $requestmethod = $_SERVER["REQUEST_METHOD"];
        $arrquerystringparams = $this->get_query_string_params();

        if (strtoupper($requestmethod) == "GET") {
            try {
                $usermodel = new Usermodel();

                $intlimit = 10;
                if (isset($arrquerystringparams["limit"]) && $arrquerystringparams["limit"]) {
                    $intlimit = $arrquerystringparams["limit"];
                }

                $arrusers = $usermodel->getUsers($intlimit);
                $responsedata = json_encode($arrusers);
            } catch (Error $e) {
                $strerrordesc = $e->getMessage() . "Something went wrong :(((((";
                $strerrorheader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $strerrordesc = "MEthod not supported";
            $strerrorheader = "HTTP/1.1 422 Unprocessable Entitiy";
        }

        if (!$strerrordesc) {
            $this->send_output($responsedata, array("Content-Type: application/json", "HTTP/1.1 200 OK"));
        } else {
            $this->send_output(json_encode(array("error" => $strerrordesc)), array("Content-Type: application/json", $strerrorheader));
        }
    }
}
