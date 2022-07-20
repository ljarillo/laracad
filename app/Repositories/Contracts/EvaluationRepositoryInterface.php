<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{

    /**
     * @param int $idOrder
     * @param int $idClient
     * @param array $evaluation
     * @return mixed
     */
    public function newEvaluationOrder(int $idOrder, int $idClient, array $evaluation);

    /**
     * @param int $idOrder
     * @return mixed
     */
    public function getEvaluationsByOrder(int $idOrder);

    /**
     * @param int $idClient
     * @return mixed
     */
    public function getEvaluationsByClient(int $idClient);

    /**
     * @param int $idEvaluation
     * @return mixed
     */
    public function getEvaluationById(int $idEvaluation);

    /**
     * @param int $idClient
     * @param int $idOrder
     * @return mixed
     */
    public function getEvaluationByClientIdByOrderId(int $idClient, int $idOrder);

}
