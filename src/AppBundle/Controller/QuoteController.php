<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
//use AppBundle\Form\Type\PlaceType;
use AppBundle\Entity\Quote;

/**
 * Class to handle quote webservices
 */
class QuoteController extends Controller
{
    /**
     *
     * @Rest\View()
     * @Rest\Get("/quotes")
     * @QueryParam(name="offset", requirements="\d+", default="0", description="begin paginator index")
     * @QueryParam(name="limit", requirements="\d+", default="100", description="end paginator index")
     * @QueryParam(name="sort", requirements="(asc|desc)", default="asc", nullable=true, description="sorting order (based on the name)")
     * @param Request      $request
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getQuotesAction(Request $request, ParamFetcher $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $sort = $paramFetcher->get('sort');

        $qb = $this->get('doctrine.orm.entity_manager')->createQueryBuilder();
        $qb->select('q')
           ->from('AppBundle:Quote', 'q');

        if ($offset != "") {
            $qb->setFirstResult($offset);
        }

        if ($limit != "") {
            $qb->setMaxResults($limit);
        }

        if (in_array($sort, ['asc', 'desc'])) {
            $qb->orderBy('q.author', $sort);
        }

        $places = $qb->getQuery()->getResult();

        return $places;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/quotes/{id}")
     * @param int     $id
     * @param Request $request
     * @return View
     */
    public function getQuoteAction($id, Request $request)
    {
        $quote = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Quote')
                ->find($id);

        if (empty($quote)) {
            return $this->quoteNotFound();
        }

        return $quote;
    }

    /**
     * method to handle quoteNotFound message
     * @return [type] [description]
     */
    private function quoteNotFound()
    {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Quote§è not found');
    }
}
