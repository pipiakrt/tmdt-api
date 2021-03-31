<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

abstract class EloquentRepository implements RepositoryInterface
{

    /**
     * The current access token for the authentication user.
     *
     * @var \App\Models\Base
     */
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app($this->getModel());
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  array  $attributes
     * @return array
     */
    public function filter(array $attributes)
    {
        return [];
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function getCount()
    {
        return $this->_model->count();
    }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result && $result->delete()) {
            return true;
        }
        return false;
    }
}
