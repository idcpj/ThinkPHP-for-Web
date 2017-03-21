<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'UploadImage' instanceof Common\Model\UploadImageModel,
			'News' instanceof Common\Model\NewsModel,
			'Menu' instanceof Common\Model\MenuModel,
			'Adv' instanceof Think\Model\AdvModel,
			'Mongo' instanceof Think\Model\MongoModel,
			'View' instanceof Think\Model\ViewModel,
			'NewsContent' instanceof Common\Model\NewsContentModel,
			'Relation' instanceof Think\Model\RelationModel,
			'Admin' instanceof Common\Model\AdminModel,
			'Merge' instanceof Think\Model\MergeModel,
		],
	];
}