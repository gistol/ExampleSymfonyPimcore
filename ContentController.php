<?php

namespace AppBundle\Controller;

use AppBundle\Service\prepareObjects;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ContentController extends AbstractController
{
    public function homeAction(Request $request, SessionInterface $session)
    {
        $parameters = array_merge($request->query->all(), $request->request->all());

        $this->view->isHome = true;

        $reviewRepository = $this->getBaseRepository()->getReviewRepository();
        $params = [
            'sort' => 'o_index',
            'orderKey' => 'asc',
        ];
        $reviewsContent = $reviewRepository->getReviewDataDB($params);
//            dump($reviewsContent);die;
        $this->view->reviewsArray = $reviewsContent;
//
//
        $questionRepository = $this->getBaseRepository()->getQuestionRepository();
        $params = [
            'sort' => 'o_index',
            'limit' => 3,
            'orderKey' => 'asc',
            'showOnHome' => true
        ];
        $questionsContent = $questionRepository->getQuestionsContent($params);
//            dump($questionsContent);die;
        $this->view->questionsArray = $questionsContent;


        $articleRepository = $this->getBaseRepository()->getArticleRepository();
        $params = [
//            'limit' => 1,
            'category' => 'all',
            'showOnHome' => true
        ];
        $articlesContent = $articleRepository->getArticles($params);
//            dump($articlesContent);die;
        $this->view->articlesArray = $articlesContent;


    }

    public function conditionsAction(Request $request, SessionInterface $session)
    {
        $this->view->isMap = true;
        $this->view->officeData = $this->getBaseRepository()->getOfficeRepository()->getOfficeData();
        $this->view->isVue = true;
    }

    public function costAction(Request $request, SessionInterface $session)
    {

    }


    public function educationAction(Request $request, SessionInterface $session)
    {

    }


    public function error404Action(Request $request, SessionInterface $session)
    {
        $this->view->showFooterTop = true;
        $this->view->hideFooterOn404 = true;
    }


    public function closeBubbleAction(Request $request, SessionInterface $session)
    {
        $response = new Response();
        $cookie = new Cookie("closeBubble", "hide", time() + 86400);
        $response->headers->setCookie($cookie);
        $response->send();

        $response_data = array(
            'success' => true,
            'bannerStatus' => 'hide',
        );

        return $this->json($response_data);
    }


}
