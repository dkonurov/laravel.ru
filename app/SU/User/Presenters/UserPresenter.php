<?php namespace SU\User\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter{

	public function displayField1()
	{
        return $this->field1;
	}

}