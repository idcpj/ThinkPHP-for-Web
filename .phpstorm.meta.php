<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'News' instanceof Common\Model\NewsModel,
			'Mongo' instanceof Think\Model\MongoModel,
			'View' instanceof Think\Model\ViewModel,
			'NewsContent' instanceof Common\Model\NewsContentModel,
			'UploadImage' instanceof Common\Model\UploadImageModel,
			'Menu' instanceof Common\Model\MenuModel,
			'Adv' instanceof Think\Model\AdvModel,
			'Basic' instanceof Common\Model\BasicModel,
			'Relation' instanceof Think\Model\RelationModel,
			'Admin' instanceof Common\Model\AdminModel,
			'PositionContent' instanceof Common\Model\PositionContentModel,
			'Position' instanceof Common\Model\PositionModel,
			'Merge' instanceof Think\Model\MergeModel,
		],
	];
}