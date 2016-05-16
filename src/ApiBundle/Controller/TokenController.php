<?php

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TokenController extends \FOS\OAuthServerBundle\Controller\TokenController {

    /**
     * @ApiDoc(
     *  description="Autenticarse por AccessToken",
     * parameters={
     *      {"name"="grant_type", "dataType"="string", "required"=true, "description"="'password'"},
     *      {"name"="client_id", "dataType"="string", "required"=true, "description"="id de la aplicacion que creaste"},
     *      {"name"="client_secret", "dataType"="string", "required"=true, "description"="secret de la aplicacion que creaste"},
     *      {"name"="username", "dataType"="string", "required"=false, "description"="Nombre de usuario"},
     *      {"name"="password", "dataType"="string", "required"=false, "description"="Contraseña"},
     *  },
     * resource=true,
     *  statusCodes={200="return the access token inside array[access_token, expires_in, token_type]"}
     * )
     */
    public function tokenAction(Request $request) {
        return parent::tokenAction($request);
    }

}
