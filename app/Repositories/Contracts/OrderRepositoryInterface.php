<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    /**
     * @param string $identify
     * @param float $total
     * @param string $status
     * @param int $tenantId
     * @param string $comment
     * @param $clientId
     * @param $table
     * @return mixed
     */
    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $table = ''
    );

    /**
     * @param string $identify
     * @return mixed
     */
    public function getOrderByIdentify(string $identify);

    /**
     * @param int $orderId
     * @param array $prtoducts
     * @return mixed
     */
    public function registerProductsOrder(int $orderId, array $prtoducts);

    /**
     * @param int $idClient
     * @return mixed
     */
    public function getOrdersByClientId(int $idClient);
}
