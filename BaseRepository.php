<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2019
 * Time: 15:01
 */

namespace AppBundle\Repository;

use AppBundle\Service\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BaseRepository
{
    private $request;
    private $session;
    private $service;

    private $documentRepository;
    private $articleRepository;
    private $articleTagRepository;
    private $questionRepository;
    private $assetRepository;
    private $officeRepository;
    private $memberRepository;
    private $subjectRepository;
    private $documentFileRepository;
    private $massMediaRepository;
    private $partnerRepository;
    private $reviewRepository;
    private $scheduleRepository;
    private $greatPeopleRepository;
    private $classRoomRepository;

    public function __construct(SessionInterface $session, Request $request, Service $service)
    {
        $this->request = $request;
        $this->session = $session;
        $this->service = $service;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getService()
    {
        return $this->service;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return DocumentRepository
     */
    public function getDocumentRepository()
    {
        if ($this->documentRepository === null) {
            $this->documentRepository = new DocumentRepository($this->session, $this->request, $this->service);
        }
        return $this->documentRepository;
    }

    /**
     * @param $session
     * @param $request
     * @param $service
     * @return ArticleRepository
     */
    public function getArticleRepository()
    {
        if ($this->articleRepository === null) {
            $this->articleRepository = new ArticleRepository($this->session, $this->request, $this->service);
        }
        return $this->articleRepository;
    }

    /**
     * @param $session
     * @param $request
     * @param $service
     * @return QuestionRepository
     */
    public function getQuestionRepository()
    {
        if ($this->questionRepository === null) {
            $this->questionRepository = new QuestionRepository($this->session, $this->request, $this->service);
        }
        return $this->questionRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return ArticleTagRepository
     */
    public function getArticleTagRepository()
    {
        if ($this->articleTagRepository === null) {
            $this->articleTagRepository = new ArticleTagRepository($this->session, $this->request, $this->service);
        }
        return $this->articleTagRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return AssetRepository
     */
    public function getAssetRepository()
    {
        if ($this->assetRepository === null) {
            $this->assetRepository = new AssetRepository($this->session, $this->request, $this->service);
        }
        return $this->assetRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return OfficeRepository
     */
    public function getOfficeRepository()
    {
        if ($this->officeRepository === null) {
            $this->officeRepository = new OfficeRepository($this->session, $this->request, $this->service);
        }
        return $this->officeRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return MemberRepository
     */
    public function getMemberRepository()
    {
        if ($this->memberRepository === null) {
            $this->memberRepository = new MemberRepository($this->session, $this->request, $this->service);
        }
        return $this->memberRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return SubjectRepository
     */
    public function getSubjectRepository()
    {
        if ($this->subjectRepository === null) {
            $this->subjectRepository = new SubjectRepository($this->session, $this->request, $this->service);
        }
        return $this->subjectRepository;
    }

    /**
     * @param $session
     * @param $request
     * @param $service
     * @return MassMediaRepository
     */
    public function getMassMediaRepository()
    {
        if ($this->massMediaRepository === null) {
            $this->massMediaRepository = new MassMediaRepository($this->session, $this->request, $this->service);
        }
        return $this->massMediaRepository;
    }



    /**
     * @param $session
     * @param $request
     * @param $service
     * @return DocumentFileRepository
     */
    public function getDocumentFileRepository()
    {
        if ($this->documentFileRepository === null) {
            $this->documentFileRepository = new DocumentFileRepository($this->session, $this->request, $this->service);
        }
        return $this->documentFileRepository;
    }



    /**
     * @param $session
     * @param $request
     * @param $service
     * @return PartnerRepository
     */
    public function getPartnerRepository()
    {
        if ($this->partnerRepository === null) {
            $this->partnerRepository = new PartnerRepository($this->session, $this->request, $this->service);
        }
        return $this->partnerRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return ReviewRepository
     */
    public function getReviewRepository()
    {
        if ($this->reviewRepository === null) {
            $this->reviewRepository = new ReviewRepository($this->session, $this->request, $this->service);
        }
        return $this->reviewRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return ScheduleRepository
     */
    public function getScheduleRepository()
    {
        if ($this->scheduleRepository === null) {
            $this->scheduleRepository = new ScheduleRepository($this->session, $this->request, $this->service);
        }
        return $this->scheduleRepository;
    }


    /**
     * @param $session
     * @param $request
     * @param $service
     * @return GreatPeopleRepository
     */
    public function getGreatPeopleRepository()
    {
        if ($this->greatPeopleRepository === null) {
            $this->greatPeopleRepository = new GreatPeopleRepository($this->session, $this->request, $this->service);
        }
        return $this->greatPeopleRepository;
    }



    /**
     * @param $session
     * @param $request
     * @param $service
     * @return ClassRoomRepository
     */
    public function getClassRoomRepository()
    {
        if ($this->classRoomRepository === null) {
            $this->classRoomRepository = new ClassRoomRepository($this->session, $this->request, $this->service);
        }
        return $this->classRoomRepository;
    }


}