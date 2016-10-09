<?php
namespace App\Contracts\Repository\Logger;
use App\Filters\QueryFilter;
use App\Models\User;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/10/2016
 * Time: 12:28 AM
 */
interface UserActivityLoggerContract
{

    /**
     * get all logs
     * @return mixed
     */
    public function getLogs();

    /**
     * get all logs in DataTables format
     * @param QueryFilter $filters
     * @return mixed
     */
    public function getDataTablesLogs(QueryFilter $filters);

    /**
     * get all logs of a user in DataTables format
     * @param QueryFilter $filters
     * @param User $user
     * @return mixed
     */
    public function getDataTablesLogsByUser(QueryFilter $filters, User $user);

    /**
     * get a single log
     * @param $log_id
     * @param $haltOrFail
     * @return mixed
     */
    public function getLog($log_id, $haltOrFail = false);

    /**
     * create a log
     * @param $options
     * @param User $user
     * @return mixed
     */
    public function storeLog($options, User $user = null);

    /**
     * update a log
     * @param $log_id
     * @param $options
     * @param User $user
     * @return mixed
     */
    public function updateLog($log_id, $options, User $user = null);

    /**
     * delete a log
     * @param $log_id
     * @return mixed
     */
    public function deleteLog($log_id);
}