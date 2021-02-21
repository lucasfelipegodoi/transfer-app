<?php

namespace App\Core\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 * @package Modules\Core\Repositories\Eloquent
 */
abstract class Repository {

    /**
     * @var Model carregado
     */
    protected $model;

    /**
     * @var int
     */
    protected $primaryVal = 0;

    /**
     * @var int
     */
    protected $perPage = 20;

    /**
     * @var null
     */
    protected $paginator = null;

	/**
	 * @var array Joins para consulta
	 */
	protected $joins = [];

    /**
     * @var array JoinsRelations usadas
     */
	protected $joinsRelations = [];

	/**
	 * @var array Ordenações usadas para fetchAll. Exemplo: ['coluna' => 'ASC' || 'DESC']
	 */
	protected $orderBy = [];

	/**
	 * @return Model
	 */
	public function getModel()
	{
		return $this->model;
	}

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

	public function fetchAll(array $filter = [], $paginated = false)
	{
		$select = $this->query($filter);
		if(is_array($this->orderBy)){
			foreach ( $this->orderBy as $coluna => $dir ) {
				$select->orderBy($coluna, $dir);
			}
		}
		if($paginated && !$this->getPerPage()){
            $this->setPerPage($this->countTotalItens($filter));
        }
		return $paginated ? $select->paginate($this->getPerPage()) : $select->get();
	}

	/**
     * Função responsável por montar a consulta a executar
	 * @param array $filter
	 * @return object
	 */
	public function query(array $filter = [])
	{
		$columns = isset($filter['columns']) ? $filter['columns'] : $this->model->getTable() . '.*';
		unset($filter['columns']);
		$select = $this->model->select($columns);
        $select = $this->renderJoins($select);
        $select = $this->renderJoinRelations($select);
		return $this->filterParams($select, $filter);
	}

    /**
     * @param $relation
     * @param bool $innerJoin
     * @return $this
     */
	public function addJoinRelation($relation, $innerJoin = true)
    {
        $this->joinsRelations[$relation] = $innerJoin;
        return $this;
    }

    /**
     * @param $select
     * @return mixed
     */
    public function renderJoinRelations($select)
    {
        if(method_exists($this->model, 'joinRelations')){
            foreach ($this->joinsRelations as $relation => $inner) {
                $select->joinRelations($relation, $inner);
            }
        }
        return $select;
    }

    /**
     * @param Join $join
     * @return $this
     */
	public function addJoin(Join $join)
	{
		$this->joins[] = $join;
		return $this;
	}

    /**
     * @param $select
     * @return mixed
     * @throws \Exception
     */
	public function renderJoins($select)
	{
		foreach ($this->joins as $join) {
			if(!$join->getModelJoinRelation()){
				$join->setModelJoinRelation( new Join($this->model) );
			}
			$join->render($select);
		}
		return $select;
	}

	/**
	 * @param $select
	 * @param $filter
	 *
	 * @return mixed
	 */
	public function filterParams(Builder $select, $filter)
	{
		$this->setFilter($select, $filter, []);
		return $select;
	}

    /**
     * @param $id
     * @return mixed
     */
    public function find($id, $trashed = false, array $relations = [])
    {
    	$model = $this->model->with($relations);
    	if($trashed){
		    $model->withTrashed();
	    }
	    return $model->find($id);
    }

	/**
	 * @param array $data
	 *
	 * @return int|mixed
	 */
	public function save(array $data)
	{
		$data = $this->filter($data);
		if($this->primaryVal){
			$this->update($this->primaryVal, $data);
		}
		else{
			$this->primaryVal = $this->create($data)->getKey();
		}
		return $this->primaryVal;
	}

	/**
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function updateOrCreate(array $data)
	{
		$data = $this->filter($data);
		return $this->model->updateOrCreate(
			[$this->model->getKeyName() => $this->primaryVal],
			$data
		)->getKey();
	}

	/**
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function firstOrCreate(array $data)
	{
		$data = $this->filter($data);
		return $this->model->firstOrCreate( $data )->getKey();
	}

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $model = get_class($this->model);
        return $model::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $model = get_class($this->model);
    	return $model::find($id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function forceDelete($id)
	{
		return $this->find($id,true)->forceDelete();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function restore($id)
	{
		return $this->find($id, true)->restore();
	}

    /**
     * @param mixed $select
     * @param array $filter
     * @param array $exceptions
     * @return $this
     */
	public function setFilter($select, array $filter, array $exceptions = [])
	{
		$exceptions[] = '_token';
		$exceptions[] = 'token';
		$exceptions[] = 'reset';
		$exceptions[] = 'page';
		$exceptions[] = 'paginated';
		$exceptions[] = 'rowsPerPage';
		$exceptions[] = 'rowsNumber';
		$exceptions[] = 'orderBy';
		$exceptions[] = 'sortBy';
		$exceptions[] = 'descending';
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
				} elseif($key == 'columns' && $value){
				    $select->select($value);
                } elseif ($key == 'limit' && $value > 0){
					$select->limit($value);
				} elseif ($key == 'has' && !empty($value) && !is_null($value)){
					$select->has($value);
				} elseif ($key == 'order' && is_array($value) && count($value)) {
					foreach ($value as $order => $dir) {
						$join = false;
						foreach ($this->joins as $join) {
							if($order != $this->model->getKeyName() && in_array($order, $join->getFillable())){
								$select->orderBy( $join->getTable() . '.' . $order, $dir );
								$join = true;
								continue;
							}
						}
						if(!$join) {
							$select->orderBy( $this->model->getTable() . '.' . $order, $dir );
						}
					}
				}  elseif ($key == 'filter' && $value) {
					$select->where(function ($query) use ($value) {
						foreach ($this->model->getFillable() as $i => $fillable) {
							if($i == 0){
								$query->where("{$this->model->getTable()}.{$fillable}", 'like', "%{$value}%");
							}
							else{
								$query->orWhere("{$this->model->getTable()}.{$fillable}", 'like', "%{$value}%");
							}
						}
						foreach ($this->joins as $join) {
							foreach ($join->getFillable() as $i => $fillable) {
								$query->orWhere("{$join->getTable()}.{$fillable}", 'like', "%{$value}%");
							}
						}
					} );
				} elseif (is_numeric($value) && $value > 0) {
					$select->where($key, '=', $value);
				} elseif (is_array($value) && count($value)){
					$select->whereIn($key, $value);
				} elseif ($value != "" && $value != "0" && !is_null($value) && !is_array($value)) {
					$select->where($key, 'like', "%{$value}%");
				}
			}
		}
		return $this;
	}

    /**
     * @param array $data
     * @return array
     */
    public function filter(array $data)
    {
        $fillable = $this->model->getFillable();
        foreach ($data as $key => $value) {
            if($key == $this->model->getKeyName()){
                $this->primaryVal = $value;
                unset($data[$key]);
            }
            if(!in_array($key,$fillable)){
                unset($data[$key]);
            }
        }
        return $data;
    }

    /**
     * @param $perPage
     * @return $this
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function countTotalItens(array $filter = [])
    {
        return $this->query($filter)->count();
    }
}
