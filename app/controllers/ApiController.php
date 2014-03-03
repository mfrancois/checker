<?php





class ApiController extends BaseController
{



    public function links($domaine)
    {

        $parser = new Distillerie\Libraries\Parser\Parser($domaine);

        $tabReponse = array(
            'status'=>$parser->getStatus(),
            'links' =>$parser->getLinks()
        );


        return Response::json($tabReponse);

    }

}