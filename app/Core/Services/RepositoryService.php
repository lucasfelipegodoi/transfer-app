<?php
namespace App\Core\Services;

use DB;
use App\Core\Repositories\Repository;
use App\Exceptions\Exception;
use Illuminate\Support\Facades\Validator;
use App\Core\Helpers\JSON;
use App\Exceptions\ValidacaoException;

abstract class RepositoryService implements Service
{
    protected $entity;

    protected $request;

    public function __construct(Repository $entity)
    {
        $this->entity = $entity;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getAll()
    {
        return $this->entity->getAll();
    }

    public function find($id)
    {
        return $this->entity->find($id);
    }

    public function fetchAll(array $filter = [], $paginated = false)
    {
        $this->entity->setPerPage((int) \Request::get('rowsPerPage', $this->entity->getPerPage()));
        return $this->entity->fetchAll($filter, $paginated);
    }

    public function query(array $filter = [])
	{
		$columns = isset($filter['columns']) ? $filter['columns'] : $this->entity->getModel()->getTable() . '.*';
		unset($filter['columns']);
        $select = $this->entity->getModel()->select($columns);
		return $this->filterParams($select, $filter);
	}

    	/**
	 * @param $select
	 * @param $filter
	 *
	 * @return mixed
	 */
	public function filterParams($select, $filter)
	{
		$select = $this->setFilter($select, $filter, []);
		return $select;
    }
    
    public function setFilter($select, array $filter, array $exceptions = array())
    {
        $exceptions[] = '_token';
	    $exceptions[] = 'token';
        $exceptions[] = 'reset';
        $exceptions[] = 'page';
	    foreach ($filter as $key => $value) {
		    if (!in_array($key, $exceptions)) {
			    if($key == 'with' && is_array($value) && count($value)){
				    $select->with($value);
			    } elseif($key == "raw") {
				    if (is_array($value)) {
					    foreach ($value as $v) {
						    if ($v != '') {
							    $select->whereRaw($v);
						    }
					    }
				    } elseif ($value != '') {
					    $select->whereRaw($value);
				    }
			    } elseif ($key == 'limit' && $value > 0){
				    $select->limit($value);
			    } elseif ($key == 'has' && !empty($value) && !is_null($value)){
				    $select->has($value);
			    } elseif ($key == 'order' && is_array($value) && count($value)){
				    foreach ($value as $order => $dir){
					    $select->orderBy($order,$dir);
				    }
			    } elseif (is_numeric($value) && $value >= 0) {
				    $select->where($key, '=', $value);
			    } elseif (is_array($value) && count($value)){
				    $select->whereIn($key, $value);
			    } elseif ($value != "" && $value != "0" && !is_null($value) && !is_array($value)) {
				    $select->where($key, 'like', "%{$value}%");
			    }
		    }
	    }
        return $select;
    }

    public function persist(array $data)
    {
        return $this->entity->save($data);
    }

    public function delete($id)
    {
        return $this->entity->delete($id);
    }

    public function updateByWhereIn(array $options)
    {
        $table = $this->entity->getModel()->getTable();
        $data = $options['data'];
        $column = $options['column'];
        $value = $options['value'];

        DB::table($table)->whereIn($column, $value)->update($data);
    }

    public function getTableName()
    {
        return $this->entity->getModel()->getTable();
    }

    public function prepareAndValidateDataBeforeSave(array $data)
    {
        if($this->request == null) return $data;
        
        $validator = Validator::make($data, $this->request->rules($data), $this->request->messages());

        if ($validator->fails()) {
            throw new ValidacaoException(["erros"=>JSON::encode($validator->messages())]);
        }

        return $data;
    }

    

}
