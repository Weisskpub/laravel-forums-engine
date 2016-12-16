<?php
namespace Hzone\LFE\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AllScope implements Scope
{
	public function apply( Builder $builder, Model $model )
	{
		$builder->whereIn( $model->getTable().'.is_active', [ true, false ] );
	}
}
