<?php

namespace AppBundle\Repository;

use Pimcore\Model\DataObject;
use Pimcore\Db;
use Pimcore\Db\ZendCompatibility\Expression;
use AppBundle\Helper;

class ReviewRepository extends BaseRepository
{

    private $reviewObjects;
    private $reviewData;
    private $reviewDataDBArray;

    private $listClassId;


    public function getListClassId()
    {
        if ($this->listClassId === null) {
            $classList = new DataObject\Review\Listing();
            $this->listClassId = $classList->getClassId();
        }
        return $this->listClassId;
    }


    /**
     * @return array
     */
    public function getReviewDataDB($params = []): array
    {
        if ($this->reviewDataDBArray === null) {
            /**
             * @var Db\Connection $db
             * @var Db\ZendCompatibility\QueryBuilder $secondQuery
             */
            $db = \Pimcore\Db::get();

            $secondQuery = $db->select()
                ->from(array('o' => 'object_'. $this->getListClassId()), array('*'))
                ->joinLeft(array('q' => 'object_query_'. $this->getListClassId()), 'o.oo_id = q.oo_id', array('*'))
                ->joinLeft(array('s' => 'object_store_'. $this->getListClassId()), 'o.oo_id = s.oo_id', array('*'))
                ->joinLeft(array('r' => 'object_relations_'. $this->getListClassId()), 'o.oo_id = r.src_id', array('*'))
                ->joinLeft(array('a' => 'assets'), 'a.id = o.image', array('image' => new Expression('CONCAT(a.path, "", a.filename)')))
                ->group('o.oo_id')
            ->where('o.o_published = 1');

            $reviews = $secondQuery->query()->fetchAll();

            if ($reviews) {
                foreach ($reviews as $key => $review) {
                    $reviews[$key]['date'] =  Helper\formatDate::formatdate($reviews['date']);
                }
            }

//        echo $secondQuery->assemble();
//        echo '<p>My SQL: ' . $select . '</p>';
//            dump($reviews);
//            die;

            $this->reviewDataDBArray = $reviews;
        }
        return $this->reviewDataDBArray;
    }


    /**
     * @return array
     */
    public function getReviewData($params = [])
    {
        $subjectRepository = $this->getSubjectRepository();
        if ($this->reviewData === null) {
            if ($this->getReviewObjects()) {
                $reviewDataArray = array();
                foreach ($this->getReviewObjects() as $review) {
//                    dump($review);die;

                    $reviewDataArray[] =
                        [
                            'id' => $review->getId(),
                            'name' => $review->getName(),
                            'position' => $review->getPosition(),
                            'category' => $review->getCategory(),
                            'subject' => $subjectRepository->getSubjectDataFromObject($review->getSubject()),
                            'image' => $review->getImage(),
                        ];
                }
                $this->reviewData = $reviewDataArray;
            }
        }
        return $this->reviewData;
    }


    /**
     * @return DataObject\Review\Listing
     */
    public function getReviewObjects()
    {
        if ($this->reviewObjects === null) {
            $reviews = new DataObject\Review\Listing();
            $this->reviewObjects = $reviews;
        }

        return $this->reviewObjects;
    }


}